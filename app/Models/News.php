<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $table = 'news'; // Veritabanındaki tablo adınız

    protected $fillable = [
        'title', 'slug', 'type', 'excerpt', 'content', 
        'cover_image', 'is_published', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }

    public function scopeHaberler($query)
    {
        return $query->where('type', 'haber');
    }

    public function scopeEtkinlikler($query)
    {
        return $query->where('type', 'etkinlik');
    }
}