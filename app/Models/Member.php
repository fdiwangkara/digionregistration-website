<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'team_id',
        'full_name',
        'birth_place',
        'birth_date',
        'nisn',
        'phone',
        'email',
        'is_leader',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_leader' => 'boolean',
        ];
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function initials(): string
    {
        return collect(explode(' ', $this->full_name))
            ->map(fn($word) => strtoupper(mb_substr($word, 0, 1)))
            ->take(2)
            ->join('');
    }
}
