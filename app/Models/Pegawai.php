<?php

namespace App\Models;

use App\Enums\SubUnit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pegawai extends Model
{
    public const JABATAN_OPTIONS = [
        'Kepala UPT',
        'PMG Utama',
        'PMG Madya',
        'PMG Muda',
        'PMG Pertama',
        'PMG Penyelia',
        'PMG Pelaksana Lanjutan',
        'PMG Pelaksana',
        'PMG Terampil',
        'Pranata Komputer',
        'Pengelola BMN',
        'Bendahara',
        'Pengadministrasi Umum',
        'Arsiparis Muda',
        'Analis Kepeg. Muda',
        'APK APBN Ahli Muda',
        'APK APBN Ahli Pertama',
        'Pranata Keuangan APBN Penyelia',
        'Caraka',
        'PPNPN',
    ];

    protected $fillable = [
        'nama',
        'jabatan',
        'sub_unit',
        'is_ketua_tim',
        'nip',
        'pendidikan',
        'golongan',
        'foto',
        'urutan',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
            'is_ketua_tim' => 'boolean',
            'sub_unit' => SubUnit::class,
        ];
    }

    /**
     * Default ordering by urutan (display order).
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    /**
     * Get the photo URL. Returns null if no photo uploaded.
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        return Storage::url($this->foto);
    }
}
