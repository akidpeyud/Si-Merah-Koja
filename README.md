# 🚒 SIMERAH KOJA

![Status](https://img.shields.io/badge/Status-Work_in_Progress-orange?style=for-the-badge)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

**SIMERAH KOJA** adalah Sistem Informasi Manajemen terpadu yang dirancang khusus untuk memfasilitasi operasional Dinas Pemadam Kebakaran dan Penyelamatan. Aplikasi ini mencakup berbagai modul komprehensif mulai dari Manajemen Kepegawaian, Pencegahan Kebakaran, Laporan Pemadaman, Sarana & Prasarana (Sapra), hingga portal untuk Masyarakat dan Relawan Pemadam Kebakaran (REDKAR).

---

## 🔑 Kredensial Akses Uji Coba (Login)

Untuk mempermudah proses _development_ dan _testing_, gunakan daftar akun di bawah ini. Pastikan Anda sudah menjalankan perintah `php artisan migrate:fresh --seed` sebelum mencoba _login_.

### 🏢 1. Akun Internal (Pegawai / Admin / Operator)

👉 **URL Login:** `http://localhost:8000/login`  
⚠️ **Password untuk semua akun internal:** `password`

| Nama Lengkap           | Email Login                  | Hak Akses (Role)      |
| :--------------------- | :--------------------------- | :-------------------- |
| **Andika Dwi Putra**   | `dwiputdika@gmail.com`       | 👑 **Super User**     |
| **Ananda Gita April**  | `siipooke@gmail.com`         | 👑 **Super User**     |
| **Dhimas Zaky Abiyyu** | `dhimaszaky102005@gmail.com` | 👤 **User** (Pegawai) |
| **M Ariffan Hidayah**  | `erikpramana68@gmail.com`    | 👤 **User** (Pegawai) |
| **M. Suwanda**         | `mebius3105@gmail.com`       | 👤 **User** (Pegawai) |
| **Natasha Romanoff**   | `adingbing11@gmail.com`      | 👤 **User** (Pegawai) |
| **Operator Berita**    | `berita.damkar@gmail.com`    | 📰 **Operator**       |

<br>

### 🧑‍🚒 2. Akun Anggota REDKAR (Relawan)

👉 **URL Login:** `http://localhost:8000/login-redkar`  
⚠️️ **Password untuk semua akun REDKAR:** `password123`

| Nama Relawan         | Username Login | Status Akun           |
| :------------------- | :------------- | :-------------------- |
| **Natasha Romanoff** | `natasha`      | 🟢 Aktif (Bisa Login) |
| **Siti Aminah**      | `siti_relawan` | 🟢 Aktif (Bisa Login) |
| **Budi Santoso**     | `budi_redkar`  | 🔴 Nonaktif (Pending) |

<br>

### 📝 3. Akun Pemohon Publik (Masyarakat/Perusahaan)

👉 **URL Login:** `http://localhost:8000/pemohon/login`  
⚠️ **Password untuk semua akun Pemohon:** `password123`

| Nama Pemohon         | Email Login         | Role           |
| :------------------- | :------------------ | :------------- |
| **Natasha Romanoff** | `natasha@gmail.com` | Pemohon Publik |
| **Steve Rogers**     | `steve@gmail.com`   | Pemohon Publik |

---

## 🚀 Cara Instalasi & Menjalankan Project Local

Bagi anggota tim yang baru bergabung, ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal:

1. **Clone repository ini:**
    ```bash
    git clone <url-repository-kalian>
    cd si-merah-koja
    ```
