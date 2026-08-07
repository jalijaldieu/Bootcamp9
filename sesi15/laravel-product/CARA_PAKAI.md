# Cara Pakai File Ini

File-file ini adalah bagian dari project Laravel 13. Kamu tetap harus punya project Laravel yang sudah jalan (via `composer create-project laravel/laravel nama-project` atau project yang sudah ada).

## Langkah instalasi

1. Salin (copy-paste) setiap file ke lokasi yang sama persis di project Laravel-mu:

```
app/Models/Product.php
app/Models/ProductCategory.php
app/Http/Controllers/ProductController.php
database/migrations/2026_08_07_000001_create_product_categories_table.php
database/migrations/2026_08_07_000002_create_products_table.php
database/seeders/ProductSeeder.php
resources/views/products/index.blade.php
routes/web.php   -> tinggal tambahkan isi route ke web.php yang sudah ada
```

   > Untuk `routes/web.php`: jangan timpa file yang sudah ada, cukup tambahkan baris route-nya ke file `web.php` milikmu.

2. Daftarkan seeder di `database/seeders/DatabaseSeeder.php`:

```php
public function run(): void
{
    $this->call(ProductSeeder::class);
}
```

3. Pastikan `.env` sudah terhubung ke database (buat database-nya dulu manual di MySQL/phpMyAdmin).

4. Jalankan migrasi & seeder:

```bash
php artisan migrate
php artisan db:seed
```

5. Jalankan server:

```bash
php artisan serve
```

6. Buka di browser:

```
http://127.0.0.1:8000/products
```

Data produk beserta kategori akan tampil dalam tabel, lengkap dengan pagination di bagian bawah (10 data per halaman).
