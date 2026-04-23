<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'email',
        'telepon',
        'kategori',
        'judul',
        'isi',
        'nomor_tiket',
    ];

    /**
     * Auto-generate nomor_tiket on creation.
     */
    protected static function booted(): void
    {
        static::creating(function (Pengaduan $pengaduan) {
            if (empty($pengaduan->nomor_tiket)) {
                $pengaduan->nomor_tiket = 'PGD-'.strtoupper(substr(uniqid(), -6));
            }
        });
    }
}
