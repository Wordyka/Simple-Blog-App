<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str; 

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 4) as $index) {
            User::insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 'admin',
                'email_verified_at' => $faker->optional()->dateTime(),
                'password' => Hash::make('password'), // You can hash a default password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
