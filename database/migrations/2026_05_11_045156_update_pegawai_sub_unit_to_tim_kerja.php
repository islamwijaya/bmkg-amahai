<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Map old sub_unit values to new tim_kerja values
        DB::table('pegawais')
            ->whereIn('sub_unit', ['forecaster', 'data_informasi'])
            ->update(['sub_unit' => 'tim_prakiraan']);

        DB::table('pegawais')
            ->whereIn('sub_unit', ['observer', 'teknisi'])
            ->update(['sub_unit' => 'tim_observasi']);

        DB::table('pegawais')
            ->whereIn('sub_unit', ['tata_usaha', 'ppnpn'])
            ->update(['sub_unit' => 'tim_administrasi']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Since this is a data transformation where multiple old values map to a single new value,
        // it cannot be perfectly reversed. However, we can map them back to a primary representative value.
        DB::table('pegawais')
            ->where('sub_unit', 'tim_prakiraan')
            ->update(['sub_unit' => 'forecaster']);

        DB::table('pegawais')
            ->where('sub_unit', 'tim_observasi')
            ->update(['sub_unit' => 'observer']);

        DB::table('pegawais')
            ->where('sub_unit', 'tim_administrasi')
            ->update(['sub_unit' => 'tata_usaha']);
    }
};
