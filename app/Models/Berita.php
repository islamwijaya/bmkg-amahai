<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Berita extends Model
{
    /** @use HasFactory<\Database\Factories\BeritaFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'images',
        'image_captions',
        'content',
        'published_at',
        'is_published',
        'published_by',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
            'images' => 'array',
            'image_captions' => 'array',
        ];
    }

    /**
     * Scope to get only published articles.
     */
    public function scopePublished($query): void
    {
        $query->where('is_published', true)->orderByDesc('published_at');
    }

    /**
     * Get the publicly accessible thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (!empty($this->images) && is_array($this->images)) {
            return Storage::url($this->images[0]);
        }

        if (! $this->thumbnail) {
            return null;
        }

        return Storage::url($this->thumbnail);
    }

    /**
     * Get all image URLs.
     */
    public function getImagesUrlsAttribute(): array
    {
        if (empty($this->images) || !is_array($this->images)) {
            return $this->thumbnail ? [Storage::url($this->thumbnail)] : [];
        }

        return array_map(fn($path) => Storage::url($path), $this->images);
    }

    /**
     * Auto-generate a unique slug from the title.
     */
    public static function generateSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }
}
