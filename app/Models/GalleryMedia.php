<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryMedia extends Model
{
    protected $fillable = [
        'album_id', 'type', 'file_path',
        'video_url', 'thumbnail', 'title', 'sort_order'
    ];

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'album_id');
    }

    public function getUrlAttribute(): string
    {
        if ($this->type === 'image') {
            return asset('storage/' . $this->file_path);
        }
        return $this->video_url ?? '';
    }
}