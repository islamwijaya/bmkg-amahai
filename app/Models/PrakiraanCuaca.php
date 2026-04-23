<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrakiraanCuaca extends Model
{
    protected $fillable = [
        'kecamatan',
        'tanggal',
        'jam',
        'cuaca',
        'suhu',
        'kelembaban',
        'angin_arah',
        'angin_kecepatan',
        'icon',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'suhu' => 'integer',
        'kelembaban' => 'integer',
        'angin_kecepatan' => 'integer',
    ];

    /**
     * Scope: filter data for a specific date.
     */
    public function scopeForDate($query, $date)
    {
        return $query->where('tanggal', $date);
    }

    /**
     * Scope: filter data for today.
     */
    public function scopeForToday($query)
    {
        return $query->where('tanggal', now()->toDateString());
    }
}
