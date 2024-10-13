<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 10)),
            // 'content' => collect($this->faker->paragraphs(mt_rand(5, 8)))
            //             ->map(fn ($p) => "<p>$p</p>")
            //             ->implode(''),
            'content' => $this->faker->paragraph(mt_rand(5, 8)),
            'image' => $this->faker->imageUrl(640, 480, 'transport'),
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'category_id' => $this->faker->numberBetween(1, Category::count())
        ];
    }
}
