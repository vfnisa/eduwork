<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) {
    if (isset($_GET['action']) && $_GET['action'] == 'increase') {
        $_SESSION['cart'][$_GET['id']]['quantity'] += 1;
    } elseif (isset($_GET['action']) && $_GET['action'] == 'decrease') {
        if ($_SESSION['cart'][$_GET['id']]['quantity'] > 1) {
            $_SESSION['cart'][$_GET['id']]['quantity'] -= 1;
        } else {
            unset($_SESSION['cart'][$_GET['id']]);
        }
    } elseif (isset($_GET['action']) && $_GET['action'] == 'remove') {
        unset($_SESSION['cart'][$_GET['id']]);
    }
    $_SESSION['success_message'] = "Keranjang berhasil diperbarui!";
}

header("Location: cart.php");
exit();
