<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Define some example questions for test data
        for ($i = 0; $i < 10; $i++) { // Adjust the loop to create as many questions as you want
            DB::table('questions')->insert([
                'exam_id' => 1, // Assume exam_id = 1 for test data, adjust accordingly
                'content' => $faker->sentence, // Generate random question content
                'category' => $faker->word, // Generate random category for the question
                'status' => 1, // Active status
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
