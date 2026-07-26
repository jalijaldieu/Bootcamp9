<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM produk WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $produk = mysqli_stmt_get_result($stmt)->fetch_assoc();

    if ($produk) {
        if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = [];
        }

        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id]['qty']++;
        } else {
            $_SESSION['keranjang'][$id] = [
                'nama'   => $produk['nama'],
                'harga'  => $produk['harga'],
                'gambar' => $produk['gambar'],
                'qty'    => 1,
            ];
        }
    }
}

header("Location: index.php?pesan=Produk ditambahkan ke keranjang");
exit;
