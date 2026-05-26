<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TeamStatus;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\CompetitionSlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function __construct(
        private CompetitionSlotService $slotService
    ) {}

    public function index(Request $request)
    {
        $query = Team::with('competition')
            ->when($request->input('search'), fn($q, $s) => $q->search($s))
            ->when($request->input('status'), fn($q, $s) => $q->where('status', $s))
            ->when($request->input('competition'), fn($q, $c) => $q->where('competition_id', $c));

        $teams = $query->latest()->paginate(15)->withQueryString();

        return view('pages.admin.teams-index', compact('teams'));
    }

    public function show(int $id)
    {
        $team = Team::with(['competition', 'members'])->findOrFail($id);

        return view('pages.admin.team-detail', compact('team'));
    }

    public function approve(int $id)
    {
        $team = Team::findOrFail($id);

        $success = $this->slotService->approveTeam($team);

        if ($success) {
            return back()->with('success', "Team \"{$team->team_name}\" has been approved.");
        }

        return back()->with('error', 'No available slots. The team could not be approved.');
    }

    public function reject(Request $request, int $id)
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $team = Team::findOrFail($id);

        $this->slotService->rejectTeam($team, $request->input('rejection_reason'));

        return back()->with('success', "Team \"{$team->team_name}\" has been rejected.");
    }

    public function downloadFile(int $id, string $type)
    {
        $team = Team::findOrFail($id);

        $pathMap = [
            'student_card' => $team->student_card_path,
            'twibbon' => $team->twibbon_path,
            'payment_proof' => $team->payment_proof_path,
        ];

        $path = $pathMap[$type] ?? null;

        if (! $path || ! Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($path);
    }
}
