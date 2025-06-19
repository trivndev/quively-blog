<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'claire',
            'username' => 'claire',
            'email' => 'nicolas100107@gmail.com',
            'password' => Hash::make('Cherry1117,.')
        ]);

        User::factory(10)->create();
    }
}
