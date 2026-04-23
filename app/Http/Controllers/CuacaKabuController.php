<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CuacaKabuController extends Controller
{
    /**
     * Tampilkan daftar semua Kecamatan di Maluku Tengah
     */
    public function index()
    {
        $wilayah = config('wilayah', []);

        return view('pages.prakiraan.kabu-index', compact('wilayah'));
    }

    /**
     * Tampilkan daftar Desa/Kelurahan dalam satu Kecamatan
     */
    public function desa($kecamatan_id)
    {
        $wilayah = config('wilayah', []);

        if (! array_key_exists($kecamatan_id, $wilayah)) {
            abort(404, 'Kecamatan tidak ditemukan.');
        }

        $kecamatan = $wilayah[$kecamatan_id];

        return view('pages.prakiraan.kabu-desa', compact('kecamatan'));
    }

    /**
     * Tampilkan detail prakiraan cuaca 3 hari untuk satu Desa/Kelurahan
     */
    public function detail($adm4)
    {
        // Temukan nama desa dan kecamatan berdasarkan kode adm4
        $desa_nama = 'Tidak Diketahui';
        $kecamatan_nama = 'Tidak Diketahui';
        $wilayah = config('wilayah', []);

        foreach ($wilayah as $kec) {
            foreach ($kec['desa'] as $desa) {
                if ($desa['id'] == $adm4) {
                    $desa_nama = $desa['nama'];
                    $kecamatan_nama = $kec['nama'];
                    break 2;
                }
            }
        }

        if ($desa_nama === 'Tidak Diketahui') {
            abort(404, 'Kode wilayah desa tidak valid.');
        }

        // Cache 6 jam (60 * 6 = 360 menit)
        $cacheKey = 'cuaca_bmkg_'.$adm4;
        $data = Cache::remember($cacheKey, 360, function () use ($adm4) {
            $apiUrl = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$adm4}";
            try {
                $response = Http::timeout(10)->get($apiUrl);
                if ($response->successful()) {
                    return $response->json();
                }
            } catch (\Exception $e) {
                // Log atau handling error jika API gagal
            }

            return null; // Return null jika gagal ngambil
        });

        // Parse data
        $cuacaHarian = [];
        $lokasi = [];

        if ($data && isset($data['data'][0]['cuaca'])) {
            $cuacaHarian = $data['data'][0]['cuaca'];
            $lokasi = $data['lokasi'] ?? [];
        }

        return view('pages.prakiraan.kabu-detail', compact('adm4', 'desa_nama', 'kecamatan_nama', 'cuacaHarian', 'lokasi', 'data'));
    }
}
