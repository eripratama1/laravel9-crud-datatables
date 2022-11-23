<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /**
     * Menjalankan proses seeder ke tabel category
     * dan memanggil method factory
     */

    public function run()
    {
        Category::factory()->count(10)->create();
    }
}
