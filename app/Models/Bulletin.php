<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bulletin extends Model
{
    /** @use HasFactory<\Database\Factories\BulletinFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'edition',
        'year',
        'month',
        'file_path',
        'cover_path',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'month' => 'integer',
        ];
    }

    /**
     * Scope to order by year and month, newest first.
     */
    public function scopeLatestEdition($query): void
    {
        $query->orderByDesc('year')->orderByDesc('month');
    }

    /**
     * Get the publicly accessible PDF file URL.
     */
    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get the publicly accessible cover image URL.
     */
    public function getCoverUrlAttribute(): ?string
    {
        if (! $this->cover_path) {
            return null;
        }

        return Storage::url($this->cover_path);
    }

    /**
     * Get the Indonesian month name for this bulletin.
     */
    public function getMonthNameAttribute(): string
    {
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return $months[$this->month] ?? '-';
    }
}
