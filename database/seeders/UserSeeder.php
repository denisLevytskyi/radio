<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now()->timestamp,
            'password' => \Hash::make('12345678'),
        ];
        if ($user = User::create($data)) {
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 1
            ]);
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 2
            ]);
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 3
            ]);
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 4
            ]);
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 5
            ]);
        }
    }
}
