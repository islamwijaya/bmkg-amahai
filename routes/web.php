<?php

use App\Http\Controllers\Admin\AdminPegawaiController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\BulletinController as AdminBulletinController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TransparansiController as AdminTransparansiController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\CuacaKabuController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SatelitController;
use App\Http\Controllers\TransparansiController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes — Stasiun Meteorologi Kelas III Amahai |-------------------------------------------------------------------------- */

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Profil
Route::group(['prefix' => 'profil', 'as' => 'profil.'], function () {
    Route::get('/sejarah', fn () => view('pages.profil.sejarah'))->name('sejarah');
    Route::get('/visi-misi', fn () => view('pages.profil.visi-misi'))->name('visi-misi');
    Route::get('/struktur', [PegawaiController::class, 'struktur'])->name('struktur');
    Route::get('/sdm', [PegawaiController::class, 'index'])->name('sdm');
    Route::get('/tugas-fungsi', fn () => view('pages.profil.tugasfungsi'))->name('tugas-fungsi');
    Route::get('/kontak', fn () => view('pages.profil.kontak'))->name('kontak');
});

// Prakiraan
Route::group(['prefix' => 'prakiraan', 'as' => 'prakiraan.'], function () {
    Route::get('/cuaca', [CuacaKabuController::class, 'index'])->name('cuaca');
    Route::get('/cuaca/kecamatan/{kecamatan}', [CuacaKabuController::class, 'desa'])->name('cuaca.desa');
    Route::get('/cuaca/detail/{adm4}', [CuacaKabuController::class, 'detail'])->name('cuaca.detail');
    Route::get('/cuaca-perairan', fn () => view('pages.prakiraan.cuaca-perairan'))->name('cuaca-perairan');
});

// Gempa Bumi — redirect ke BMKG Pusat
Route::get('/gempa-bumi', fn () => redirect()->away('https://www.bmkg.go.id/gempabumi'))->name('gempa-bumi');

// Pelayanan Data
Route::group(['prefix' => 'pelayanan', 'as' => 'pelayanan.'], function () {
    Route::get('/prosedur', fn () => view('pages.pelayanan.prosedur'))->name('prosedur');
    Route::get('/tarif', fn () => view('pages.pelayanan.tarif'))->name('tarif');
    Route::get('/ikm', fn () => view('pages.pelayanan.ikm'))->name('ikm');
});

// Publik
Route::group(['prefix' => 'publik', 'as' => 'publik.'], function () {
    Route::get('/survei', fn () => view('pages.publik.survei'))->name('survei');

    Route::get('/kritik-saran', [KritikSaranController::class, 'create'])->name('kritik-saran');
    Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');

    Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('pengaduan.store');

    Route::get('/buletin', [BulletinController::class, 'index'])->name('buletin');

    Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi');
});

// Informasi
Route::group(['prefix' => 'informasi', 'as' => 'informasi.'], function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{berita:slug}', [BeritaController::class, 'show'])->name('show');
});

// Satelit Sync (Public but Throttled)
Route::post('satelit/sync', [SatelitController::class, 'syncPublic'])
    ->middleware('throttle:1,5')
    ->name('satelit.sync');

// ============================================================
// ADMIN ROUTES — Protected by auth + admin middleware
// ============================================================
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Informasi
    Route::resource('informasi', AdminBeritaController::class)->parameters(['informasi' => 'berita'])->except(['show']);

    // Buletin
    Route::resource('buletin', AdminBulletinController::class)->parameters(['buletin' => 'bulletin'])->except(['show']);

    // Pegawai
    Route::resource('pegawai', AdminPegawaiController::class)->except(['show']);

    // Transparansi Kinerja
    Route::resource('transparansi', AdminTransparansiController::class)->except(['show']);

    // Kritik & Saran
    Route::resource('kritik-saran', \App\Http\Controllers\Admin\KritikSaranController::class)->only(['index', 'destroy']);

    // Satelit Sync
    Route::post('sync-satelit', [DashboardController::class, 'syncSatelit'])->name('sync-satelit');

    // Pengaturan
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});

// Auth routes are loaded from routes/auth.php via bootstrap/app.php
require __DIR__.'/auth.php';
