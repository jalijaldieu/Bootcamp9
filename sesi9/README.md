# Toko Sederhana (PHP + MySQL)

Aplikasi CRUD produk sederhana + keranjang belanja, tanpa fitur login/logout.

## Fitur

1. **CRUD Produk**
   - Create: `tambah_produk.php`
   - Read: `index.php`
   - Update: `edit_produk.php`
   - Delete: `hapus_produk.php`
2. **Keranjang Belanja**
   - Tambah produk ke keranjang dari halaman utama
   - Ubah jumlah (qty) atau hapus item di `keranjang.php`
   - Keranjang disimpan menggunakan PHP session (tidak perlu login)

## Cara Menjalankan (XAMPP / Laragon / sejenisnya)

1. Copy folder `toko-sederhana` ke dalam folder `htdocs` (XAMPP) atau `www` (Laragon).
2. Jalankan Apache & MySQL.
3. Buka **phpMyAdmin**, lalu import file `database.sql` (ini akan membuat database `toko_db` beserta tabel `produk` dan 3 contoh data).
4. Pastikan folder `uploads/` bisa ditulis (writable) — di XAMPP biasanya sudah otomatis bisa.
5. Buka browser ke: `http://localhost/toko-sederhana/index.php`

Jika konfigurasi database kamu berbeda (misalnya MySQL punya password), sesuaikan di file `config.php`.

## Struktur File

```
toko-sederhana/
├── config.php            # Koneksi database
├── database.sql          # Skema database + data contoh
├── index.php              # Daftar produk (Read) + tambah ke keranjang
├── tambah_produk.php      # Form & proses tambah produk (Create)
├── edit_produk.php        # Form & proses edit produk (Update)
├── hapus_produk.php       # Proses hapus produk (Delete)
├── keranjang.php          # Halaman keranjang belanja
├── tambah_keranjang.php   # Proses tambah item ke keranjang
├── update_keranjang.php   # Proses update qty item keranjang
├── hapus_keranjang.php    # Proses hapus item dari keranjang
├── style.css              # Styling
└── uploads/                # Folder penyimpanan gambar produk
```

## Catatan

- Tidak ada sistem login/logout — semua orang yang mengakses bisa CRUD produk.
- Keranjang bersifat per-session browser (setiap sesi browser punya keranjang sendiri).
- Harga disimpan sebagai `DECIMAL(12,2)` di database.
