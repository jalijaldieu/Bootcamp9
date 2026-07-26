<?php
require_once 'config.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT gambar FROM produk WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $produk = mysqli_stmt_get_result($stmt)->fetch_assoc();

    if ($produk && !empty($produk['gambar']) && file_exists(__DIR__ . '/uploads/' . $produk['gambar'])) {
        unlink(__DIR__ . '/uploads/' . $produk['gambar']);
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM produk WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

header("Location: index.php?pesan=Produk berhasil dihapus");
exit;
