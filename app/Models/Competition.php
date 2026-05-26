<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'min_members',
        'max_members',
        'max_teams',
        'registration_fee',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'min_members' => 'integer',
            'max_members' => 'integer',
            'max_teams' => 'integer',
            'registration_fee' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function approvedTeamsCount(): int
    {
        return $this->teams()->where('status', 'approved')->count();
    }

    public function slotsRemaining(): int
    {
        return max(0, $this->max_teams - $this->approvedTeamsCount());
    }

    public function isFull(): bool
    {
        return $this->approvedTeamsCount() >= $this->max_teams;
    }
}
