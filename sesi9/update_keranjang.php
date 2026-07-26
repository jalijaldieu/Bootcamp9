<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['qty'])) {
    $id  = (int) $_POST['id'];
    $qty = (int) $_POST['qty'];

    if (isset($_SESSION['keranjang'][$id])) {
        if ($qty > 0) {
            $_SESSION['keranjang'][$id]['qty'] = $qty;
        } else {
            unset($_SESSION['keranjang'][$id]);
        }
    }
}

header("Location: keranjang.php");
exit;
