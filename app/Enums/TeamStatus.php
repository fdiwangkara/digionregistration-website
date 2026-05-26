<?php

namespace App\Enums;

enum TeamStatus: string
{
    case PendingPayment = 'pending_payment';
    case PendingReview = 'pending_review';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case WaitingList = 'waiting_list';

    public function label(): string
    {
        return match ($this) {
            self::PendingPayment => 'Pending Payment',
            self::PendingReview => 'Pending Review',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
            self::WaitingList => 'Waiting List',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PendingPayment => 'amber',
            self::PendingReview => 'blue',
            self::Approved => 'emerald',
            self::Rejected => 'red',
            self::WaitingList => 'purple',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::PendingPayment => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
            self::PendingReview => 'bg-blue-500/10 text-blue-300 border-blue-400/20',
            self::Approved => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
            self::Rejected => 'bg-red-500/10 text-red-400 border-red-500/20',
            self::WaitingList => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PendingPayment => 'fa-solid fa-clock',
            self::PendingReview => 'fa-solid fa-hourglass-half',
            self::Approved => 'fa-solid fa-check-circle',
            self::Rejected => 'fa-solid fa-times-circle',
            self::WaitingList => 'fa-solid fa-list-ol',
        };
    }
}
