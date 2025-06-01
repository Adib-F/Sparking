import cv2
import requests
from ultralytics import YOLO

# YOLO model
model = YOLO('yolov8n.pt')

# Laravel API endpoint
API_URL = "http://127.0.0.1:8000/api/update-slot-status"

# Subzona ID
SUBZONA_ID = 

# Path ke gambar
image_path = "source/motorcycle1.jpg"
image = cv2.imread(image_path)

# Parking slot coordinates and names
parking_slots = [
    [15, 341, 421, 1134],   # Slot 1
    [378, 388, 686, 1134],  # Slot 2
    [686, 415, 988, 1138],  # Slot 3
    [990, 485, 1366, 1170], # Slot 4
    [1272, 434, 1705, 1183],# Slot 5
    [1686, 449, 2132, 1208],# Slot 6
    [2008, 499, 2531, 1222] # Slot 7
]
slot_names = [f"Slot {i+1}" for i in range(len(parking_slots))]

# Perform object detection
results = model(image)

# Extract detection results
detected_classes = results[0].names
detected_labels = results[0].boxes.cls
detected_boxes = results[0].boxes.xyxy

slot_status = {}
occupied_slots = 0
empty_slots = 0

for idx, slot in enumerate(parking_slots):
    x1, y1, x2, y2 = slot
    slot_detected = False

    # Draw bounding box for the slot
    cv2.rectangle(image, (x1, y1), (x2, y2), (0, 255, 0), 2)  # Green box for slots
    cv2.putText(image, slot_names[idx], (x1, y1 - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 1)

    # Check if a vehicle is detected within this slot's coordinates
    for i, box in enumerate(detected_boxes):
        class_name = detected_classes[int(detected_labels[i])]
        if class_name in ['motorcycle']:
            # Check if the vehicle's bounding box is completely inside the parking slot
            bx1, by1, bx2, by2 = [int(coord) for coord in box]
            if bx1 >= x1 and bx2 <= x2 and by1 >= y1 and by2 <= y2:
                slot_detected = True

                # Draw bounding box and label on the detected vehicle
                cv2.rectangle(image, (bx1, by1), (bx2, by2), (0, 0, 255), 2)  # Red box for detected vehicle
                cv2.putText(image, class_name, (bx1, by1 - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 255, 255), 1)
                break

    # Update the slot status and counters
    status = "Terisi" if slot_detected else "Tersedia"
    slot_status[slot_names[idx]] = status
    if slot_detected:
        occupied_slots += 1
    else:
        empty_slots += 1

# Print the status of each slot
print("Status Slot Parkir:")
for name, status in slot_status.items():
    print(f"{name}: {status}")

# Annotate the image with the number of available and occupied slots
font = cv2.FONT_HERSHEY_SIMPLEX
cv2.putText(image, f"Slot Terisi: {occupied_slots}", (50, 50), font, 1, (0, 0, 255), 2, cv2.LINE_AA)
cv2.putText(image, f"Slot Tersedia: {empty_slots}", (50, 100), font, 1, (0, 255, 0), 2, cv2.LINE_AA)

# Prepare payload and send to API
payload = {
    "subzona_id": SUBZONA_ID,
    "slots": [{"nomor_slot": idx + 1, "keterangan": status} for idx, status in enumerate(slot_status.values())]
}

response = requests.post(API_URL, json=payload)
if response.status_code == 200:
    print("Data berhasil dikirim ke database")
else:
    print(f"Error: {response.status_code}, {response.text}")

# Save and display the annotated image
cv2.imwrite("annotated_image.jpg", image)

# Resize image for display
image_resized = cv2.resize(image, (800, 600))  # Resize ke ukuran tertentu
cv2.imshow("Parking Slot Detection", image_resized)
cv2.waitKey(0)
cv2.destroyAllWindows()
