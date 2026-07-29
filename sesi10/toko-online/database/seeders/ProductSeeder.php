<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Kaos Polos Premium',
                'description' => 'Kaos katun combed 30s, nyaman dan adem dipakai sehari-hari.',
                'price' => 85000,
                'stock' => 50,
                'image' => null,
            ],
            [
                'name' => 'Sepatu Sneakers Casual',
                'description' => 'Sepatu sneakers ringan cocok untuk aktivitas santai maupun olahraga ringan.',
                'price' => 275000,
                'stock' => 25,
                'image' => null,
            ],
            [
                'name' => 'Tas Ransel Laptop',
                'description' => 'Tas ransel anti air dengan kompartemen khusus laptop 14 inci.',
                'price' => 199000,
                'stock' => 30,
                'image' => null,
            ],
            [
                'name' => 'Jaket Hoodie Unisex',
                'description' => 'Hoodie tebal berbahan fleece, hangat dan cocok untuk cuaca dingin.',
                'price' => 159000,
                'stock' => 40,
                'image' => null,
            ],
            [
                'name' => 'Topi Baseball Cap',
                'description' => 'Topi baseball dengan desain minimalis, adjustable strap.',
                'price' => 65000,
                'stock' => 60,
                'image' => null,
            ],
            [
                'name' => 'Botol Minum Stainless',
                'description' => 'Botol minum 500ml, menjaga suhu minuman tetap dingin/hangat hingga 12 jam.',
                'price' => 95000,
                'stock' => 45,
                'image' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
