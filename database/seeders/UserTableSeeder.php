<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super admin',
                'email' => 'kedhatonati@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('superadmin123'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H-i-s"),
                'updated_at' => date("Y-m-d H-i-s"),
            ]
        ]);
    }
}
