<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as Model;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Model::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]);
        }
    }
}
