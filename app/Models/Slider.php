<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'image',
        'media_type', 'video_path', 'video_url',
        'button_text', 'button_url',
        'sort_order', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // Görsel URL
    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : '';
    }

    // Video URL (MP4 için)
    public function getVideoPathUrlAttribute(): string
    {
        return $this->video_path
            ? asset('storage/' . $this->video_path)
            : '';
    }

    // Video mu yoksa resim mi?
    public function isVideo(): bool
    {
        return $this->media_type === 'video';
    }

    // YouTube embed URL oluştur
    public function getYoutubeEmbedAttribute(): ?string
    {
        if (!$this->video_url) return null;

        preg_match(
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/',
            $this->video_url,
            $matches
        );

        if (isset($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1] .
                   '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] .
                   '&controls=0&showinfo=0&rel=0';
        }

        return null;
    }
}