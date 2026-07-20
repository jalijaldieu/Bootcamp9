<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Tambah Produk</h2>
    
    <!-- Tugas Form Input -->
    <form id="productForm" action="proses.php" method="POST" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="nama">Nama Produk:</label>
            <input type="text" id="nama" name="nama">
            <span id="errNama" class="error-message">Nama produk wajib diisi!</span>
        </div>

        <div class="form-group">
            <label for="harga">Harga Produk (Rp):</label>
            <input type="number" id="harga" name="harga">
            <span id="errHarga" class="error-message">Harga produk wajib diisi dan bernilai positif!</span>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Produk:</label>
            <textarea id="deskripsi" name="deskripsi"></textarea>
            <span id="errDeskripsi" class="error-message">Deskripsi wajib diisi!</span>
        </div>

        <button type="submit">Simpan Produk</button>
    </form>
</div>

<!-- Tugas Validasi (JavaScript - Client Side) -->
<script>
function validateForm() {
    let isValid = true;

    // Ambil elemen input
    const nama = document.getElementById('nama').value.trim();
    const harga = document.getElementById('harga').value.trim();
    const deskripsi = document.getElementById('deskripsi').value.trim();

    // Reset pesan error
    document.getElementById('errNama').style.display = 'none';
    document.getElementById('errHarga').style.display = 'none';
    document.getElementById('errDeskripsi').style.display = 'none';

    // Validasi Nama
    if (nama === "") {
        document.getElementById('errNama').style.display = 'block';
        isValid = false;
    }

    // Validasi Harga (menggunakan operator pembanding)
    if (harga === "" || Number(harga) <= 0) {
        document.getElementById('errHarga').style.display = 'block';
        isValid = false;
    }

    // Validasi Deskripsi
    if (deskripsi === "") {
        document.getElementById('errDeskripsi').style.display = 'block';
        isValid = false;
    }

    return isValid; // Jika false, form tidak akan terkirim ke server
}
</script>

</body>
</html>