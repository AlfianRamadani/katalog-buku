<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeweyDecimalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dewey_decimals')->insert([
            ['code' => 000.0, 'category' => 'Karya Umum', 'description' => 'Ensiklopedia, Jurnal, Buku Panduan'],
            ['code' => 100.0, 'category' => 'Filsafat & Psikologi', 'description' => 'Logika, Etika, Psikologi'],
            ['code' => 200.0, 'category' => 'Agama', 'description' => 'Studi Keagamaan, Teologi'],
            ['code' => 300.0, 'category' => 'Ilmu Sosial', 'description' => 'Sosiologi, Politik, Hukum'],
            ['code' => 400.0, 'category' => 'Bahasa', 'description' => 'Linguistik, Tata Bahasa'],
            ['code' => 500.0, 'category' => 'Ilmu Pengetahuan Alam', 'description' => 'Matematika, Astronomi, Biologi'],
            ['code' => 600.0, 'category' => 'Teknologi', 'description' => 'Teknik, Kedokteran, Pertanian'],
            ['code' => 700.0, 'category' => 'Seni & Rekreasi', 'description' => 'Musik, Olahraga, Hiburan'],
            ['code' => 800.0, 'category' => 'Kesusastraan', 'description' => 'Puisi, Drama, Novel'],
            ['code' => 900.0, 'category' => 'Sejarah & Geografi', 'description' => 'Sejarah Dunia, Peta, Geografi'],
        ]);
    }
}
