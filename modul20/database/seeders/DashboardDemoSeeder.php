<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DashboardDemoSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriList = ['Elektronik', 'Fashion', 'Makanan & Minuman', 'Peralatan Rumah'];

        foreach ($kategoriList as $nama) {
            $kategori = Category::create(['name' => $nama]);

            for ($i = 1; $i <= 5; $i++) {
                Product::create([
                    'name'        => "$nama Produk $i",
                    'category_id' => $kategori->id,
                    'price'       => rand(10, 500) * 1000,
                    'clicks'      => rand(0, 300),
                ]);
            }
        }
    }
}
