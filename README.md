# 🚒 SIMERAH KOJA

![Status](https://img.shields.io/badge/Status-Work_in_Progress-orange?style=for-the-badge)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

**SIMERAH KOJA** adalah Sistem Informasi Manajemen terpadu yang dirancang khusus untuk memfasilitasi operasional Dinas Pemadam Kebakaran dan Penyelamatan. Aplikasi ini mencakup berbagai modul komprehensif mulai dari Manajemen Kepegawaian, Pencegahan Kebakaran, Laporan Pemadaman, Sarana & Prasarana (Sapra), hingga portal untuk Masyarakat dan Relawan Pemadam Kebakaran (REDKAR).

---

## 🔑 Akses Akun Uji Coba (Login Credentials)

Untuk mempermudah proses _development_ dan _testing_, database telah dilengkapi dengan _seeder_. Berikut adalah daftar akun yang bisa digunakan oleh tim untuk _login_:

### 1. Akun Internal (Admin / Pegawai / Operator)

**Halaman Login:** `/login`

> **Catatan:** Password _default_ untuk akun internal yang dienkripsi pada seeder biasanya adalah `password` atau `password123`.

| Nama Lengkap           | Email                        | Hak Akses (Role)      |
| :--------------------- | :--------------------------- | :-------------------- |
| **Andika Dwi Putra**   | `dwiputdika@gmail.com`       | 👑 **Super User**     |
| **Ananda Gita April**  | `siipooke@gmail.com`         | 👑 **Super User**     |
| **Dhimas Zaky Abiyyu** | `dhimaszaky102005@gmail.com` | 👤 **User** (Pegawai) |
| **M Ariffan Hidayah**  | `erikpramana68@gmail.com`    | 👤 **User** (Pegawai) |
| **Operator Berita**    | `berita.damkar@gmail.com`    | 📰 **Operator**       |

### 2. Akun Anggota REDKAR (Relawan)

**Halaman Login:** `/login-redkar`

> **Catatan:** Password untuk semua akun REDKAR di bawah ini adalah: `password123`

| Nama Anggota         | Username Login | Status Akun           |
| :------------------- | :------------- | :-------------------- |
| **Natasha Romanoff** | `natasha`      | 🟢 Aktif              |
| **Siti Aminah**      | `siti_relawan` | 🟢 Aktif              |
| **Budi Santoso**     | `budi_redkar`  | 🔴 Nonaktif (Pending) |

### 3. Akun Pemohon Publik (Layanan Masyarakat)

**Halaman Login:** `/pemohon/login`

> **Catatan:** Password untuk akun pemohon di bawah ini adalah: `password123`

| Nama Pemohon         | Email Login         | Role           |
| :------------------- | :------------------ | :------------- |
| **Natasha Romanoff** | `natasha@gmail.com` | Pemohon Publik |

---

## 🚀 Cara Instalasi & Menjalankan Project Local

Bagi anggota tim yang baru bergabung, ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal:

1. **Clone repository ini:**
    ```bash
    git clone <url-repository-kalian>
    cd si-merah-koja
    ```
