<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'branch_id', 'home_team', 'away_team',
        'home_team_logo', 'away_team_logo',
        'match_date', 'venue', 'competition', 'status'
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    // Scope'lar
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
                     ->where('match_date', '>=', now())
                     ->orderBy('match_date');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed')
                     ->orderBy('match_date', 'desc');
    }

    // Status Türkçe
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'upcoming'  => 'Yaklaşan',
            'live'      => 'Canlı',
            'completed' => 'Tamamlandı',
            default     => '-',
        };
    }
}