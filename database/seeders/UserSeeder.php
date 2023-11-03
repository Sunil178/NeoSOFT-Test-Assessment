<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Neo',
            'last_name' => 'SOFT',
            'email' => 'neo@gmail.com',
            'username' => 'neo',
            'company' => 'NeoSOFT Technologies',
            'type' => '1',
            'password' => Hash::make('12341234'),
        ]);

        User::create([
            'first_name' => 'Sunil',
            'last_name' => 'Thakur',
            'email' => 'sunil@gmail.com',
            'username' => 'sunil',
            'type' => '2',
            'password' => Hash::make('12341234'),
        ]);
    }
}
