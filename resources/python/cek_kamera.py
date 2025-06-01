import cv2

camera_id = 0
cap = cv2.VideoCapture(camera_id)

if cap.isOpened():
    print(f"Kamera {camera_id} berhasil dibuka.")
    while True:
        ret, frame = cap.read()
        if not ret:
            print("Gagal membaca frame.")
            break
        cv2.imshow(f"Kamera {camera_id}", frame)
        if cv2.waitKey(1) == 27:  # ESC
            break
else:
    print(f"Gagal membuka kamera {camera_id}.")

cap.release()
cv2.destroyAllWindows()
