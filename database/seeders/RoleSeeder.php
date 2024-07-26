<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'role' => 'GUEST'
            ],
            [
                'id' => 2,
                'role' => 'USER'
            ],
            [
                'id' => 3,
                'role' => 'ADMIN'
            ]
        ];
        foreach ($data as $value) {
            Role::create($value);
        }
    }
}
