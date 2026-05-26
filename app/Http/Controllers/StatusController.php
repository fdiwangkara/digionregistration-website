<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('pages.team-status', ['team' => null]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:20'],
        ]);

        $team = Team::where('registration_code', $request->input('code'))
            ->with(['competition', 'members'])
            ->first();

        return view('pages.team-status', [
            'team' => $team,
            'code' => $request->input('code'),
            'searched' => true,
        ]);
    }
}
