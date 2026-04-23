<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::updateOrCreate(
            ['key' => 'running_banner'],
            ['value' => 'Selamat datang di Website Resmi Stasiun Meteorologi Kelas III Amahai — Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) Republik Indonesia &nbsp;|&nbsp; Untuk informasi lebih lanjut hubungi kami di +62 821 9894 2869']
        );
    }
}
