<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Team;
use App\Services\CompetitionSlotService;
use Illuminate\Http\Request;

class WaitingListController extends Controller
{
    public function __construct(
        private CompetitionSlotService $slotService
    ) {}

    public function index(Request $request)
    {
        $competitions = Competition::withCount([
            'teams as approved_teams_count' => fn($q) => $q->where('status', 'approved'),
        ])->get();

        $waitingTeams = $this->slotService->getWaitingList(
            $request->input('competition') ? (int) $request->input('competition') : null
        );

        $totalApproved = Team::where('status', 'approved')->count();

        return view('pages.admin.waiting-list', compact('competitions', 'waitingTeams', 'totalApproved'));
    }

    public function promote(int $id)
    {
        $team = Team::findOrFail($id);

        $success = $this->slotService->promoteTeam($team);

        if ($success) {
            return back()->with('success', "Team \"{$team->team_name}\" has been promoted from the waiting list.");
        }

        return back()->with('error', 'Cannot promote team. No available slots or the team is not on the waiting list.');
    }
}
