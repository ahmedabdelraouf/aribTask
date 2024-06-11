<?php

namespace Database\Seeders;

use App\Models\Department;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $numberOfDepartments = 5;

        for ($i = 0; $i < $numberOfDepartments; $i++) {
            Department::create([
                'name' => $faker->unique()->word // Faker will generate unique department names
            ]);
        }
    }
}
