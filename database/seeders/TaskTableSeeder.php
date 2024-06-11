<?php

namespace Database\Seeders;

use App\Models\Task;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define the number of tasks you want to create
        $numberOfTasks = 50;

        // Create tasks using Faker
        for ($i = 0; $i < $numberOfTasks; $i++) {
            Task::create([
                'subject' => $faker->sentence,
                'description' => $faker->paragraph,
                'user_id' => null,
                'status' => 'todo'
            ]);
        }
    }
}
