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
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'publication_year' => $this->faker->year,
            'isbn_number' => $this->faker->isbn13,
            'description' => $this->faker->paragraph,
            'category_id' => Category::inRandomOrder()->value('id'),
            'sub_category' => $this->faker->word,
            'language' => $this->faker->languageCode,
            'cover' => asset('img.jpeg'),
        ];
    }
}
