<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory;

class ProductSeeder extends Seeder
{

    private $lastNumber;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->lastNumber = 0;

        $faker = Factory::create();
        $users = User::get();

        foreach ($users as $user) {
            $collections = [];

            for ($i = 1; $i <= 10; $i++) {
                $this->lastNumber++;

                $code = date('Ymd') . sprintf('%05d', $this->lastNumber);
                $collections[] = [
                    'code' => $code,
                    'name' => implode(' ', $faker->words()),
                    'description' => $faker->paragraph(),
                    'quantity' => $faker->numberBetween(100, 1000),
                    'price' => $faker->numberBetween(1, 100) * 1000,
                ];
            }

            $user->products()->createMany($collections);
        }
    }
}
