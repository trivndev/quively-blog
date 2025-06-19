<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        $title = fake()->sentence(random_int(3, 10));
        return [
            'slug' => Str::slug($title),
            'title' => $title,
            'category_id' => Category::factory(),
            'blog_content' => fake()->paragraphs(20, true),
            'author_id' => User::factory(),
        ];
    }
}
