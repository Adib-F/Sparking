from flask import Flask, Response, request
from ultralytics import YOLO
import numpy as np
import cv2
import time
import requests
from shapely.geometry import Polygon
from datetime import datetime
import threading

app = Flask(__name__)
model = YOLO("yolov8n.pt")

camera_states = {}
DEFAULT_CAMERA_ID = 0
BUFFER_TIME = 5

def get_slots_config(subzona_id):
    try:
        API_URL = f"http://127.0.0.1:8000/api/real-time/subzona/{subzona_id}"
        response = requests.get(API_URL)
        response.raise_for_status()
        data = response.json()
        slots = []
        for slot in data.get('slots', []):
            slots.append({
                "nomor_slot": slot['nomor_slot'],
                "status": slot['keterangan'],
                "area": [
                    (int(slot['area']['x1']), int(slot['area']['y1'])),
                    (int(slot['area']['x2']), int(slot['area']['y2'])),
                    (int(slot['area']['x3']), int(slot['area']['y3'])),
                    (int(slot['area']['x4']), int(slot['area']['y4'])),
                ],
                "start_time": None,
                "last_detected_time": 0,
                "occupied": False,
                "logged": False
            })
        return slots
    except Exception as e:
        print(f"[ERROR] get_slots_config: {e}")
        return []

def update_slot_status_to_api(subzona_id, nomor_slot, status):
    try:
        url = "http://127.0.0.1:8000/api/update-status-slot"
        payload = {
            "subzona_id": subzona_id,
            "nomor_slot": nomor_slot,
            "keterangan": status
        }
        requests.post(url, json=payload)
        print(f"[API] Update status slot {nomor_slot} => {status}")
    except Exception as e:
        print(f"[ERROR] update_slot_status_to_api: {e}")

def kirim_log_parkir(status, subzona_id, nomor_slot):
    try:
        url = "http://127.0.0.1:8000/api/log-parkir/" + ("masuk" if status == "Terisi" else "keluar")
        payload = {
            "subzona_id": subzona_id,
            "nomor_slot": nomor_slot,
            "waktu_mulai" if status == "Terisi" else "waktu_selesai": datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        }
        requests.post(url, json=payload)
        print(f"[LOG] Kirim log {status} untuk slot {nomor_slot}")
    except Exception as e:
        print(f"[ERROR] kirim_log_parkir: {e}")

# Tambahkan fungsi baru untuk stream tanpa deteksi
def camera_worker_clean(camera_id):
    print(f"[INFO] Start clean worker for camera {camera_id}")
    cap = cv2.VideoCapture(camera_id, cv2.CAP_DSHOW)
    cap.set(cv2.CAP_PROP_FRAME_WIDTH, 640)
    cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 420)

    while True:
        success, frame = cap.read()
        if not success:
            print(f"[ERROR] Kamera {camera_id} tidak terbaca")
            time.sleep(1)
            continue

        # # Gambar kotak area slot di frame bersih
        # if camera_id in camera_states:
        #     state = camera_states[camera_id]
        #     slots = state['slots']
        #     for slot in slots:
        #         warna = (0, 255, 0) if slot['status'] == "Tersedia" else (0, 0, 255)
        #         x1, y1 = slot["area"][0]
        #         x2, y2 = slot["area"][2]
        #         cv2.polylines(frame, [np.array(slot["area"], dtype=np.int32)], True, warna, 2)
        #         cv2.putText(frame, f"{slot['nomor_slot']}: {slot['status']}", (x1, y2 + 20),
        #                     cv2.FONT_HERSHEY_SIMPLEX, 0.6, warna, 2)

        # Simpan frame dengan hanya poligon slot
        if camera_id in camera_states:
            with camera_states[camera_id]['lock']:
                camera_states[camera_id]['clean_frame'] = frame.copy()

        time.sleep(0.03)


# Modifikasi fungsi initialize_camera_state
def initialize_camera_state(camera_id, subzona_id):
    if camera_id not in camera_states:
        cap = cv2.VideoCapture(camera_id, cv2.CAP_DSHOW)
        camera_states[camera_id] = {
            "cap": cap,
            "slots": get_slots_config(subzona_id),
            "subzona_id": subzona_id,
            "last_frame": None,
            "clean_frame": None,
            "lock": threading.Lock()
        }
        # Mulai thread untuk stream bersih
        threading.Thread(target=camera_worker_clean, args=(camera_id,), daemon=True).start()


def camera_worker(camera_id, subzona_id):
    print(f"[INFO] Start worker for camera {camera_id}, subzona {subzona_id}")
    initialize_camera_state(camera_id, subzona_id)
    state = camera_states[camera_id]
    cap = state['cap']
    slots = state['slots']

    while True:
        success, frame = cap.read()
        if not success:
            print(f"[ERROR] Kamera {camera_id} tidak terbaca")
            time.sleep(1)
            continue

        current_time = time.time()
        frame = cv2.resize(frame, (640, 420))
        results = model(frame, verbose=False)

        for slot in slots:
            slot["occupied"] = False

        # Loop deteksi dan gambar bounding box
        for r in results:
            for box in r.boxes:
                cls_id = int(box.cls)
                cls_name = model.names[cls_id].lower()
                conf = box.conf[0].item()

                if cls_name in ['car', 'truck', 'motorcycle', 'bus']:
                    bx1, by1, bx2, by2 = map(int, box.xyxy[0])

                    # Gambar kotak bounding box warna biru
                    cv2.rectangle(frame, (bx1, by1), (bx2, by2), (0, 0, 255), 2)
                    label = f"{cls_name}"
                    cv2.putText(frame, label, (bx1, by1 - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 0, 255), 2)

                    box_area = (bx2 - bx1) * (by2 - by1)
                    bbox_poly = Polygon([(bx1, by1), (bx2, by1), (bx2, by2), (bx1, by2)])

                    for slot in slots:
                        slot_poly = Polygon(slot["area"])
                        if bbox_poly.intersects(slot_poly):
                            overlap = bbox_poly.intersection(slot_poly).area / box_area
                            if overlap > 0.05:
                                slot["occupied"] = True
                                slot["last_detected_time"] = current_time

        # Update status slot dan gambar poligon slot
        for slot in slots:
            nomor_slot = slot["nomor_slot"]
            is_occupied = (current_time - slot["last_detected_time"]) <= BUFFER_TIME
            new_status = "Terisi" if is_occupied else "Tersedia"

            if slot["status"] != new_status:
                slot["status"] = new_status
                update_slot_status_to_api(subzona_id, nomor_slot, new_status)
                if new_status == "Terisi":
                    slot["start_time"] = current_time
                else:
                    if slot["logged"]:
                        kirim_log_parkir("Tersedia", subzona_id, nomor_slot)
                    slot["start_time"] = None
                    slot["logged"] = False

            elif new_status == "Terisi" and not slot["logged"]:
                if slot["start_time"] and current_time - slot["start_time"] >= 10:
                    kirim_log_parkir("Terisi", subzona_id, nomor_slot)
                    slot["logged"] = True

            if not is_occupied:
                slot["logged"] = False

            warna = (0, 0, 255) if new_status == "Terisi" else (0, 255, 0)
            x1, y1 = slot["area"][0]
            x2, y2 = slot["area"][2]
            cv2.polylines(frame, [np.array(slot["area"], dtype=np.int32)], True, warna, 2)
            cv2.putText(frame, f"{nomor_slot}: {new_status}", (x1, y2 + 20),
                        cv2.FONT_HERSHEY_SIMPLEX, 0.6, warna, 2)
            if new_status == "Terisi" and slot["start_time"]:
                durasi = int(current_time - slot["start_time"])
                cv2.putText(frame, f"Durasi: {durasi}s", (x1, y2 + 45),
                            cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 0), 1)

        with state['lock']:
            state['last_frame'] = frame.copy()

        time.sleep(0.03)

def start_all_cameras(camera_subzona_list):
    for cam_id, subzona_id in camera_subzona_list:
        threading.Thread(target=camera_worker, args=(cam_id, subzona_id), daemon=True).start()


@app.route('/clean_video_feed')
def clean_video_feed():
    camera_id = int(request.args.get('camera_id', DEFAULT_CAMERA_ID))
    def gen():
        while True:
            state = camera_states.get(camera_id)
            if not state:
                continue
            with state['lock']:
                frame = state['clean_frame']
            if frame is None:
                continue
            ret, buffer = cv2.imencode('.jpg', frame)
            if not ret:
                continue
            frame_bytes = buffer.tobytes()
            yield (b'--frame\r\n'
                b'Content-Type: image/jpeg\r\n'
                + f'Content-Length: {len(frame_bytes)}\r\n'.encode() +
                b'\r\n' + frame_bytes + b'\r\n')

            time.sleep(0.03)
    return Response(gen(), mimetype='multipart/x-mixed-replace; boundary=frame')


@app.route('/video_feed')
def video_feed():
    camera_id = int(request.args.get('camera_id', DEFAULT_CAMERA_ID))
    def gen():
        while True:
            state = camera_states.get(camera_id)
            if not state:
                continue
            with state['lock']:
                frame = state['last_frame']
            if frame is None:
                continue
            ret, buffer = cv2.imencode('.jpg', frame)
            if not ret:
                continue
            frame_bytes = buffer.tobytes()
            yield (b'--frame\r\n'
                b'Content-Type: image/jpeg\r\n'
                + f'Content-Length: {len(frame_bytes)}\r\n'.encode() +
                b'\r\n' + frame_bytes + b'\r\n')

            time.sleep(0.03)
    return Response(gen(), mimetype='multipart/x-mixed-replace; boundary=frame')

@app.route('/update_slots/<int:subzona_id>')
def update_slots(subzona_id):
    for cam_id, state in camera_states.items():
        if state['subzona_id'] == subzona_id:
            with state['lock']:
                state['slots'] = get_slots_config(subzona_id)
            return f"Updated slot config for subzona {subzona_id} on camera {cam_id}"
    return f"No camera found for subzona {subzona_id}"

if __name__ == '__main__':
    try:
        response = requests.get("http://127.0.0.1:8000/api/list-subzona")
        response.raise_for_status()
        data = response.json()

        camera_subzona_list = [(item['camera_id'], item['id']) for item in data]
        print(f"[INFO] Kamera yang dijalankan: {camera_subzona_list}")

        start_all_cameras(camera_subzona_list)

    except Exception as e:
        print(f"[ERROR] Tidak bisa ambil daftar subzona dari API: {e}")

    app.run(host='0.0.0.0', port=5000, threaded=True)
