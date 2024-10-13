<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Faker\Factory as Faker;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Article::insert([
                'title' => $faker->sentence,
                'content' => implode("\n\n", $faker->paragraphs(4)), 
                'image' => 'https://picsum.photos/640/480?random=' . $index, 
                'user_id' => $faker->numberBetween(1, 4), // Random user_id from UsersTableSeeder
                'category_id' => $faker->numberBetween(1, 5), // Random category_id from CategoriesTableSeeder
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
