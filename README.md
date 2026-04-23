# BMKG Amahai - Project Context & Knowledge Base

Daftar berikut adalah rangkuman keseluruhan (*knowledge base*) dari repositori aplikasi Website Stasiun Meteorologi Kelas III Amahai (BMKG Amahai).

## 1. Identitas & Teknologi Proyek (Stack)
Proyek ini adalah aplikasi web Full-Stack monolithic. Tidak menggunakan kerangka kerja (framework) JS terpisah seperti React/Vue secara penuh, melainkan mengandalkan ekosistem standar pendamping Laravel.

*   Framework Utama: Laravel 12
*   Bahasa Pemrograman: PHP 8.4 (menggunakan fitur *Constructor Property Promotion*, *Type Declarations* eksplisit)
*   Frontend / Styling: Tailwind CSS v3 (via Vite), Alpine.js v3 (untuk interaktivitas ringan seperti modal, dropdown, dan fetching API asinkron)
*   Database: Relasional (MySQL / MariaDB) yang dikelola via `Model::query()` Eloquent dan Migrations.
*   Testing: Pest 4 (untuk Unit & Feature test).
*   Local Server: Laragon.

---

## 2. Struktur Data / Model Utama (Eloquent Models)
Direktori: `app/Models/`
Berikut adalah entitas tabel yang mengelola data dinamis pada web:

1.  `Berita`: Mengelola artikel/informasi berita. Digunakan untuk halaman Informasi. Termasuk pembuatan slug otomatis.
2.  `Bulletin`: Mengelola file PDF publikasi/buletin bulanan.
3.  `KritikSaran`: Menyimpan masukan dari masyarakat (memerlukan kontak/identitas yang wajib).
4.  `Pegawai`: Data SDM institusi. Menyimpan relasi struktural (Jabatan, Foto, Kategori Unit seperti "Kepala UPT", "Subagi Tata Usaha", "Unit Operasional", dll).
5.  `Pengaduan`: Modul lapor layanan publik (terproteksi `throttle`).
6.  `PrakiraanCuaca`: Data cuaca untuk API internal/lokal.
7.  `Setting`: Mengelola konfigurasi dinamis (Sejarah, Visi Misi, Tugas Fungsi, Teks Running Banner, dll) tanpa perlu mengubah *source code*. Berbasis Key-Value.
8.  `Transparansi`: Dokumen/file publik terkait transparansi kinerja institusi.
9.  `User`: Administrator yang dapat masuk ke Panel Admin.
10. `Visitor`: Data rekaman pengunjung web (*Analytics* log internal).

---

## 3. Peta Modul Publik (Front-End)
Semua rute publik dideklarasikan di `routes/web.php`. View berada di `resources/views/pages/`.
*   Berita/Informasi: Daftar artikel dan baca berita lengkap (`/informasi`). Dilengkapi fitur SEO dinamis (Meta Tag otomatis di Controller).
*   Profil BMKG: Halaman statis/dinamis yang teksnya dapat diedit (`/profil/sejarah`, `/profil/visi-misi`, `/profil/tugas-fungsi`).
*   Struktur & SDM (`/profil/sdm`): Susunan organisasi yang dirender secara spesifik dengan desain grid responsif dan garis penghubung (*custom organizational chart*).
*   Data Ops (Cuaca & Satelit): Menampilkan citra satelit yang memilki fitur sinkronisasi langsung (tombol refresh) yang memanggil `/satelit/sync` dan dikontrol rate-limitnya oleh Middleware Throttle (`1,5`). Didesain memadukan controller asinkron + Alpine.js state.
*   Layanan Publik: Rute pendaftaran IKM, Tarif, Transparansi Kinerja, Pengaduan, dan Kritik Saran (Form Validation ketat via FormRequests).
*   Error Pages: Custom `404` dan `4xx` menggunakan rancangan minimalis berkonsep *sad emoticon*.

---

## 4. Peta Modul Administrator (Back-End)
Aplikasi ini menggunakan panel dasbor admin buatan sendiri (*Custom Admin Panel*, bukan Filament), diakses di rute utama `/admin/`. Menggunakan middleware `auth` dan proteksi gate/role `admin`.

Fitur Panel Admin Utama:
*   Admin Dashboard (`DashboardController`): Memiliki *summary cards* statistik operasional dan grafik interaktif (SVG-based charts) yang memilki filter periode (mingguan, bulanan, tahunan) serta desain visual berestetika tinggi (Tooltips interaktif detail). Terdapat sistem tabel log audit yang transparan.
*   Modul CRUD: Manajemen Berita (`AdminBeritaController`), Manajemen Buletin (`AdminBulletinController`), Manajemen Tim/Pegawai (`AdminPegawaiController`), dan Transparansi Kinerja.
*   Moderasi: Meninjau (dan menghapus) laporan Kritik & Saran.
*   Content Management (`SettingController`): Mengatur konten antarmuka publik yang dikodekan dinamis (Teks Berjalan/Running banner, Deskripsi Profil, Sejarah, Visi Misi) menggunakan database tabel `settings`.

---

## 5. Standar Konvensi & Aturan (Rules for AI)
Pedoman wajib yang berlaku kuat jika di masa depan Anda memperbaiki atau menambah kode di proyek ini:
*   Desain Estetika: Mengutamakan standar tinggi. Gunakan palet HSL/modern (elemen *navy blue* identitas BMKG). Hindari warna generic. Berikan interaktivitas mikro-animasi (hover states) di Alpine pada komponen UI.
*   Backend: 
    1. Hindari pemakaian `DB::table()`, utamakan `Model::query()`.
    2. Lindungi modul publik dari spam dengan `middleware('throttle:X,Y')`.
    3. Hindari N+1 query: wajib pakai fungsi *Eager Loading* `->with()`.
    4. Validasi harus menggunakan Form Request mandiri, jangan ditaruh di *controller method*.
*   Routing: Laravel 12 menggunakan `bootstrap/app.php` untuk pendaftaran *Middleware* (file `Kernel.php` tidak dipakai lagi).
*   Testing: Wajib menggunakan/menuliskan file `.pest` (*Pest Framework*) setiap ada penambahan rute/fitur kritis.
*   Code Linting: Menggunakan Laravel Pint standar (*format agent*).
