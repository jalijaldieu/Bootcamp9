<?php
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama      = trim($_POST['nama'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $harga     = (float) ($_POST['harga'] ?? 0);
    $gambar    = '';

    if ($nama === '' || $harga <= 0) {
        $error = 'Nama produk dan harga wajib diisi dengan benar.';
    } else {
        // Upload gambar jika ada
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($ext, $allowed)) {
                $gambar = uniqid('produk_') . '.' . $ext;
                move_uploaded_file($_FILES['gambar']['tmp_name'], __DIR__ . '/uploads/' . $gambar);
            }
        }

        $stmt = mysqli_prepare($conn, "INSERT INTO produk (nama, deskripsi, harga, gambar) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssds", $nama, $deskripsi, $harga, $gambar);
        mysqli_stmt_execute($stmt);

        header("Location: index.php?pesan=Produk berhasil ditambahkan");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Produk - Toko Sederhana</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <h1>Toko Sederhana</h1>
    <nav>
        <a href="index.php">Daftar Produk</a>
        <a href="tambah_produk.php">+ Tambah Produk</a>
        <a href="keranjang.php">🛒 Keranjang</a>
    </nav>
</header>

<main class="container">
    <a href="index.php" class="back-link">&larr; Kembali ke daftar produk</a>

    <div class="form-card">
        <h2>Tambah Produk</h2>

        <?php if ($error): ?>
            <div class="alert" style="background:#fdeaea;color:#c62828;border-color:#f6c6c6;"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="tambah_produk.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Produk:</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk:</label>
                <textarea id="deskripsi" name="deskripsi"><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga Produk:</label>
                <input type="number" id="harga" name="harga" min="0" step="100" value="<?= htmlspecialchars($_POST['harga'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="gambar">Upload Gambar:</label>
                <input type="file" id="gambar" name="gambar" accept="image/*">
            </div>

            <button type="submit" class="btn btn-hijau">Tambah Produk</button>
        </form>
    </div>
</main>

</body>
</html>
