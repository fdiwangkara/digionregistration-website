<?php

namespace App\Http\Controllers;

use App\Enums\TeamStatus;
use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Competition;
use App\Models\Team;
use App\Services\CompetitionSlotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function __construct(
        private CompetitionSlotService $slotService
    ) {}

    public function create(Request $request)
    {
        $competitions = Competition::where('is_active', true)->get();
        $selectedCategory = $request->query('category');

        return view('pages.register', compact('competitions', 'selectedCategory'));
    }

    public function store(StoreRegistrationRequest $request)
    {
        $validated = $request->validated();

        return DB::transaction(function () use ($validated, $request) {
            $competition = Competition::findOrFail($validated['competition_id']);

            // Determine initial status based on slot availability
            $status = $this->slotService->determineInitialStatus($competition);

            // Handle file uploads
            $studentCardPath = $request->file('student_card')->store('uploads/student-cards', 'public');
            $twibbonPath = $request->file('twibbon')->store('uploads/twibbons', 'public');
            $paymentProofPath = $request->file('payment_proof')->store('uploads/payment-proofs', 'public');

            // Get leader info from first member
            $leader = collect($validated['members'])->first(fn($m) => ($m['is_leader'] ?? false)) ?? $validated['members'][0];

            // Create team
            $team = Team::create([
                'competition_id' => $competition->id,
                'team_name' => $validated['team_name'],
                'school_name' => $validated['school_name'],
                'instagram' => $validated['instagram'],
                'leader_email' => $leader['email'],
                'leader_phone' => $leader['phone'],
                'student_card_path' => $studentCardPath,
                'twibbon_path' => $twibbonPath,
                'payment_proof_path' => $paymentProofPath,
                'status' => $status,
            ]);

            // Assign queue position if waiting list
            if ($status === TeamStatus::WaitingList) {
                $this->slotService->assignQueuePosition($team);
            }

            // Create members
            foreach ($validated['members'] as $index => $memberData) {
                $team->members()->create([
                    'full_name' => $memberData['full_name'],
                    'birth_place' => $memberData['birth_place'],
                    'birth_date' => $memberData['birth_date'],
                    'nisn' => $memberData['nisn'],
                    'phone' => $memberData['phone'],
                    'email' => $memberData['email'],
                    'is_leader' => $index === 0 || ($memberData['is_leader'] ?? false),
                ]);
            }

            return redirect()->route('register.success', $team->registration_code);
        });
    }

    public function success(string $code)
    {
        $team = Team::where('registration_code', $code)
            ->with(['competition', 'members'])
            ->firstOrFail();

        return view('pages.register-success', compact('team'));
    }
}
