<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'Elektronik',
                'name' => 'Headphone Bluetooth X100',
                'description' => 'Headphone wireless dengan noise cancelling dan baterai tahan 20 jam.',
                'stock' => 25,
                'image' => 'products/headphone-x100.jpg',
            ],
            [
                'category' => 'Elektronik',
                'name' => 'Power Bank 10000mAh',
                'description' => 'Power bank ringkas dengan fast charging 18W.',
                'stock' => 40,
                'image' => 'products/powerbank-10000.jpg',
            ],
            [
                'category' => 'Fashion Pria',
                'name' => 'Kemeja Flanel Lengan Panjang',
                'description' => 'Kemeja flanel motif kotak, bahan katun lembut, cocok untuk santai.',
                'stock' => 15,
                'image' => 'products/kemeja-flanel.jpg',
            ],
            [
                'category' => 'Fashion Wanita',
                'name' => 'Dress Casual Motif Bunga',
                'description' => 'Dress santai dengan motif bunga, cocok dipakai sehari-hari.',
                'stock' => 20,
                'image' => 'products/dress-bunga.jpg',
            ],
            [
                'category' => 'Peralatan Rumah Tangga',
                'name' => 'Blender Portable 500ml',
                'description' => 'Blender mini isi ulang USB, cocok untuk membuat jus buah.',
                'stock' => 10,
                'image' => 'products/blender-portable.jpg',
            ],
            [
                'category' => 'Kesehatan & Kecantikan',
                'name' => 'Serum Vitamin C 30ml',
                'description' => 'Serum wajah untuk mencerahkan dan meratakan warna kulit.',
                'stock' => 50,
                'image' => 'products/serum-vitc.jpg',
            ],
            [
                'category' => 'Olahraga',
                'name' => 'Matras Yoga Anti Slip',
                'description' => 'Matras yoga tebal 10mm dengan permukaan anti slip.',
                'stock' => 18,
                'image' => 'products/matras-yoga.jpg',
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();

            Product::create([
                'category_id' => $category?->id,
                'name' => $item['name'],
                'description' => $item['description'],
                'stock' => $item['stock'],
                'image' => $item['image'],
            ]);
        }
    }
}
