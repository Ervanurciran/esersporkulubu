<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryAlbum extends Model
{
    protected $fillable = [
        'title', 'slug', 'description',
        'cover_image', 'event_date', 'is_active'
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'event_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function media()
    {
        return $this->hasMany(GalleryMedia::class, 'album_id')
                    ->orderBy('sort_order');
    }

    public function images()
    {
        return $this->hasMany(GalleryMedia::class, 'album_id')
                    ->where('type', 'image');
    }

    public function videos()
    {
        return $this->hasMany(GalleryMedia::class, 'album_id')
                    ->where('type', 'video');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->orderBy('event_date', 'desc');
    }
}