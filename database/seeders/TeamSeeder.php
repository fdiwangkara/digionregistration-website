<?php

namespace Database\Seeders;

use App\Enums\TeamStatus;
use App\Models\Competition;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $dataAnalytics = Competition::where('slug', 'data-analytics')->first();
        $techRally = Competition::where('slug', 'tech-rally')->first();

        $dummyTeams = [
            ['name' => 'Byte Crusaders', 'school' => 'SMAN 1 Malang', 'comp' => $dataAnalytics, 'status' => TeamStatus::Approved, 'members' => 3],
            ['name' => 'Data Warriors', 'school' => 'SMKN 4 Surabaya', 'comp' => $dataAnalytics, 'status' => TeamStatus::Approved, 'members' => 2],
            ['name' => 'Neural Nexus', 'school' => 'SMAN 3 Jakarta', 'comp' => $techRally, 'status' => TeamStatus::Approved, 'members' => 3],
            ['name' => 'Pixel Pioneers', 'school' => 'SMA Kristen Petra', 'comp' => $techRally, 'status' => TeamStatus::PendingReview, 'members' => 3],
            ['name' => 'Code Breakers', 'school' => 'SMAN 2 Bandung', 'comp' => $dataAnalytics, 'status' => TeamStatus::PendingReview, 'members' => 3],
            ['name' => 'Algo Aces', 'school' => 'SMKN 1 Yogyakarta', 'comp' => $techRally, 'status' => TeamStatus::Approved, 'members' => 3],
            ['name' => 'Cyber Sentinels', 'school' => 'SMAN 5 Semarang', 'comp' => $dataAnalytics, 'status' => TeamStatus::Rejected, 'members' => 2],
            ['name' => 'Stack Overflow', 'school' => 'SMA Labschool Jakarta', 'comp' => $techRally, 'status' => TeamStatus::WaitingList, 'members' => 3],
            ['name' => 'Logic Lords', 'school' => 'SMAN 1 Denpasar', 'comp' => $dataAnalytics, 'status' => TeamStatus::Approved, 'members' => 3],
            ['name' => 'Binary Blaze', 'school' => 'SMKN 7 Malang', 'comp' => $techRally, 'status' => TeamStatus::PendingPayment, 'members' => 3],
            ['name' => 'Quantum Coders', 'school' => 'SMAN 8 Surabaya', 'comp' => $dataAnalytics, 'status' => TeamStatus::Approved, 'members' => 2],
            ['name' => 'Tech Titans', 'school' => 'SMA Dian Harapan', 'comp' => $techRally, 'status' => TeamStatus::WaitingList, 'members' => 3],
            ['name' => 'Debug Dynasty', 'school' => 'SMAN 1 Medan', 'comp' => $dataAnalytics, 'status' => TeamStatus::Approved, 'members' => 3],
            ['name' => 'Infinite Loop', 'school' => 'SMKN 2 Bekasi', 'comp' => $techRally, 'status' => TeamStatus::Approved, 'members' => 3],
            ['name' => 'Hash Heroes', 'school' => 'SMAN 4 Makassar', 'comp' => $dataAnalytics, 'status' => TeamStatus::WaitingList, 'members' => 2],
        ];

        $firstNames = ['Andi', 'Siti', 'Budi', 'Rina', 'Dimas', 'Amelia', 'Reza', 'Putri', 'Agus', 'Maya', 'Fajar', 'Dewi', 'Rizky', 'Ayu', 'Bayu'];
        $lastNames = ['Prasetyo', 'Nurhaliza', 'Santoso', 'Wijaya', 'Arya', 'Putri', 'Fahlevi', 'Rahayu', 'Hidayat', 'Puspita', 'Nugraha', 'Lestari', 'Kusuma', 'Sari', 'Wibowo'];
        $cities = ['Malang', 'Surabaya', 'Jakarta', 'Bandung', 'Yogyakarta', 'Semarang', 'Denpasar', 'Medan', 'Makassar', 'Bekasi'];

        $queuePos = 1;

        foreach ($dummyTeams as $index => $data) {
            $leaderName = $firstNames[$index] . ' ' . $lastNames[$index];
            $leaderEmail = strtolower(str_replace(' ', '.', $leaderName)) . '@gmail.com';

            $team = Team::create([
                'competition_id' => $data['comp']->id,
                'team_name' => $data['name'],
                'school_name' => $data['school'],
                'instagram' => '@' . strtolower(str_replace(' ', '', $data['name'])),
                'leader_email' => $leaderEmail,
                'leader_phone' => '0812' . str_pad(rand(1000000, 9999999), 8, '0'),
                'status' => $data['status'],
                'queue_position' => $data['status'] === TeamStatus::WaitingList ? $queuePos++ : null,
                'rejection_reason' => $data['status'] === TeamStatus::Rejected ? 'Incomplete documentation submitted.' : null,
            ]);

            // Create members
            for ($m = 0; $m < $data['members']; $m++) {
                $nameIdx = ($index * 3 + $m) % count($firstNames);
                $lastIdx = ($index * 3 + $m + 1) % count($lastNames);
                $memberName = $firstNames[$nameIdx] . ' ' . $lastNames[$lastIdx];

                $team->members()->create([
                    'full_name' => $memberName,
                    'birth_place' => $cities[array_rand($cities)],
                    'birth_date' => now()->subYears(rand(16, 18))->subDays(rand(0, 365))->format('Y-m-d'),
                    'nisn' => '00' . str_pad(rand(10000000, 99999999), 8, '0'),
                    'phone' => '0813' . str_pad(rand(1000000, 9999999), 8, '0'),
                    'email' => strtolower(str_replace(' ', '.', $memberName)) . '@gmail.com',
                    'is_leader' => $m === 0,
                ]);
            }
        }
    }
}
