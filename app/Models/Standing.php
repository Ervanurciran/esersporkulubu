<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    protected $fillable = [
        'branch_id', 'season', 'competition', 'team_name', 'team_logo',
        'played', 'won', 'drawn', 'lost',
        'goals_for', 'goals_against', 'points', 'sort_order'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Gol farkı
    public function getGoalDiffAttribute(): int
    {
        return $this->goals_for - $this->goals_against;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('points', 'desc')
                     ->orderBy('goals_for', 'desc');
    }
}