<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => \Str::slug($title),
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'publication_year' => $this->faker->year,
            'isbn_number' => $this->faker->isbn13,
            'description' => $this->faker->paragraph,
            'category_id' => Category::inRandomOrder()->value('id'),
            'status' => $this->faker->randomElement(['available', 'not_available']),
            'language' => $this->faker->languageCode,
            'cover' => 'img.jpeg',
        ];
    }
}
