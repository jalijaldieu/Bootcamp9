<?php
include '../database/database.php';
include '../template/header.php';

// ==================== PROSES CRUD ====================

// 1. TAMBAH PRODUK
if (isset($_POST['tambah'])) {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok'];
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $query = "INSERT INTO products (nama_produk, harga, deskripsi, stok) VALUES ('$nama_produk', '$harga', '$deskripsi', '$stok')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: produk.php?pesan=berhasil_tambah");
        exit();
    }
}

// 2. EDIT PRODUK
if (isset($_POST['edit'])) {
    $id          = (int)$_POST['id'];
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok'];
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $query = "UPDATE products SET nama_produk='$nama_produk', harga='$harga', deskripsi='$deskripsi', stok='$stok' WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: produk.php?pesan=berhasil_edit");
        exit();
    }
}

// 3. HAPUS PRODUK
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $query = "DELETE FROM products WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: produk.php?pesan=berhasil_hapus");
        exit();
    }
}
?>

<!-- ==================== TAMPILAN HALAMAN ==================== -->

<div class="row mb-3">
    <div class="col d-flex justify-content-between align-items-center">
        <h2>Daftar Produk</h2>
        <!-- Tombol Pemicu Modal Tambah -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Produk
        </button>
    </div>
</div>

<!-- Notifikasi Alert -->
<?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php 
            if ($_GET['pesan'] == 'berhasil_tambah') echo "Produk berhasil ditambahkan!";
            if ($_GET['pesan'] == 'berhasil_edit') echo "Data produk berhasil diperbarui!";
            if ($_GET['pesan'] == 'berhasil_hapus') echo "Produk berhasil dihapus!";
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Tabel Data Produk (READ) -->
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $result = mysqli_query($koneksi, "SELECT * FROM products ORDER BY id DESC");
                    if (mysqli_num_rows($result) > 0):
                        while ($row = mysqli_fetch_assoc($result)):
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($row['nama_produk']); ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><span class="badge bg-secondary"><?= $row['stok']; ?></span></td>
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            <td class="text-center">
                                <!-- Tombol Modal Edit -->
                                <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id']; ?>">
                                    Edit
                                </button>
                                <!-- Tombol Hapus -->
                                <a href="produk.php?hapus=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Edit Produk -->
                        <div class="modal fade" id="modalEdit<?= $row['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="produk.php" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($row['nama_produk']); ?>" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Harga (Rp)</label>
                                                    <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Stok</label>
                                                    <input type="number" name="stok" class="form-control" value="<?= $row['stok']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($row['deskripsi']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="edit" class="btn btn-warning">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data produk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="produk.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>