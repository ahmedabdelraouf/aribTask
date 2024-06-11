<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 2; $i++) {
            $this->createUser($faker, User::ROLE_ADMIN);
        }
        for ($i = 0; $i < 5; $i++) {
            $this->createUser($faker, User::ROLE_MANAGER);
        }
        $managerIds = User::where("role", User::ROLE_MANAGER)->pluck("id")->toArray();
        for ($i = 0; $i < 15; $i++) {
            $this->createUser($faker, User::ROLE_EMPLOYEE, $managerIds);
        }
    }

    public function createUser($faker, $role, $managerIds = null)
    {
        $managerId = null;
        if (!empty($managerIds)) {
            $managerId = $managerIds[array_rand($managerIds)];
        }
        User::create([
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'salary' => $faker->randomFloat(2, 30000, 100000),
            'image' => null,
            'manager_id' => $managerId,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => $faker->boolean ? now() : null,
            'phone' => null,
            'phone_verified_at' => $faker->boolean ? now() : null,
            'password' => Hash::make('Aa@#123456'),
            'remember_token' => null,
            'role' => $role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
