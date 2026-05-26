<?php

namespace App\Http\Controllers;

use App\Models\Competition;

class LandingController extends Controller
{
    public function index()
    {
        $competitions = Competition::where('is_active', true)->get();

        return view('pages.landing', compact('competitions'));
    }
}
