<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Isi data dummy untuk kategori dan produk.
     */
    public function run(): void
    {
        $categories = ['Elektronik', 'Fashion', 'Makanan', 'Kesehatan'];

        foreach ($categories as $cat) {
            $category = ProductCategory::create(['name' => $cat]);

            for ($i = 1; $i <= 10; $i++) {
                Product::create([
                    'product_category_id' => $category->id,
                    'name' => $cat . ' Produk ' . $i,
                    'description' => 'Deskripsi produk ' . $i . ' untuk kategori ' . $cat,
                    'price' => rand(10000, 500000),
                    'stock' => rand(1, 100),
                ]);
            }
        }
    }
}
