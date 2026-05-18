<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'page_key', 'title', 'content', 'file_path'
    ];

    public static function getByKey(string $key): ?self
    {
        return static::where('page_key', $key)->first();
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path
            ? asset('storage/' . $this->file_path)
            : null;
    }
}