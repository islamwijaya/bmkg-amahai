<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('settings')->delete();

        \DB::table('settings')->insert([
            0 => [
                'id' => 1,
                'key' => 'running_banner',
                'value' => 'Selamat datang di Website Resmi Stasiun Meteorologi Kelas III Amahai — Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) Republik Indonesia &nbsp;|&nbsp; Untuk informasi lebih lanjut hubungi kami di +62821 98942869',
                'created_at' => '2026-04-22 01:37:24',
                'updated_at' => '2026-04-22 01:37:24',
            ],
            1 => [
                'id' => 2,
                'key' => 'promo_buletin_variations',
                'value' => '[{"id":"69e826a6ddec0","attention":"Data Adalah Kekuatan: Ubah Cara Anda Melihat Langit Maluku Tengah!","interest_desire":"Jangan biarkan cuaca mengejutkan Anda. Pelajari jejak dinamika atmosfer bulan lalu melalui Buletin Eksklusif BMKG Amahai dan bekali diri Anda dengan wawasan cerdas untuk langkah lebih terukur di bulan ini.","action":"Pelajari Kondisi Cuaca Sekarang!"},{"id":"69e826a6ddec3","attention":"Cuaca Ekstrem Tidak Pernah Datang Tanpa Jejak. Apakah Anda Sudah Membacanya?","interest_desire":"Analisis mendalam dari para ahli Meteorologi Amahai kini hadir untuk Anda. Jangan sekadar melihat awan; pelajari tren suhu dan pola curah hujan bulan lalu untuk memahami rahasia alam di balik dinamika cuaca kita.","action":"Jelajahi Buletin BMKG Amahai Sekarang!"},{"id":"69e826a6ddec4","attention":"Satu Portal, Seluruh Jawaban: Solusi Informasi Meteorologi di Amahai.","interest_desire":"Dapatkan akses langsung ke prakiraan cuaca detail tingkat desa hingga analisis mendalam mengenai fenomena global seperti El Nino langsung dari Stasiun Meteorologi Amahai. Rencanakan aktivitas harian, perjalanan laut, atau masa tanam Anda dengan rasa aman dan penuh kepastian menggunakan data akurat yang dipantau oleh para ahli kami.","action":"Mulai Belajar Cuaca Bersama Kami!"},{"id":"69e826a6ddec5","attention":"Lebih Dekat dengan Langit Amahai\\u2014Informasi Akurat di Ujung Jari Anda!","interest_desire":"Kami menyajikan data meteorologi skala lokal hingga global, mulai dari analisis angin permukaan hingga kejadian cuaca ekstrem yang dirangkum secara profesional dalam buletin bulanan kami. Bekali diri Anda dengan wawasan cerdas melalui laporan layanan data dan hasil survei kepuasan publik yang transparan dan mudah diakses.","action":"Pelajari Sains di Balik Cuaca"}]',
                'created_at' => '2026-04-22 01:38:46',
                'updated_at' => '2026-04-22 01:38:46',
            ],
            2 => [
                'id' => 3,
                'key' => 'promo_buletin_is_random',
                'value' => '1',
                'created_at' => '2026-04-22 01:38:46',
                'updated_at' => '2026-04-22 01:38:46',
            ],
            3 => [
                'id' => 4,
                'key' => 'promo_buletin_interval_days',
                'value' => '7',
                'created_at' => '2026-04-22 01:38:46',
                'updated_at' => '2026-04-22 01:38:46',
            ],
        ]);

    }
}
