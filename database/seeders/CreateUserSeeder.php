<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Mortuza',
            'last_name' => 'Ahmed',
            'email' => 'mortuza00000@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
