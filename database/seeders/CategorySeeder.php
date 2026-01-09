<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'code' => 'SAYUR',
                'name' => 'Sayuran',
                'description' => 'Bahan sayuran segar',
            ],
            [
                'code' => 'BUAH',
                'name' => 'Buah-buahan',
                'description' => 'Buah segar dan lokal',
            ],
            [
                'code' => 'BAHAN_POKOK',
                'name' => 'Bahan Pokok',
                'description' => 'Bahan pangan utama',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
