# DISPERUMKIM Kota Bogor - Laravel Application

Aplikasi web untuk Dinas Perumahan Rakyat dan Kawasan Permukiman (DISPERUMKIM) Kota Bogor yang dibangun menggunakan framework Laravel.

## Fitur Utama

- **Dashboard Admin**: Panel admin untuk mengelola konten website
- **Manajemen Berita**: CRUD untuk berita dan pengumuman
- **Manajemen Galeri**: Upload dan kelola foto galeri
- **Manajemen Carousel**: Kelola slider gambar di halaman utama
- **Manajemen Menu**: Kelola menu navigasi website
- **Manajemen Dokumen**: Upload dan kelola dokumen publik

## Teknologi yang Digunakan

- **Backend**: Laravel 11.x
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **CSS Framework**: Bootstrap 5.3.3
- **Icons**: Font Awesome 6.4.2

## Struktur Project

```
Disperum/
├── app/
│   ├── Http/Controllers/     # Controller untuk CRUD operations
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── public/
│   ├── css/                # File CSS
│   └── js/                 # File JavaScript
├── resources/
│   └── views/              # Blade templates
└── routes/
    └── web.php             # Web routes
```

## Instalasi dan Setup

### Prerequisites
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL/MariaDB
- Web server (Apache/Nginx) atau PHP built-in server

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone [repository-url]
   cd Disperum
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database di .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=disperum
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migration**
   ```bash
   php artisan migrate
   ```

6. **Jalankan seeder (opsional)**
   ```bash
   php artisan db:seed --class=SampleDataSeeder
   ```

7. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

## Routes

### Halaman Utama
- `GET /` - Halaman utama website

### Admin Panel
- `GET /admin` - Dashboard admin

### API Endpoints
- `GET /api/beritas` - Daftar berita
- `POST /api/beritas` - Tambah berita baru
- `PUT /api/beritas/{id}` - Update berita
- `DELETE /api/beritas/{id}` - Hapus berita

- `GET /api/galeris` - Daftar galeri
- `POST /api/galeris` - Tambah galeri baru
- `PUT /api/galeris/{id}` - Update galeri
- `DELETE /api/galeris/{id}` - Hapus galeri

- `GET /api/carousels` - Daftar carousel
- `POST /api/carousels` - Tambah carousel baru
- `PUT /api/carousels/{id}` - Update carousel
- `DELETE /api/carousels/{id}` - Hapus carousel

- `GET /api/navbars` - Daftar menu navbar
- `POST /api/navbars` - Tambah menu navbar baru
- `PUT /api/navbars/{id}` - Update menu navbar
- `DELETE /api/navbars/{id}` - Hapus menu navbar

- `GET /api/dokumens` - Daftar dokumen
- `POST /api/dokumens` - Tambah dokumen baru
- `PUT /api/dokumens/{id}` - Update dokumen
- `DELETE /api/dokumens/{id}` - Hapus dokumen

- `GET /api/videos` - Daftar video
- `POST /api/videos` - Tambah video baru
- `PUT /api/videos/{id}` - Update video
- `DELETE /api/videos/{id}` - Hapus video

## Database Schema

### Tabel Beritas
- `id` - Primary key
- `judul` - Judul berita
- `kategori` - Kategori berita
- `tanggal` - Tanggal publikasi
- `isi` - Isi berita
- `gambar` - Gambar berita (base64)
- `created_at`, `updated_at` - Timestamps

### Tabel Galeris
- `id` - Primary key
- `judul` - Judul album
- `deskripsi` - Deskripsi foto
- `tanggal` - Tanggal upload
- `foto` - File foto (base64)
- `created_at`, `updated_at` - Timestamps

### Tabel Carousels
- `id` - Primary key
- `judul` - Judul slide
- `deskripsi` - Deskripsi slide
- `urutan` - Urutan tampilan
- `gambar` - File gambar (base64)
- `status` - Status aktif/nonaktif
- `created_at`, `updated_at` - Timestamps

### Tabel Navbars
- `id` - Primary key
- `nama` - Nama menu
- `icon` - Icon menu
- `link` - Link menu
- `is_dropdown` - Apakah dropdown menu
- `sub_menu` - Array sub menu (JSON)
- `urutan` - Urutan tampilan
- `is_active` - Status aktif
- `created_at`, `updated_at` - Timestamps

### Tabel Dokumens
- `id` - Primary key
- `nama` - Nama dokumen
- `keterangan` - Deskripsi dokumen
- `kategori` - Kategori dokumen
- `file` - File dokumen (base64)
- `created_at`, `updated_at` - Timestamps

### Tabel Videos
- `id` - Primary key
- `judul` - Judul video
- `deskripsi` - Deskripsi video
- `tanggal` - Tanggal upload
- `video_id` - YouTube video ID
- `url` - URL video YouTube
- `created_at`, `updated_at` - Timestamps

## Fitur Keamanan

- CSRF protection untuk semua form
- Validasi input di backend
- Sanitasi data sebelum disimpan ke database

## Penggunaan

### Halaman Utama
Akses melalui `http://localhost:8000/` untuk melihat website utama dengan carousel dan menu navigasi.

### Admin Panel
Akses melalui `http://localhost:8000/admin` untuk mengelola konten website.

## Kontribusi

Untuk berkontribusi pada project ini, silakan:
1. Fork repository
2. Buat feature branch
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi

Project ini dikembangkan untuk DISPERUMKIM Kota Bogor.

## Support


