<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik',
            'Fashion Pria',
            'Fashion Wanita',
            'Peralatan Rumah Tangga',
            'Kesehatan & Kecantikan',
            'Olahraga',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
