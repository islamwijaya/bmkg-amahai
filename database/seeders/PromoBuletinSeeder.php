<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoBuletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variations = [
            [
                'id' => uniqid(),
                'attention' => 'Data Adalah Kekuatan: Ubah Cara Anda Melihat Langit Maluku Tengah!',
                'interest_desire' => 'Jangan biarkan cuaca mengejutkan Anda. Pelajari jejak dinamika atmosfer bulan lalu melalui Buletin Eksklusif BMKG Amahai dan bekali diri Anda dengan wawasan cerdas untuk langkah lebih terukur di bulan ini.',
                'action' => 'Pelajari Kondisi Cuaca Sekarang!',
            ],
            [
                'id' => uniqid(),
                'attention' => 'Cuaca Ekstrem Tidak Pernah Datang Tanpa Jejak. Apakah Anda Sudah Membacanya?',
                'interest_desire' => 'Analisis mendalam dari para ahli Meteorologi Amahai kini hadir untuk Anda. Jangan sekadar melihat awan; pelajari tren suhu dan pola curah hujan bulan lalu untuk memahami rahasia alam di balik dinamika cuaca kita.',
                'action' => 'Jelajahi Buletin BMKG Amahai Sekarang!',
            ],
            [
                'id' => uniqid(),
                'attention' => 'Satu Portal, Seluruh Jawaban: Solusi Informasi Meteorologi di Amahai.',
                'interest_desire' => 'Dapatkan akses langsung ke prakiraan cuaca detail tingkat desa hingga analisis mendalam mengenai fenomena global seperti El Nino langsung dari Stasiun Meteorologi Amahai. Rencanakan aktivitas harian, perjalanan laut, atau masa tanam Anda dengan rasa aman dan penuh kepastian menggunakan data akurat yang dipantau oleh para ahli kami.',
                'action' => 'Mulai Belajar Cuaca Bersama Kami!',
            ],
            [
                'id' => uniqid(),
                'attention' => 'Lebih Dekat dengan Langit Amahai—Informasi Akurat di Ujung Jari Anda!',
                'interest_desire' => 'Kami menyajikan data meteorologi skala lokal hingga global, mulai dari analisis angin permukaan hingga kejadian cuaca ekstrem yang dirangkum secara profesional dalam buletin bulanan kami. Bekali diri Anda dengan wawasan cerdas melalui laporan layanan data dan hasil survei kepuasan publik yang transparan dan mudah diakses.',
                'action' => 'Pelajari Sains di Balik Cuaca',
            ],
        ];

        $settings = [
            'promo_buletin_variations' => json_encode($variations),
            'promo_buletin_is_random' => '1',
            'promo_buletin_interval_days' => '7',
            'promo_buletin_active_index' => '0',
            'promo_buletin_last_randomized' => now()->toDateTimeString(),
        ];

        foreach ($settings as $key => $value) {
            DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
