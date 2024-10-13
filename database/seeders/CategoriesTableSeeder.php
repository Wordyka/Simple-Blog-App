<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            Category::insert([
                'name' => $faker->word,
                'user_id' => $faker->numberBetween(1, 4), // Random user_id from UsersTableSeeder
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
