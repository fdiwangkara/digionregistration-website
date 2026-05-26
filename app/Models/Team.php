<?php

namespace App\Models;

use App\Enums\TeamStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'competition_id',
        'registration_code',
        'team_name',
        'school_name',
        'instagram',
        'leader_email',
        'leader_phone',
        'student_card_path',
        'twibbon_path',
        'payment_proof_path',
        'status',
        'queue_position',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'status' => TeamStatus::class,
            'queue_position' => 'integer',
        ];
    }

    /**
     * Boot method to generate registration code on creation.
     */
    protected static function booted(): void
    {
        static::creating(function (Team $team) {
            if (empty($team->registration_code)) {
                $team->registration_code = self::generateRegistrationCode();
            }
        });
    }

    public static function generateRegistrationCode(): string
    {
        $year = date('Y');
        $latest = self::whereYear('created_at', $year)->max('id') ?? 0;
        $number = str_pad($latest + 1, 4, '0', STR_PAD_LEFT);
        return "DGN-{$year}-{$number}";
    }

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function leader(): ?Member
    {
        return $this->members()->where('is_leader', true)->first();
    }

    public function isApproved(): bool
    {
        return $this->status === TeamStatus::Approved;
    }

    public function isPending(): bool
    {
        return in_array($this->status, [TeamStatus::PendingPayment, TeamStatus::PendingReview]);
    }

    public function isOnWaitingList(): bool
    {
        return $this->status === TeamStatus::WaitingList;
    }

    public function scopeByStatus($query, TeamStatus $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch($query, ?string $search)
    {
        if (! $search) return $query;

        return $query->where(function ($q) use ($search) {
            $q->where('team_name', 'like', "%{$search}%")
              ->orWhere('registration_code', 'like', "%{$search}%")
              ->orWhere('school_name', 'like', "%{$search}%");
        });
    }
}
