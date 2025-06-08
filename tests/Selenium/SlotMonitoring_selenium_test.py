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
email_input.send_keys("fakhrimuhammadadib@gmail.com")
time.sleep(3)

password_input = driver.find_element(By.NAME, "password")
password_input.send_keys("12345")
time.sleep(3)

login_path1 = driver.find_element(By.NAME, 'login_path')
login_path1.click()
time.sleep(3)

target_element = driver.find_element(By.ID, "realtime-card")
driver.execute_script("arguments[0].scrollIntoView({behavior: 'smooth', block: 'center'});", target_element)
time.sleep(3)

realTime_path = driver.find_element(By.ID, "realtime-card")
realTime_path.click()
time.sleep(5)

peta_path = driver.find_element(By.ID, 'peta')
peta_path.click()
time.sleep(3)

closePeta_Path = driver.find_element(By.ID, 'close')
closePeta_Path.click()
time.sleep(3)

driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
time.sleep(3)

zona_path_element = driver.find_element(By.ID, 'zona-select')
zona_path_element.click()
zona_path = Select(zona_path_element)
zona_path.select_by_visible_text('Zona A')
time.sleep(3)

subzona_path_element = driver.find_element(By.ID, 'subzona-select')
subzona_path_element.click()
subzona_path = Select(subzona_path_element)
subzona_path.select_by_visible_text('1.1')
time.sleep(3)

tampilkan_path = driver.find_element(By.ID, 'tampilkan')
tampilkan_path.click()
time.sleep(10)

driver.quit()
