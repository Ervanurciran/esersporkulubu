<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name', 'slug', 'icon', 'description',
        'cover_image', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // İlişkiler
    public function coaches()
    {
        return $this->hasMany(Coach::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function fixtures()
    {
        return $this->hasMany(Fixture::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function standings()
    {
        return $this->hasMany(Standing::class);
    }

    // Scope'lar
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}