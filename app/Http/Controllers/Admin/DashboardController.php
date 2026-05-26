<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TeamStatus;
use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Team;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Team::count(),
            'approved' => Team::where('status', TeamStatus::Approved)->count(),
            'waiting' => Team::where('status', TeamStatus::WaitingList)->count(),
            'pending' => Team::whereIn('status', [TeamStatus::PendingReview, TeamStatus::PendingPayment])->count(),
            'rejected' => Team::where('status', TeamStatus::Rejected)->count(),
        ];

        $competitions = Competition::withCount([
            'teams',
            'teams as approved_teams_count' => fn($q) => $q->where('status', TeamStatus::Approved),
        ])->get();

        $recentTeams = Team::with('competition')
            ->latest()
            ->take(10)
            ->get();

        return view('pages.admin.dashboard', compact('stats', 'competitions', 'recentTeams'));
    }
}
