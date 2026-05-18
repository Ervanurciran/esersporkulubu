<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $fillable = [
        'name', 'title', 'type', 'photo',
        'bio', 'email', 'phone', 'sort_order', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Type sabitler
    const TYPE_BASKAN          = 'baskan';
    const TYPE_YONETIM_KURULU  = 'yonetim_kurulu';
    const TYPE_DENETIM_KURULU  = 'denetim_kurulu';

    // Scope'lar
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeBaskan($query)
    {
        return $query->where('type', self::TYPE_BASKAN);
    }

    public function scopeYonetimKurulu($query)
    {
        return $query->where('type', self::TYPE_YONETIM_KURULU);
    }

    public function scopeDenetimKurulu($query)
    {
        return $query->where('type', self::TYPE_DENETIM_KURULU);
    }

    // Fotoğraf URL helper
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('images/default-avatar.png');
    }
}