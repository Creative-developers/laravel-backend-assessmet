<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =  Faker::create();

        foreach (range(1, 10) as $index) {
            User::create([
              'first_name' => $faker->firstName,
              'last_name' => $faker->lastName,
              'email' => $faker->unique()->safeEmail,
              'password' => Hash::make('test1122'),
            ]);
        }
    }
}
