<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Novel'],
            ['name' => 'Manga'],
            ['name' => 'Puisi'],
            ['name' => 'Fantasi'],
            ['name' => 'Horor'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Sejarah'],
            ['name' => 'Biografi'],
            ['name' => 'Komedi'],
            ['name' => 'Romansa'],
        ];
        Category::insert($categories);
    }
}
