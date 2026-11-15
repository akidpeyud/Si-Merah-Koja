# 🚒 SIMERAH KOJA

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4.0-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)

**SIMERAH KOJA** (*Sistem Informasi Manajemen Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi*) adalah sistem informasi terpadu untuk mendukung operasional **Dinas Pemadam Kebakaran dan Penyelamatan (Disdamkartan) Kota Jambi**. Aplikasi ini menyediakan layanan publik bagi masyarakat/perusahaan serta modul operasional internal bagi setiap bidang/bagian.

---

## 📦 Teknologi & Paket Utama

- **Backend:** PHP `^8.3`, Laravel `^13.17`
- **Manajemen Role & Hak Akses:** `spatie/laravel-permission` (`^8.3`)
- **Ekspor & Impor Dokumen:**
  - `maatwebsite/excel` (`^4.0`) — Ekspor/impor laporan Excel (`.xlsx` / `.csv`)
  - `barryvdh/laravel-dompdf` (`^3.1`) — Cetak laporan & surat PDF
- **Frontend:** Blade Template, Bootstrap `5.3.2`, Font Awesome `6.4.0`, Tailwind CSS `^4.0`, Vite `^8.0`
- **Peta Interaktif (SIGAPKAR):** Leaflet.js & OpenStreetMap
- **Code Style & Testing:** Laravel Pint (`^1.27`), PHPUnit (`^12.5`)

---

## 🏛️ Modul & Fitur Aplikasi

### 1. Portal Publik & Layanan Masyarakat
- **Beranda & Informasi Publik:** Statistik layanan, galeri kejadian (Pemadaman, Penyelamatan & Evakuasi), Edu Damkar, Infografis, Media Informasi, Ujung-ujung Damkar, Pengumuman, dan Survei IKM (*Indeks Kepuasan Masyarakat*).
- **Profil Instansi:** Visi & Misi, SOTK, Tupoksi, Kepegawaian, Program & Kegiatan, serta Cascading.
- **Layanan & Fasilitas (Wajib Login Pemohon):**
  1. Rekomendasi Penilaian Proteksi Kebakaran Bangunan Gedung & Lingkungan (**RPKBGL**)
  2. Permohonan Sertifikat Keselamatan Kebakaran (**SKK** Baru & Perpanjangan)
  3. Rekomendasi Izin Pengamanan Event Keramaian
  4. Permohonan Penggunaan Sarana Pemadam Kebakaran
  5. Kunjungan, Edukasi, dan Sosialisasi
  6. Pendaftaran Relawan Pemadam Kebakaran (**REDKAR**)
- **Dokumen, SOP & Produk Hukum:**
  - **SOP (6 Kategori):** Pencegahan, Pemadaman Kebakaran, Penyelamatan & Evakuasi, Sarana & Prasarana, Kepegawaian, dan Keuangan.
  - **Produk Hukum:** Undang-Undang, Peraturan Pemerintah, Peraturan Presiden, Peraturan Menteri, Peraturan Daerah, dan Peraturan Kepala Daerah.
  - **Dokumen Publik:** Renstra, Renja, SPM, SAKIP, dan LPPD.
- **Sarpras Publik & SIGAPKAR:** Informasi Sarana & Prasarana per Pos Pemadam, Sumber Air, Hidran Kota, serta Peta Titik Rawan & Pos (**SIGAPKAR**).

### 2. Dashboard Operasional Internal (`/internal/index`)
- **Bagian Pemadaman & Penyelamatan (`Damtan`):** Laporan kejadian kebakaran & penyelamatan, surat keterangan korban kebakaran, kelola izin keramaian, kelola penggunaan sarana, rekapitulasi layanan & objek kebakaran.
- **Bagian Sarana & Prasarana (`Sapra`):** Kelola Pos Pemadam, sarana & prasarana Mako/Pos, sarana penyelamatan, sarana pemeriksaan, hidran kota & gedung, sumber air, kebutuhan & pengadaan sarpras, distribusi barang staf.
- **Bagian Pencegahan (`Pencegahan`):** Kelola permohonan RPKBGL, SKK, Edukasi & Kunjungan Sekolah, REDKAR, Inspeksi Bangunan & *Fire Drill*, Sosialisasi, Pelatihan Keluarga/Umum, Pembinaan, serta Peningkatan Kapasitas Aparatur (DIKSAR, DIKLAT F1/F2, Rescue, MFR, Operator, Inspektur, PPL) & Peta SIGAP.
- **Bagian Sekretariat (`Sekretariat`):** Data ASN, DUK Kepegawaian, Program Kerja & SOP, Dokumen Publik, Produk Hukum, dan Profil Instansi.
- **Manajemen Informasi (`Operator`):** Kelola Berita, Berita Medsos (tarik metadata otomatis), Infografis, Edu Damkar, Ujung-ujung Damkar, Dokumentasi Kejadian, Pengumuman, dan rekap survei IKM.

---

## 🛡️ Matriks Hak Akses (Role & Permission)

Sistem menggunakan `spatie/laravel-permission` dengan aturan umum: **seluruh pegawai yang login dapat melihat data (Read-Only)** pada modul internal, sedangkan aksi **Tambah, Ubah, Verifikasi, dan Hapus (CRUD)** dibatasi sesuai bagian masing-masing:

| Role | Hak Akses Utama (CRUD) | Akses Modul Lain |
| :--- | :--- | :--- |
| 👑 **Super User** | Akses penuh (**Full CRUD**) ke seluruh modul internal & kelola pengguna | Semua modul |
| 🗂️ **Sekretariat** | CRUD Data ASN (`asn-list`, `asn-create`, `asn-edit`, `asn-delete`), DUK, Dokumen Publik, Program Kerja/SOP, Produk Hukum, Profil Instansi | *Read-only* |
| 🔥 **Damtan** | CRUD Laporan Pemadaman/Penyelamatan, Surat Korban, Izin Keramaian, Penggunaan Sarana, Rekap Layanan & Objek | *Read-only* |
| 🛠️ **Sapra** | CRUD Sarana & Prasarana Mako/Pos, Kelola Pos, Hidran Kota/Gedung, Kebutuhan & Pengadaan Sarpras, Distribusi Staf | *Read-only* |
| 🛡️ **Pencegahan** | CRUD RPKBGL, SKK, REDKAR, Edukasi/Kunjungan, Inspeksi & *Fire Drill*, Pemberdayaan Masyarakat, Diklat Aparatur | *Read-only* |
| 📰 **Operator** | CRUD Berita, Berita Medsos, Infografis, Edu Damkar, Ujung Damkar, Kejadian Publik, Pengumuman, & Kelola IKM | *Read-only* |

---

## 🔑 Kredensial Akses Uji Coba (Seeder)

Data akun di bawah ini dibuat melalui `UsersTableSeeder` (`database/seeders/UsersTableSeeder.php`).

### 🏢 1. Akun Internal (Pegawai / Admin / Operator)
- **URL Login:** `/login` (dapat masuk menggunakan **Email** atau **Nomor Pegawai**)
- **Password Semua Akun Internal:** `Damkar123`

| Nama Lengkap | Email Login | Nomor Pegawai | Hak Akses (Role) |
| :--- | :--- | :--- | :--- |
| **Andika Dwi Putra** | `dwiputdika@gmail.com` | `23112021` | 👑 **Super User** |
| **Dhimas Zaky Abiyyu** | `dhimaszaky102005@gmail.com` | `23112018` | 🛠️ **Sapra** |
| **Ananda Gita April** | `siipooke@gmail.com` | `23112017` | 🗂️ **Sekretariat** |
| **M. Suwanda** | `mebius3105@gmail.com` | `23111006` | 🔥 **Damtan** |
| **M Ariffan Hidayah** | `erikpramana68@gmail.com` | `23112007` | 🛡️ **Pencegahan** |
| **Natasha Romanoff** | `adingbing11@gmail.com` | `231120xx` | 📰 **Operator** |
| **Operator Berita** | `berita.damkar@gmail.com` | `23113001` | 📰 **Operator** |

### 📝 2. Akun Pemohon Publik (Masyarakat / Perusahaan)
- **URL Login:** `/pemohon/login` (atau daftar baru di `/pemohon/register`)
- **Password Akun Pemohon:** `password123`

| Nama Pemohon | Email Login | NIK | No. WhatsApp |
| :--- | :--- | :--- | :--- |
| **Natasha Romanoff** | `natasha@gmail.com` | `1571234567890002` | `081234567890` |

---

## 📁 Struktur Direktori Utama

```text
simerahkoja/
├── app/
│   ├── Exports/                  # Kelas ekspor Excel (Maatwebsite Excel)
│   ├── Http/
│   │   ├── Controllers/          # Controller publik & internal per modul
│   │   └── Middleware/           # Middleware autentikasi (termasuk CekLoginPemohon)
│   └── Models/                   # Model Eloquent
├── database/
│   ├── migrations/               # Migrasi skema database
│   └── seeders/                  # Seeder pengguna, sarpras, laporan, REDKAR, & dokumen SOP
├── public/
│   ├── images/                   # Aset gambar & logo instansi
│   └── uploads/                  # Unggahan dokumen modul internal/publik
├── resources/
│   └── views/
│       ├── components/           # Komponen global (visit-counter, global-feedback)
│       ├── galery/               # Halaman publik berita, kejadian, pengumuman, IKM
│       ├── homepage/             # Halaman utama (landing page)
│       ├── informasi_layanan/    # Halaman statistik & informasi layanan publik
│       ├── internal/             # Halaman operasional internal (damtan, pencegahan, sapra, dll.)
│       ├── layouts/              # Layout dashboard internal & partial publik (hero-logos, nav, sidebar)
│       ├── layanan-fasilitas/    # Halaman pengajuan layanan publik (RPKBGL, SKK, Keramaian, dll.)
│       ├── login/                # Halaman autentikasi pegawai internal
│       ├── pemohon/              # Halaman autentikasi & kelola pemohon publik
│       ├── programkerja/         # Halaman program kerja & SOP
│       ├── public/               # Halaman profil instansi, SOP per bagian, produk hukum, dokumen publik
│       └── sapra_home/           # Halaman publik katalog sarana & prasarana
├── routes/
│   └── web.php                   # Definisi seluruh rute aplikasi
└── storage/
    └── app/public/
        ├── dokumen/              # Penyimpanan file dokumen SOP & publik aktif
        └── seed-files/sop/       # File master PDF SOP untuk kebutuhan seeding (terlacak di Git)
```

---

## 🚀 Cara Instalasi & Menjalankan Proyek di Lokal

1. **Clone repository & masuk ke direktori proyek:**
   ```bash
   git clone <url-repository>
   cd simerahkoja
   ```

2. **Instal dependensi PHP & JavaScript:**
   ```bash
   composer install
   npm install
   ```

3. **Salin konfigurasi environment & buat Application Key:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *(Sesuaikan konfigurasi database `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di dalam file `.env`).*

4. **Buat symbolic link untuk storage publik:**
   ```bash
   php artisan storage:link
   ```

5. **Jalankan migrasi & seeder database:**
   ```bash
   php artisan migrate --seed
   ```
   Atau jika ingin menjalankan seeder tertentu secara spesifik:
   ```bash
   # Seeder akun pengguna, role Spatie, & pemohon
   php artisan db:seed --class=UsersTableSeeder

   # Seeder dokumen SOP beserta penyalinan file PDF dari storage/app/public/seed-files/sop
   php artisan db:seed --class=DokumenSopSeeder

   # Seeder data anggota REDKAR & data ASN
   php artisan db:seed --class=DataAnggotaRedkar
   php artisan db:seed --class=DataAsnSeeder
   ```

6. **Build aset frontend & jalankan server lokal:**
   ```bash
   npm run build
   php artisan serve
   ```
   Atau jalankan server development terpadu:
   ```bash
   composer run dev
   ```

---

## 📏 Aturan Pengembangan Proyek

Berdasarkan panduan internal proyek (`GEMINI.md` & `AGENTS.md`):
- **Standar Kode PHP:** Menggunakan PHP `8.3` dengan *explicit return types*, *type hints*, dan diformat menggunakan **Laravel Pint**:
  ```bash
  vendor/bin/pint --dirty
  ```
- **Database & Migrasi:** Jangan mengubah file migrasi yang sudah pernah dijalankan; selalu buat migrasi baru (`php artisan make:migration`).
- **Struktur Folder & Dependensi:** Pertahankan struktur direktori yang sudah ada dan jangan menambah/mengubah paket (`composer` / `npm`) atau kredensial `.env` tanpa persetujuan tim.
- **Pengujian:** Gunakan PHPUnit melalui perintah `php artisan test --compact`.

