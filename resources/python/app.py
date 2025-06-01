from flask import Flask, Response, request
from ultralytics import YOLO
import numpy as np
import cv2
import time
import requests
from shapely.geometry import Polygon

app = Flask(__name__)
model = YOLO("yolov8n.pt")

camera_states = {}

DEFAULT_CAMERA_ID = 0
BUFFER_TIME = 5

def get_slots_config(subzona_id):
    """Ambil konfigurasi slot dari API"""
    try:
        API_URL = f"http://127.0.0.1:8000/api/real-time/subzona/{subzona_id}"
        response = requests.get(API_URL)
        if response.status_code == 200:
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
                    "occupied": False
                })
            return slots
    except Exception as e:
        print(f"[ERROR] Gagal mengambil konfigurasi slot: {e}")
    return []


def update_slot_status_to_api(subzona_id, nomor_slot, status):
    try:
        API_URL = "http://127.0.0.1:8000/api/update-status-slot"
        response = requests.post(API_URL, json={
            "subzona_id": subzona_id,
            "nomor_slot": nomor_slot,
            "keterangan": status
        })
        print(f"[API] Subzona {subzona_id}, Slot {nomor_slot}: {status} => {response.status_code}, {response.text}")
    except Exception as e:
        print(f"[ERROR] Kirim status gagal: {e}")


def initialize_camera_state(camera_id, subzona_id=None):
    """Inisialisasi state kamera"""
    if camera_id not in camera_states:
        slots = get_slots_config(subzona_id) if subzona_id else []
        camera_states[camera_id] = {
            'cap': cv2.VideoCapture(camera_id),
            'slots': slots,
            'subzona_id': subzona_id,
            'last_update': time.time()
        }


def generate_frames(camera_id, subzona_id):
    print(f"Memproses frame untuk subzona {subzona_id}")

    state = camera_states.get(camera_id)
    if state is None:
        initialize_camera_state(camera_id, subzona_id)
        state = camera_states[camera_id]

    cap = state['cap']
    slots = state['slots']

    while True:
        success, frame = cap.read()
        if not success:
            break

        results = model(frame, verbose=False)

        for slot in slots:
            slot["occupied"] = False

        for r in results:
            for box in r.boxes:
                class_id = int(box.cls)
                class_name = model.names[class_id]
                if class_name.lower() in ['car', 'truck', 'motorcycle', 'bus']:
                    bx1, by1, bx2, by2 = map(int, box.xyxy[0])
                    box_area = (bx2 - bx1) * (by2 - by1)

                    cv2.rectangle(frame, (bx1, by1), (bx2, by2), (0, 0, 255), 2)
                    cv2.putText(frame, class_name, (bx1, by1 - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 255), 2)

                    bbox_polygon = Polygon([
                        (bx1, by1), (bx2, by1), (bx2, by2), (bx1, by2)
                    ])

                    for slot in slots:
                        slot_polygon = Polygon(slot["area"])
                        intersection_area = slot_polygon.intersection(bbox_polygon).area
                        overlap_ratio = intersection_area / box_area if box_area > 0 else 0

                        if overlap_ratio > 0.05:
                            slot["occupied"] = True
                            slot["last_detected_time"] = time.time()

        current_time = time.time()
        for slot in slots:
            x1, y1 = slot["area"][0]
            x2, y2 = slot["area"][2]
            nomor_slot = slot["nomor_slot"]

            is_occupied = (current_time - slot["last_detected_time"]) <= BUFFER_TIME
            new_status = "Terisi" if is_occupied else "Tersedia"
            warna = (0, 0, 255) if new_status == "Terisi" else (0, 255, 0)

            if slot["status"] != new_status:
                update_slot_status_to_api(state['subzona_id'], nomor_slot, new_status)
                slot["status"] = new_status

            if new_status == "Terisi":
                if slot["start_time"] is None:
                    slot["start_time"] = current_time
                durasi = int(current_time - slot["start_time"])
            else:
                durasi = 0
                slot["start_time"] = None

            cv2.polylines(frame, [np.array(slot["area"], dtype=np.int32)], isClosed=True, color=warna, thickness=2)
            cv2.putText(frame, f"{nomor_slot}: {new_status}", (x1, y2 + 20),
                        cv2.FONT_HERSHEY_SIMPLEX, 0.6, warna, 2)

            if new_status == "Terisi":
                cv2.putText(frame, f"Durasi: {durasi}s", (x1, y2 + 45),
                            cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 0), 1)

        ret, buffer = cv2.imencode('.jpg', frame)
        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + buffer.tobytes() + b'\r\n')


@app.route('/video_feed')
def video_feed():
    try:
        camera_id = int(request.args.get('camera_id', 0))
        subzona_id = int(request.args.get('subzona_id', 0))

        if subzona_id == 0:
            raise ValueError("subzona_id required")

        print(f"Stream dimulai untuk camera_id={camera_id}, subzona_id={subzona_id}")

        return Response(
            generate_frames(camera_id, subzona_id),
            mimetype='multipart/x-mixed-replace; boundary=frame'
        )
    except Exception as e:
        print(f"Error: {str(e)}")
        return str(e), 400


@app.route('/update_slots/<int:subzona_id>')
def update_slots(subzona_id):
    """Update ulang slot untuk kamera tertentu"""
    camera_id = int(request.args.get('camera_id', DEFAULT_CAMERA_ID))
    if camera_id in camera_states:
        camera_states[camera_id]['slots'] = get_slots_config(subzona_id)
        camera_states[camera_id]['subzona_id'] = subzona_id
        return {'status': 'success', 'message': f'Slots updated for camera {camera_id}'}
    return {'status': 'error', 'message': 'Camera not initialized'}


if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
