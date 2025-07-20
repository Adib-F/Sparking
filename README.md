# SPARKING | ParkirCerdasBatam: Analysis parkir dan kondisi kepadatan jalan menggunakan AI dan IoT

## Description

Sparking is a smart web-based system that utilizes Internet of Things (IoT) and Artificial Intelligence (AI) technologies. This system was developed in response to a common issue experienced in certain conditions around the Politeknik Negeri Batam area—the difficulty of finding available parking spaces. During peak hours or busy events, drivers often struggle to locate open parking spots, leading to wasted time, congestion, and frustration. Sparking aims to solve this problem by providing a smarter, more efficient way to manage and monitor parking availability in real time.

The system has 2 actors, namely user and admin. The system has 2 main features, namely real-time monitoring of slot availability and data analysis of parking area usage.
The development of Sparking is a continuation of the previous project, SIPPP. In the previous project, features such as registration, login, logout, vehicle monitoring, and password management were developed. While Sparking focuses on improving the features of registration, login, parking slot monitoring, and data analysis.

> 💻 **Live Demo**: [https://sparking-polibatam.up.railway.app/](https://sparking-polibatam.up.railway.app/)

   ![Poster](https://pbl.polibatam.ac.id/apps/image.php?file=dXBsb2Fkcy9wYmwvMzkwNC8zOTA0X1BPU1RFUi1QQkxfMjAyNTA3MTUucG5n)

---

## Teams
Project Manager:  
Miratul Khusna Mufida, S.ST, M.Sc 

Leader:  
3312301007 - Muhammad Adib Fakhri Siregar

Member:  
3312301025 – Nayla Nabillah Arishima  
3312301046 – Meizua Muhsana 
3312311133 - Grey Ari Daniel Simatupang 

---

## How to Start the Project

### 1. Clone this repository
***Clone repository ke komputer lokal Anda menggunakan perintah berikut:***
 ```bash
git clone https://github.com/zidanikvan22/smart-parking.git
```

### 2. Masuk ke Direktori Proyek  
***Setelah repository berhasil di-clone, pindah ke direktori proyek:***
```bash
cd Smart_parking
```

### 3. Install Dependencies
***Pastikan Composer dan node.js sudah terpasang di sistem Anda, lalu jalankan::***
```bash
composer install
```
```bash
npm install
```

### 4. Update Composer Autoload and Dependencies
***Jalankan perintah berikut untuk memperbarui autoload dan dependencies:***
```bash
composer dump-autoload
```

### 5. Rename File .env-example ke .env
***Ubah nama file .env-example menjadi .env. Anda bisa melakukannya langsung di terminal:***
```bash
mv .env-example .env
```

### 6. Generate Application Key
***Generate application key Laravel menggunakan perintah berikut:***
```bash
php artisan key:generate
```

### 7. Launch the App
***Untuk menjalankan aplikasi, gunakan perintah berikut:***
1. Jalankan Laravel Development Server:
```bash
php artisan serve
```
2. Jalankan Vite untuk development assets:
```bash
npm run dev
```

