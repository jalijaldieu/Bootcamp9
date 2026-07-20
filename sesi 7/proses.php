<?php
// Pastikan file diakses melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Tugas Dasar PHP: Deklarasi Variabel ---
    // Mengambil data dari form dan membersihkannya dari karakter berbahaya
    $namaProduk = trim($_POST['nama']);
    $hargaProduk = trim($_POST['harga']);
    $deskripsiProduk = trim($_POST['deskripsi']);

    // --- Tugas Validasi PHP (Server-side) ---
    // Memastikan data yang diinputkan tidak kosong
    if (empty($namaProduk) || empty($hargaProduk) || empty($deskripsiProduk)) {
        echo "<h3 style='color:red;'>Gagal menyimpan data! Semua field wajib diisi.</h3>";
        echo "<a href='index.php'>Kembali ke Form</a>";
        exit;
    }

    // --- Tugas Dasar PHP: Penggunaan Operator & If-Else ---
    // Mengubah variabel harga menjadi tipe data angka (integer/float)
    $hargaInt = (int)$hargaProduk;

    // Menghitung diskon sederhana dengan operator aritmatika & relasional
    $diskon = 0;
    if ($hargaInt >= 100000) {
        $diskon = 0.10; // Diskon 10% jika harga >= 100.000
    } elseif ($hargaInt >= 50000) {
        $diskon = 0.05; // Diskon 5% jika harga >= 50.000
    }

    // Operator perkalian dan pengurangan
    $potonganHarga = $hargaInt * $diskon;
    $hargaAkhir = $hargaInt - $potonganHarga;

    // --- Output Hasil (Simulasi Sebelum Disimpan ke Database) ---
    echo "<h2>Data Produk Berhasil Diproses!</h2>";
    echo "<hr>";
    echo "<p><strong>Nama Produk:</strong> " . htmlspecialchars($namaProduk) . "</p>";
    echo "<p><strong>Harga Awal:</strong> Rp " . number_format($hargaInt, 0, ',', '.') . "</p>";
    echo "<p><strong>Diskon:</strong> " . ($diskon * 100) . "% (Rp " . number_format($potonganHarga, 0, ',', '.') . ")</p>";
    echo "<p><strong>Harga Setelah Diskon:</strong> Rp " . number_format($hargaAkhir, 0, ',', '.') . "</p>";
    echo "<p><strong>Deskripsi:</strong> " . nl2br(htmlspecialchars($deskripsiProduk)) . "</p>";
    
    echo "<br><a href='index.php'>+ Tambah Produk Lain</a>";

} else {
    // Jika file diakses langsung tanpa kirim form
    header("Location: index.php");
    exit;
}
?>