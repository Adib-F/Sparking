import cv2
import numpy as np

clicked_points = []

# Fungsi untuk handle klik
def click_event(event, x, y, flags, params):
    global frame

    if event == cv2.EVENT_LBUTTONDOWN:
        clicked_points.append((x, y))
        print(f"Klik di: {x}, {y}")

        # Gambar titik
        cv2.circle(frame, (x, y), 5, (0, 0, 255), -1)
        cv2.imshow("Tentukan Polygon", frame)

        # Jika sudah 4 titik, gambar polygon
        if len(clicked_points) == 4:
            pts = np.array(clicked_points, np.int32)
            pts = pts.reshape((-1, 1, 2))
            frame_poly = frame.copy()
            cv2.polylines(frame_poly, [pts], isClosed=True, color=(0, 255, 0), thickness=2)

            # Gambar area transparan
            overlay = frame_poly.copy()
            cv2.fillPoly(overlay, [pts], color=(0, 255, 0))
            alpha = 0.3
            cv2.addWeighted(overlay, alpha, frame_poly, 1 - alpha, 0, frame_poly)

            cv2.imshow("Tentukan Polygon", frame_poly)

            print("\nTitik polygon (urutan klik):")
            for i, pt in enumerate(clicked_points):
                print(f"Titik {i+1}: x={pt[0]}, y={pt[1]}")

# Ambil gambar dari webcam
cap = cv2.VideoCapture(0)

# Cek resolusi webcam
width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
print(f"Resolusi webcam: {width}x{height}")

# Ambil 1 frame untuk ditampilkan
ret, frame = cap.read()
if not ret:
    print("Gagal mengambil gambar dari webcam")
    cap.release()
    exit()

cv2.imshow("Tentukan Polygon", frame)
cv2.setMouseCallback("Tentukan Polygon", click_event)

# Loop tunggu ESC
while True:
    key = cv2.waitKey(1) & 0xFF
    if key == 27:  # ESC
        break

cap.release()
cv2.destroyAllWindows()
