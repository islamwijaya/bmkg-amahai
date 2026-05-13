<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BulletinsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('bulletins')->delete();

        \DB::table('bulletins')->insert([
            0 => [
                'id' => 2,
                'title' => 'Buletin Amahai Januari 2026',
                'edition' => 'Januari 2026',
                'year' => 2026,
                'month' => 1,
                'file_path' => 'buletin/JmrFz8qcWytL8hSB6DiVlottRCX49qJ2cnvtSMuz.pdf',
                'cover_path' => null,
                'description' => null,
                'created_at' => '2026-04-22 02:52:57',
                'updated_at' => '2026-04-22 02:53:09',
            ],
        ]);

    }
}
