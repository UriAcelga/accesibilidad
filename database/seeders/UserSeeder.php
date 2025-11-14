<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Pepe',
                'password' => 'pass1234',
                'is_admin' => true
            ],
            [
                'name' => 'Maria',
                'password' => 'pass1234',
                'is_admin' => false
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
