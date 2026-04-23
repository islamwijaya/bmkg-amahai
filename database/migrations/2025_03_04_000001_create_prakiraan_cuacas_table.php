<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prakiraan_cuacas', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan');
            $table->date('tanggal');
            $table->string('jam', 10);
            $table->string('cuaca');
            $table->integer('suhu');
            $table->integer('kelembaban');
            $table->string('angin_arah', 10);
            $table->integer('angin_kecepatan');
            $table->string('icon', 10)->nullable();
            $table->timestamps();

            $table->index(['kecamatan', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prakiraan_cuacas');
    }
};
