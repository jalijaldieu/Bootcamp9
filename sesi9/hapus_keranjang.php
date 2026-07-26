<?php
session_start();

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    unset($_SESSION['keranjang'][$id]);
}

header("Location: keranjang.php");
exit;
