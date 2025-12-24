<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];

        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'message' => $faker->realText(150),
                'is_reviewed' => $faker->boolean(30),
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at' => now(),
            ];
        }

        DB::table('feedback')->insert($data);
    }
}