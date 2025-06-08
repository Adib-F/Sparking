from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

driver = webdriver.Firefox()

driver.maximize_window()
driver.get("http://localhost:8000")
time.sleep(3)

login_path = driver.find_element(By.XPATH, '//a[@href="javascript:void(0);"]')
login_path.click()
time.sleep(3)

email_input = driver.find_element(By.NAME, "email")
email_input.send_keys("admin@gmail.com")
time.sleep(3)

password_input = driver.find_element(By.NAME, "password")
password_input.send_keys("12345")
time.sleep(3)

login_path1 = driver.find_element(By.NAME, 'login_path')
login_path1.click()
time.sleep(3)

zona_path = driver.find_element(By.ID, 'zona')
zona_path.click()
time.sleep(3)

tambah_path = driver.find_element(By.ID, 'tambah-zonas')
tambah_path.click()
time.sleep(3)

zona_input = driver.find_element(By.ID, 'nama_zona')
zona_input.send_keys("Zona F")
time.sleep(3)

keterangan_input = driver.find_element(By.ID, 'keterangan')
keterangan_input.send_keys("zona ini biasa nya dekat banget dengan tempat olahraga")
time.sleep(3)

input_foto = driver.find_element(By.ID, "fotozona")
input_foto.send_keys(r"C:\Laravel\Sparking\public\data_parkir\zona\Zona1.png")
time.sleep(3)

button_path = driver.find_element(By.ID, 'submit')
button_path.click()
time.sleep(5)

driver.quit()
