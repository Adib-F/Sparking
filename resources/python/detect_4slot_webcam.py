from flask import Flask, Response
import cv2
from ultralytics import YOLO
import requests
import time

app = Flask(__name__)

# === Inisialisasi model YOLO ===
model = YOLO('yolov8n.pt')
print("Model YOLO berhasil dimuat")

# === Konfigurasi API ===
API_URL = "http://127.0.0.1:8000/api/update-slot-status"
SUBZONA_ID = 4

# === Inisialisasi kamera ===
cap = cv2.VideoCapture(1)
if not cap.isOpened():
    raise RuntimeError("Kamera tidak dapat diakses")

# === Daftar slot parkir ===
slots = [
    {"area": [100, 100, 250, 250], "nama": "A1", "status": "Tersedia", "start_time": None, "last_detected_time": 0},
    {"area": [270, 100, 420, 250], "nama": "A2", "status": "Tersedia", "start_time": None, "last_detected_time": 0},
    {"area": [440, 100, 590, 250], "nama": "A3", "status": "Tersedia", "start_time": None, "last_detected_time": 0},
    {"area": [610, 100, 760, 250], "nama": "A4", "status": "Tersedia", "start_time": None, "last_detected_time": 0},
]

last_api_update = time.time()
api_cooldown = 5
buffer_time = 5


def generate_frames():
    global last_api_update

    while True:
        ret, frame = cap.read()
        if not ret:
            continue

        results = model(frame, verbose=False)

        for slot in slots:
            slot['occupied'] = False

        for r in results:
            for box in r.boxes:
                class_id = int(box.cls)
                class_name = model.names[class_id]

                if class_name.lower() in ['car', 'truck', 'motorcycle', 'bus']:
                    bx1, by1, bx2, by2 = map(int, box.xyxy[0])
                    box_area = (bx2 - bx1) * (by2 - by1)
                    cv2.rectangle(frame, (bx1, by1), (bx2, by2), (0, 0, 255), 2)
                    cv2.putText(frame, class_name, (bx1, by1 - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 255, 255), 1)

                    for slot in slots:
                        x1, y1, x2, y2 = slot["area"]
                        overlap_x1 = max(x1, bx1)
                        overlap_y1 = max(y1, by1)
                        overlap_x2 = min(x2, bx2)
                        overlap_y2 = min(y2, by2)
                        overlap_area = max(0, overlap_x2 - overlap_x1) * max(0, overlap_y2 - overlap_y1)
                        overlap_ratio = overlap_area / box_area if box_area > 0 else 0

                        if overlap_ratio > 0.05:
                            slot["occupied"] = True
                            slot["last_detected_time"] = time.time()

        update_needed = False
        current_time = time.time()

        for i, slot in enumerate(slots):
            x1, y1, x2, y2 = slot["area"]
            slot_name = slot["nama"]

            is_occupied = (current_time - slot["last_detected_time"]) <= buffer_time
            new_status = "Terisi" if is_occupied else "Tersedia"
            color = (0, 0, 255) if new_status == "Terisi" else (0, 255, 0)

            if new_status == "Terisi":
                if slot["start_time"] is None:
                    slot["start_time"] = current_time
                duration = int(current_time - slot["start_time"])
            else:
                duration = 0
                slot["start_time"] = None

            cv2.rectangle(frame, (x1, y1), (x2, y2), color, 2)
            cv2.putText(frame, f"{slot_name}: {new_status}", (x1, y2 + 20), cv2.FONT_HERSHEY_SIMPLEX, 0.6, color, 2)
            if new_status == "Terisi":
                cv2.putText(frame, f"Durasi: {duration}s", (x1, y2 + 45), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 0), 1)

            if new_status != slot["status"]:
                update_needed = True
                slot["status"] = new_status

        if update_needed or (current_time - last_api_update) >= api_cooldown:
            payload = {
                "subzona_id": SUBZONA_ID,
                "slots": [{"nomor_slot": i + 1, "keterangan": s["status"]} for i, s in enumerate(slots)]
            }
            try:
                response = requests.post(API_URL, json=payload, timeout=3)
                if response.status_code == 200:
                    print(f"[API] OK: {response.text}")
                    last_api_update = current_time
                else:
                    print(f"[API] Error {response.status_code}: {response.text}")
            except Exception as e:
                print(f"[API] Gagal kirim: {e}")

        # Convert frame ke JPEG dan stream
        ret, buffer = cv2.imencode('.jpg', frame)
        frame = buffer.tobytes()

        yield (b'--frame\r\n'
               b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')


@app.route('/')
def index():
    return "Gunakan <a href='/video'>/video</a> untuk streaming"


@app.route('/video')
def video():
    return Response(generate_frames(), mimetype='multipart/x-mixed-replace; boundary=frame')


if __name__ == '__main__':
    app.run(debug=True)
