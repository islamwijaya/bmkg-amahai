# Panduan Konfigurasi Database (MySQL) untuk Deployment

Dokumen ini berisi langkah-langkah untuk mengkonfigurasi database dari **SQLite** (lokal) ke **MySQL** (produksi) pada website BMKG Amahai.

---

## 1. Persiapan Database di Server
Sebelum melakukan konfigurasi di Laravel, siapkan database pada panel hosting (aaPanel/cPanel/DirectAdmin):
1. Buat database baru (contoh: `bmkg_amahai_db`).
2. Buat user database baru.
3. Hubungkan user tersebut ke database dengan hak akses penuh (**All Privileges**).
4. Catat detail berikut:
   - **DB_HOST**: Biasanya `127.0.0.1` atau `localhost`.
   - **DB_NAME**: Nama database yang dibuat.
   - **DB_USER**: Username database yang dibuat.
   - **DB_PASS**: Password user database.

## 2. Konfigurasi Environment (`.env`)
Ubah file `.env` di server produksi Anda. Cari bagian database dan sesuaikan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=user_database_anda
DB_PASSWORD=password_database_anda
```

> [!IMPORTANT]
> Pastikan `APP_ENV=production` dan `APP_DEBUG=false` pada server produksi untuk menjaga keamanan data.

## 3. Proses Migrasi dan Seeding
Setelah file `.env` dikonfigurasi, jalankan perintah berikut secara berurutan di terminal server:

### A. Bersihkan Cache Konfigurasi
Agar Laravel membaca perubahan `.env` yang baru:
```bash
php artisan config:clear
```

### B. Jalankan Migrasi Tabel
Membuat struktur tabel di MySQL:
```bash
php artisan migrate --force
```

### C. Jalankan Seeding Data
Mengisi data default seperti pengaturan website, daftar pegawai, dan konten awal lainnya:
```bash
php artisan db:seed --force
```

## 4. Penanganan Masalah Umum (Troubleshooting)

### Error: "Specified key was too long"
Jika Anda menggunakan versi MySQL lama (di bawah 5.7.7), tambahkan baris berikut di `app/Providers/AppServiceProvider.php`:
```php
use Illuminate\Support\Facades\Schema;

public function boot(): void {
    Schema::defaultStringLength(191);
}
```

### Error: "Access denied for user"
- Periksa kembali apakah username dan password di `.env` sudah benar.
- Pastikan user database memiliki hak akses ke database tersebut.
- Jika menggunakan hosting, pastikan host diatur ke `127.0.0.1` atau `localhost`.

## 5. Membuat Akun Admin Pertama
Jika database masih kosong dan Anda belum memiliki akses dashboard, gunakan **Tinker** untuk membuat admin secara cepat:

1. Masuk ke Tinker: `php artisan tinker`
2. Jalankan perintah PHP berikut:
```php
\App\Models\User::create([
    'name' => 'Administrator',
    'email' => 'admin@mail.com',
    'password' => bcrypt('password_anda_disini'),
    'is_admin' => true
]);
```

---
*Dokumen ini dibuat untuk membantu proses deployment website BMKG Amahai.*
