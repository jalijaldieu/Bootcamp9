<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "bootcamp9";

$koneksi = new mysqli($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>