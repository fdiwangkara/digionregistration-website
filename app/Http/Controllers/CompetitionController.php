<?php

namespace App\Http\Controllers;

use App\Models\Competition;

class CompetitionController extends Controller
{
    public function show(string $slug)
    {
        $competition = Competition::where('slug', $slug)->firstOrFail();
        $approvedCount = $competition->approvedTeamsCount();
        $slotsRemaining = $competition->slotsRemaining();

        return view('pages.competition-detail', compact('competition', 'approvedCount', 'slotsRemaining'));
    }
}
