<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin DIGIon',
            'email' => 'admin@digion.id',
            'password' => bcrypt('password'),
        ]);
    }
}
