<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'branch_id', 'fixture_id', 'home_team', 'away_team',
        'home_team_logo', 'away_team_logo',
        'home_score', 'away_score',
        'match_date', 'competition', 'summary'
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }

    // Sonuç etiketi (Eser Spor kazandı mı?)
    public function getOutcomeAttribute(): string
    {
        if ($this->home_score > $this->away_score) return 'Galibiyet';
        if ($this->home_score < $this->away_score) return 'Mağlubiyet';
        return 'Beraberlik';
    }
}