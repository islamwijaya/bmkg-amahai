<?php

namespace Database\Seeders;

use App\Enums\SubUnit;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan data lama agar tidak tumpang tindih
        DB::table('pegawais')->truncate();

        $data = [
            // ════ KEPALA UPT ════
            [
                'nama' => 'Ir. Ahmad Fauzi, M.Si',
                'nip' => '197503152000121001',
                'jabatan' => 'Kepala UPT',
                'sub_unit' => SubUnit::KepalaUpt->value,
                'pendidikan' => 'S2 Meteorologi',
                'golongan' => 'IV/a',
                'urutan' => 0,
            ],

            // ════ FORECASTER (Prakirawan) ════
            [
                'nama' => 'Bedi Hursepuny',
                'nip' => '198511152006041004',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Forecaster->value,
                'pendidikan' => 'S1 Meteorologi',
                'golongan' => 'III/a',
                'urutan' => 1,
            ],
            [
                'nama' => 'Margarita Triono',
                'nip' => '198812072010122001',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Forecaster->value,
                'pendidikan' => 'S1 Meteorologi',
                'golongan' => 'III/a',
                'urutan' => 2,
            ],
            [
                'nama' => 'Roy. P. Fautngilyanan',
                'nip' => '199501222013121001',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Forecaster->value,
                'pendidikan' => 'S1 Meteorologi',
                'golongan' => 'III/a',
                'urutan' => 3,
            ],
            [
                'nama' => 'Yoke K. D. Tomatala',
                'nip' => '199908232021062000',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Forecaster->value,
                'pendidikan' => 'S1 Meteorologi',
                'golongan' => 'III/a',
                'urutan' => 4,
            ],
            [
                'nama' => 'Harviadhin Mariri',
                'nip' => '199803112023021001',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Forecaster->value,
                'pendidikan' => 'S1 Meteorologi',
                'golongan' => 'III/a',
                'urutan' => 5,
            ],

            // ════ OBSERVER ════
            [
                'nama' => 'Roland. G. Lainata',
                'nip' => '198705172006041002',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Observer->value,
                'pendidikan' => 'D3 Meteorologi',
                'golongan' => 'II/c',
                'urutan' => 6,
            ],
            [
                'nama' => 'Jelvianto Gunawan',
                'nip' => '198901132012101001',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Observer->value,
                'pendidikan' => 'D3 Meteorologi',
                'golongan' => 'II/c',
                'urutan' => 7,
            ],
            [
                'nama' => 'Jesnny. C. G. Haurissa',
                'nip' => '199509122014121001',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Observer->value,
                'pendidikan' => 'D3 Meteorologi',
                'golongan' => 'II/c',
                'urutan' => 8,
            ],
            [
                'nama' => 'Frety Cicilia Alrasyid',
                'nip' => '199609202016012001',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Observer->value,
                'pendidikan' => 'D3 Meteorologi',
                'golongan' => 'II/c',
                'urutan' => 9,
            ],
            [
                'nama' => 'Florendina Jehubjanan',
                'nip' => '199510252020012000',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Observer->value,
                'pendidikan' => 'D3 Meteorologi',
                'golongan' => 'II/c',
                'urutan' => 10,
            ],
            [
                'nama' => 'Jeremy. M. Sopacua',
                'nip' => '200010182025121002',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Observer->value,
                'pendidikan' => 'D3 Meteorologi',
                'golongan' => 'II/c',
                'urutan' => 11,
            ],

            // ════ DATA & INFORMASI ════
            [
                'nama' => 'Dwi Purniati',
                'nip' => '197812032003122008',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::DataInformasi->value,
                'pendidikan' => 'S1 Meteorologi',
                'golongan' => 'III/a',
                'urutan' => 12,
            ],

            // ════ TEKNISI ════
            [
                'nama' => 'Honoratus Aji',
                'nip' => '200001162022041000',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Teknisi->value,
                'pendidikan' => 'D4 Instrumentasi',
                'golongan' => 'III/a',
                'urutan' => 13,
            ],
            [
                'nama' => 'Islam. A. B. S. W. Pohan',
                'nip' => '200306062025121002',
                'jabatan' => 'PMG Pertama',
                'sub_unit' => SubUnit::Teknisi->value,
                'pendidikan' => 'D4 Instrumentasi',
                'golongan' => 'III/a',
                'urutan' => 14,
            ],

            [
                'nama' => 'Ade Perdana Suhendratman, S.Si, M.T.',
                'nip' => '198801012010121001',
                'jabatan' => 'APK APBN Ahli Muda',
                'sub_unit' => SubUnit::TataUsaha->value,
                'pendidikan' => 'S2 Teknik Mesin',
                'golongan' => 'III/c',
                'urutan' => 16,
            ],
            [
                'nama' => 'Arif Priyanto, S.Sos, M.M.',
                'nip' => '198902022011011002',
                'jabatan' => 'Arsiparis Muda',
                'sub_unit' => SubUnit::TataUsaha->value,
                'pendidikan' => 'S2 Manajemen',
                'golongan' => 'III/d',
                'urutan' => 17,
            ],
            [
                'nama' => 'Hapsari Wahyu Adji, S.E.',
                'nip' => '199003032014012003',
                'jabatan' => 'Analis Kepeg. Muda',
                'sub_unit' => SubUnit::TataUsaha->value,
                'pendidikan' => 'S1 Ekonomi',
                'golongan' => 'III/c',
                'urutan' => 18,
            ],
            [
                'nama' => 'Anandayu Palupi, S.E.',
                'nip' => '199104042015012004',
                'jabatan' => 'Arsiparis Muda',
                'sub_unit' => SubUnit::TataUsaha->value,
                'pendidikan' => 'S1 Ekonomi',
                'golongan' => 'III/b',
                'urutan' => 19,
            ],
            [
                'nama' => 'Mira Gramedia, A.Md.',
                'nip' => '199205052016012005',
                'jabatan' => 'PMG Penyelia',
                'sub_unit' => SubUnit::TataUsaha->value,
                'pendidikan' => 'D3',
                'golongan' => 'II/d',
                'urutan' => 20,
            ],
            [
                'nama' => 'Andja Prasetyo, S.Sos, M.M.',
                'nip' => '199306062017011006',
                'jabatan' => 'Pranata Keuangan APBN Penyelia',
                'sub_unit' => SubUnit::TataUsaha->value,
                'pendidikan' => 'S2 Manajemen',
                'golongan' => 'III/b',
                'urutan' => 21,
            ],
            [
                'nama' => 'Heri Sudarsono Seputra, SE.',
                'nip' => '199407072018011007',
                'jabatan' => 'APK APBN Ahli Pertama',
                'sub_unit' => SubUnit::TataUsaha->value,
                'pendidikan' => 'S1 Ekonomi',
                'golongan' => 'III/a',
                'urutan' => 22,
            ],

            // ════ PPNPN ════
            [
                'nama' => 'Ahmad Syarif',
                'nip' => '123456789012345601',
                'jabatan' => 'PPNPN',
                'sub_unit' => SubUnit::Ppnpn->value,
                'pendidikan' => 'SMA',
                'golongan' => '-',
                'urutan' => 18,
            ],
            [
                'nama' => 'Iwan Setiawan',
                'nip' => '123456789012345602',
                'jabatan' => 'PPNPN',
                'sub_unit' => SubUnit::Ppnpn->value,
                'pendidikan' => 'SMA',
                'golongan' => '-',
                'urutan' => 19,
            ],
        ];

        foreach ($data as $pegawai) {
            Pegawai::create($pegawai);
        }
    }
}
