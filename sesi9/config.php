<?php
// Konfigurasi koneksi database
// Sesuaikan jika pengaturan MySQL kamu berbeda (misalnya ada password)

$host   = "localhost";
$user   = "root";
$pass   = "";
$dbname = "bootcamp9";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
