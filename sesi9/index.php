<?php
session_start();
require_once 'config.php';

$result = mysqli_query($conn, "SELECT * FROM produk ORDER BY created_at DESC");
$jumlah_keranjang = isset($_SESSION['keranjang']) ? count($_SESSION['keranjang']) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toko Sederhana</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1>Toko Sederhana</h1>
    <nav>
        <a href="index.php">Daftar Produk</a>
        <a href="tambah_produk.php">+ Tambah Produk</a>
        <a href="keranjang.php">🛒 Keranjang (<?= $jumlah_keranjang ?>)</a>
    </nav>
</header>

<main class="container">

    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert"><?= htmlspecialchars($_GET['pesan']) ?></div>
    <?php endif; ?>

    <div class="produk-grid">
        <?php if (mysqli_num_rows($result) === 0): ?>
            <p>Belum ada produk. <a href="tambah_produk.php">Tambah produk baru</a>.</p>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="produk-card">
                    <?php if (!empty($row['gambar']) && file_exists('uploads/' . $row['gambar'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
                    <?php else: ?>
                        <div class="no-image">Tidak ada gambar</div>
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($row['nama']) ?></h3>
                    <p class="deskripsi"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
                    <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>

                    <form action="tambah_keranjang.php" method="POST" class="inline-form">
                        <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                        <button type="submit" class="btn btn-hijau">Tambah ke Keranjang</button>
                    </form>

                    <div class="aksi">
                        <a href="edit_produk.php?id=<?= (int) $row['id'] ?>" class="btn btn-kecil">Edit</a>
                        <a href="hapus_produk.php?id=<?= (int) $row['id'] ?>"
                           class="btn btn-kecil btn-merah"
                           onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

</main>

</body>
</html>
