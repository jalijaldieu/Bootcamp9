<?php
session_start();

$keranjang = $_SESSION['keranjang'] ?? [];
$total = 0;
foreach ($keranjang as $item) {
    $total += $item['harga'] * $item['qty'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keranjang - Toko Sederhana</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1>Toko Sederhana</h1>
    <nav>
        <a href="index.php">Daftar Produk</a>
        <a href="tambah_produk.php">+ Tambah Produk</a>
        <a href="keranjang.php">🛒 Keranjang (<?= count($keranjang) ?>)</a>
    </nav>
</header>

<main class="container">
    <a href="index.php" class="back-link">&larr; Kembali ke daftar produk</a>

    <h2 style="margin-bottom:18px;">Keranjang Belanja</h2>

    <?php if (empty($keranjang)): ?>
        <div class="keranjang-kosong">
            <p>Keranjang kamu masih kosong.</p>
            <br>
            <a href="index.php" class="btn btn-hijau" style="display:inline-block;width:auto;padding:10px 24px;">Belanja Sekarang</a>
        </div>
    <?php else: ?>
        <table class="keranjang-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjang as $id => $item): ?>
                    <?php $subtotal = $item['harga'] * $item['qty']; ?>
                    <tr>
                        <td>
                            <div class="produk-info">
                                <?php if (!empty($item['gambar']) && file_exists('uploads/' . $item['gambar'])): ?>
                                    <img src="uploads/<?= htmlspecialchars($item['gambar']) ?>" alt="<?= htmlspecialchars($item['nama']) ?>">
                                <?php endif; ?>
                                <span><?= htmlspecialchars($item['nama']) ?></span>
                            </div>
                        </td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td>
                            <form action="update_keranjang.php" method="POST" class="qty-form">
                                <input type="hidden" name="id" value="<?= (int) $id ?>">
                                <input type="number" name="qty" value="<?= (int) $item['qty'] ?>" min="1">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        <td>
                            <a href="hapus_keranjang.php?id=<?= (int) $id ?>" class="hapus-link"
                               onclick="return confirm('Hapus produk ini dari keranjang?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>

</main>

</body>
</html>
