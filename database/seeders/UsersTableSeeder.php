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
        for ($i = 0; $i < 1; $i++) {
            print_r("Please enter admon cerdentials: ");
            $firstName = $this->command->ask('Enter first name: ');
            $lastName = $this->command->ask('Enter last name: ');
            $email = $this->command->ask('Enter email: ');
            $phone = $this->command->ask('Enter phone: ');
            $password = $this->command->ask('Enter the password: ');

            $this->doCreate("$firstName", "$lastName",
                $faker->randomFloat(2, 30000, 100000), null,
                "$email", User::ROLE_ADMIN, "$password",$phone);
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
        $this->doCreate("$faker->firstName", "$faker->lastName",
            $faker->randomFloat(2, 30000, 100000), "$managerId",
            $faker->unique()->safeEmail, "$role");
    }

    public function doCreate($firstName, $lastName, $salary, $managerId, $email, $role, $password = "Aa@#123456",$phone = null)
    {
        User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'salary' => $salary,
            'manager_id' => $managerId,
            'email' => $email,
            'email_verified_at' => now(),
            'phone' => $phone,
            'phone_verified_at' => now(),
            'password' => Hash::make($password),
            'remember_token' => null,
            'role' => $role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
