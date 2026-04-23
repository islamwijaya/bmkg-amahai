<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\PrakiraanCuaca;
use Illuminate\Database\Seeder;

class BmkgSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPegawai();
        $this->seedCuaca();
    }

    /**
     * Seed employee data (originally hardcoded in sdm.blade.php).
     */
    private function seedPegawai(): void
    {
        $pegawai = [
            ['nama' => 'Ir. Ahmad Fauzi, M.Si', 'jabatan' => 'Kepala Stasiun', 'nip' => '197503152000121001', 'pendidikan' => 'S2 Meteorologi', 'golongan' => 'IV/a', 'urutan' => 1],
            ['nama' => 'Budi Santoso, S.Tr.Met', 'jabatan' => 'Forecaster / Prakirawan', 'nip' => '198905202012121002', 'pendidikan' => 'D4 Meteorologi', 'golongan' => 'III/b', 'urutan' => 2],
            ['nama' => 'Siti Rahayu, S.Tr.Met', 'jabatan' => 'Forecaster / Prakirawan', 'nip' => '199002142013012003', 'pendidikan' => 'D4 Meteorologi', 'golongan' => 'III/a', 'urutan' => 3],
            ['nama' => 'Rudi Hermawan, A.Md.Met', 'jabatan' => 'Observer Meteorologi', 'nip' => '199108302014011004', 'pendidikan' => 'D3 Meteorologi', 'golongan' => 'II/c', 'urutan' => 4],
            ['nama' => 'Dewi Lestari, A.Md.Met', 'jabatan' => 'Observer Meteorologi', 'nip' => '199205172015012005', 'pendidikan' => 'D3 Meteorologi', 'golongan' => 'II/c', 'urutan' => 5],
            ['nama' => 'Andi Prakoso, S.T', 'jabatan' => 'Teknisi Instrumentasi', 'nip' => '198712082011011006', 'pendidikan' => 'S1 Teknik Elektro', 'golongan' => 'III/a', 'urutan' => 6],
            ['nama' => 'Maria Magdalena, S.E', 'jabatan' => 'Bendahara / TU', 'nip' => '198803252010012007', 'pendidikan' => 'S1 Ekonomi', 'golongan' => 'III/a', 'urutan' => 7],
            ['nama' => 'Yusuf Latuconsina', 'jabatan' => 'Staf Operasional', 'nip' => '199406152016011008', 'pendidikan' => 'SMA', 'golongan' => 'II/a', 'urutan' => 8],
            ['nama' => 'Nur Hasanah, A.Md', 'jabatan' => 'Staf Administrasi', 'nip' => '199509242017012009', 'pendidikan' => 'D3 Administrasi', 'golongan' => 'II/b', 'urutan' => 9],
            ['nama' => 'Hendro Wibowo, S.T', 'jabatan' => 'Teknisi Informatika', 'nip' => '199001122015011010', 'pendidikan' => 'S1 Informatika', 'golongan' => 'III/a', 'urutan' => 10],
        ];

        foreach ($pegawai as $p) {
            Pegawai::updateOrCreate(['nip' => $p['nip']], $p);
        }
    }

    /**
     * Seed weather forecast data for today (originally hardcoded in cuaca.blade.php).
     */
    private function seedCuaca(): void
    {
        $today = now()->toDateString();

        // Skip if data already exists for today
        if (PrakiraanCuaca::where('tanggal', $today)->exists()) {
            return;
        }

        $kecamatans = [
            'Kecamatan Amahai' => [
                ['jam' => '00.00', 'cuaca' => 'Berawan', 'suhu' => 26, 'kelembaban' => 82, 'angin_arah' => 'B', 'angin_kecepatan' => 12, 'icon' => '☁️'],
                ['jam' => '06.00', 'cuaca' => 'Cerah Berawan', 'suhu' => 27, 'kelembaban' => 75, 'angin_arah' => 'BD', 'angin_kecepatan' => 15, 'icon' => '⛅'],
                ['jam' => '12.00', 'cuaca' => 'Cerah', 'suhu' => 33, 'kelembaban' => 65, 'angin_arah' => 'D', 'angin_kecepatan' => 20, 'icon' => '☀️'],
                ['jam' => '18.00', 'cuaca' => 'Berawan', 'suhu' => 30, 'kelembaban' => 72, 'angin_arah' => 'BD', 'angin_kecepatan' => 10, 'icon' => '☁️'],
                ['jam' => '24.00', 'cuaca' => 'Hujan Ringan', 'suhu' => 25, 'kelembaban' => 88, 'angin_arah' => 'U', 'angin_kecepatan' => 8, 'icon' => '🌧️'],
            ],
            'Kecamatan Banda' => [
                ['jam' => '00.00', 'cuaca' => 'Hujan Sedang', 'suhu' => 24, 'kelembaban' => 90, 'angin_arah' => 'BL', 'angin_kecepatan' => 18, 'icon' => '🌧️'],
                ['jam' => '06.00', 'cuaca' => 'Berawan', 'suhu' => 25, 'kelembaban' => 84, 'angin_arah' => 'B', 'angin_kecepatan' => 14, 'icon' => '☁️'],
                ['jam' => '12.00', 'cuaca' => 'Cerah Berawan', 'suhu' => 31, 'kelembaban' => 70, 'angin_arah' => 'D', 'angin_kecepatan' => 22, 'icon' => '⛅'],
                ['jam' => '18.00', 'cuaca' => 'Hujan Ringan', 'suhu' => 28, 'kelembaban' => 80, 'angin_arah' => 'BL', 'angin_kecepatan' => 12, 'icon' => '🌧️'],
                ['jam' => '24.00', 'cuaca' => 'Berawan Tebal', 'suhu' => 24, 'kelembaban' => 87, 'angin_arah' => 'U', 'angin_kecepatan' => 10, 'icon' => '☁️'],
            ],
            'Kecamatan Tehoru' => [
                ['jam' => '00.00', 'cuaca' => 'Cerah', 'suhu' => 27, 'kelembaban' => 70, 'angin_arah' => 'T', 'angin_kecepatan' => 10, 'icon' => '☀️'],
                ['jam' => '06.00', 'cuaca' => 'Cerah', 'suhu' => 29, 'kelembaban' => 65, 'angin_arah' => 'TD', 'angin_kecepatan' => 12, 'icon' => '☀️'],
                ['jam' => '12.00', 'cuaca' => 'Cerah Berawan', 'suhu' => 34, 'kelembaban' => 58, 'angin_arah' => 'D', 'angin_kecepatan' => 18, 'icon' => '⛅'],
                ['jam' => '18.00', 'cuaca' => 'Cerah Berawan', 'suhu' => 31, 'kelembaban' => 66, 'angin_arah' => 'TD', 'angin_kecepatan' => 14, 'icon' => '⛅'],
                ['jam' => '24.00', 'cuaca' => 'Cerah', 'suhu' => 26, 'kelembaban' => 72, 'angin_arah' => 'T', 'angin_kecepatan' => 8, 'icon' => '☀️'],
            ],
            'Kecamatan Seram Utara' => [
                ['jam' => '00.00', 'cuaca' => 'Berawan', 'suhu' => 25, 'kelembaban' => 80, 'angin_arah' => 'U', 'angin_kecepatan' => 11, 'icon' => '☁️'],
                ['jam' => '06.00', 'cuaca' => 'Hujan Ringan', 'suhu' => 24, 'kelembaban' => 86, 'angin_arah' => 'BL', 'angin_kecepatan' => 16, 'icon' => '🌧️'],
                ['jam' => '12.00', 'cuaca' => 'Berawan', 'suhu' => 31, 'kelembaban' => 72, 'angin_arah' => 'T', 'angin_kecepatan' => 19, 'icon' => '☁️'],
                ['jam' => '18.00', 'cuaca' => 'Cerah Berawan', 'suhu' => 29, 'kelembaban' => 74, 'angin_arah' => 'TD', 'angin_kecepatan' => 13, 'icon' => '⛅'],
                ['jam' => '24.00', 'cuaca' => 'Hujan Ringan', 'suhu' => 24, 'kelembaban' => 89, 'angin_arah' => 'BL', 'angin_kecepatan' => 9, 'icon' => '🌧️'],
            ],
            'Kecamatan Masohi' => [
                ['jam' => '00.00', 'cuaca' => 'Hujan Lebat', 'suhu' => 23, 'kelembaban' => 95, 'angin_arah' => 'B', 'angin_kecepatan' => 28, 'icon' => '⛈️'],
                ['jam' => '06.00', 'cuaca' => 'Hujan Sedang', 'suhu' => 24, 'kelembaban' => 90, 'angin_arah' => 'BL', 'angin_kecepatan' => 22, 'icon' => '🌧️'],
                ['jam' => '12.00', 'cuaca' => 'Berawan Tebal', 'suhu' => 28, 'kelembaban' => 82, 'angin_arah' => 'BD', 'angin_kecepatan' => 20, 'icon' => '☁️'],
                ['jam' => '18.00', 'cuaca' => 'Hujan Ringan', 'suhu' => 26, 'kelembaban' => 86, 'angin_arah' => 'B', 'angin_kecepatan' => 15, 'icon' => '🌧️'],
                ['jam' => '24.00', 'cuaca' => 'Berawan', 'suhu' => 24, 'kelembaban' => 88, 'angin_arah' => 'U', 'angin_kecepatan' => 11, 'icon' => '☁️'],
            ],
        ];

        foreach ($kecamatans as $kecamatan => $entries) {
            foreach ($entries as $entry) {
                PrakiraanCuaca::create(array_merge($entry, [
                    'kecamatan' => $kecamatan,
                    'tanggal' => $today,
                ]));
            }
        }
    }
}
