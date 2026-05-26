<?php

namespace App\Services;

use App\Enums\TeamStatus;
use App\Models\Competition;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class CompetitionSlotService
{
    /**
     * Determine the initial status for a new team registration.
     * Uses lockForUpdate to prevent race conditions.
     */
    public function determineInitialStatus(Competition $competition): TeamStatus
    {
        return DB::transaction(function () use ($competition) {
            $approvedCount = Team::where('competition_id', $competition->id)
                ->where('status', TeamStatus::Approved)
                ->lockForUpdate()
                ->count();

            if ($approvedCount >= $competition->max_teams) {
                return TeamStatus::WaitingList;
            }

            return TeamStatus::PendingReview;
        });
    }

    /**
     * Approve a team. Validates slot availability with locking.
     */
    public function approveTeam(Team $team): bool
    {
        return DB::transaction(function () use ($team) {
            $team = Team::lockForUpdate()->findOrFail($team->id);

            if ($team->status === TeamStatus::Approved) {
                return true; // Already approved
            }

            $approvedCount = Team::where('competition_id', $team->competition_id)
                ->where('status', TeamStatus::Approved)
                ->lockForUpdate()
                ->count();

            if ($approvedCount >= $team->competition->max_teams) {
                return false; // No slots available
            }

            $team->update([
                'status' => TeamStatus::Approved,
                'queue_position' => null,
            ]);

            return true;
        });
    }

    /**
     * Reject a team. If the team was approved, auto-promote the next waiting list team.
     */
    public function rejectTeam(Team $team, string $reason = ''): void
    {
        DB::transaction(function () use ($team, $reason) {
            $team = Team::lockForUpdate()->findOrFail($team->id);
            $wasApproved = $team->status === TeamStatus::Approved;
            $competitionId = $team->competition_id;

            $team->update([
                'status' => TeamStatus::Rejected,
                'rejection_reason' => $reason,
                'queue_position' => null,
            ]);

            // If the rejected team was approved, promote the next in waiting list
            if ($wasApproved) {
                $this->promoteNextInQueue($competitionId);
            }
        });
    }

    /**
     * Promote the oldest waiting_list team to pending_review (FIFO).
     */
    public function promoteNextInQueue(int $competitionId): ?Team
    {
        return DB::transaction(function () use ($competitionId) {
            $nextTeam = Team::where('competition_id', $competitionId)
                ->where('status', TeamStatus::WaitingList)
                ->orderBy('queue_position')
                ->orderBy('created_at')
                ->lockForUpdate()
                ->first();

            if ($nextTeam) {
                $nextTeam->update([
                    'status' => TeamStatus::PendingReview,
                    'queue_position' => null,
                ]);

                // Reorder remaining waiting list
                $this->reorderWaitingList($competitionId);

                return $nextTeam->fresh();
            }

            return null;
        });
    }

    /**
     * Manually promote a specific team from waiting list.
     */
    public function promoteTeam(Team $team): bool
    {
        return DB::transaction(function () use ($team) {
            $team = Team::lockForUpdate()->findOrFail($team->id);

            if ($team->status !== TeamStatus::WaitingList) {
                return false;
            }

            $approvedCount = Team::where('competition_id', $team->competition_id)
                ->where('status', TeamStatus::Approved)
                ->lockForUpdate()
                ->count();

            if ($approvedCount >= $team->competition->max_teams) {
                return false;
            }

            $team->update([
                'status' => TeamStatus::PendingReview,
                'queue_position' => null,
            ]);

            $this->reorderWaitingList($team->competition_id);

            return true;
        });
    }

    /**
     * Assign queue position for a waiting list team.
     */
    public function assignQueuePosition(Team $team): void
    {
        $maxPosition = Team::where('competition_id', $team->competition_id)
            ->where('status', TeamStatus::WaitingList)
            ->max('queue_position') ?? 0;

        $team->update(['queue_position' => $maxPosition + 1]);
    }

    /**
     * Reorder queue positions sequentially after a promotion.
     */
    private function reorderWaitingList(int $competitionId): void
    {
        $teams = Team::where('competition_id', $competitionId)
            ->where('status', TeamStatus::WaitingList)
            ->orderBy('created_at')
            ->get();

        foreach ($teams as $index => $team) {
            $team->update(['queue_position' => $index + 1]);
        }
    }

    /**
     * Get count of approved teams for a competition.
     */
    public function getApprovedCount(Competition $competition): int
    {
        return $competition->teams()->where('status', TeamStatus::Approved)->count();
    }

    /**
     * Get waiting list for a competition, ordered by queue position.
     */
    public function getWaitingList(?int $competitionId = null)
    {
        $query = Team::where('status', TeamStatus::WaitingList)
            ->with(['competition', 'members'])
            ->orderBy('queue_position')
            ->orderBy('created_at');

        if ($competitionId) {
            $query->where('competition_id', $competitionId);
        }

        return $query->get();
    }
}
