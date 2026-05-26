<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        Competition::create([
            'name' => 'Data Analytics Competition',
            'slug' => 'data-analytics',
            'description' => 'Master real-world datasets, perform data cleaning and analysis, discover insights, and present compelling data-driven solutions to real problems.',
            'min_members' => 2,
            'max_members' => 3,
            'max_teams' => 24,
            'registration_fee' => 150000,
            'is_active' => true,
        ]);

        Competition::create([
            'name' => 'Tech Rally Games',
            'slug' => 'tech-rally',
            'description' => 'Race against time through technology puzzles, coding challenges, and hands-on missions. Test your team\'s speed, logic, and technical expertise.',
            'min_members' => 3,
            'max_members' => 3,
            'max_teams' => 24,
            'registration_fee' => 150000,
            'is_active' => true,
        ]);
    }
}
