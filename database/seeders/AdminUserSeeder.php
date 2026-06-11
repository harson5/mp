<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['name' => 'admin'],
            [
                'password' => '@dmin123',
                'role' => User::ROLE_ADMIN,
                'score' => 0,
            ]
        );
    }
}
