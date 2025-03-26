<?php
session_start();
include 'db.php'; // Sertakan file koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    
    // Ambil informasi produk dari database
    $query = "SELECT * FROM products WHERE id = '$product_id'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        // Simpan produk ke dalam session cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
        
        $_SESSION['success_message'] = "Produk berhasil ditambahkan ke keranjang!";
    }
}
header("Location: product.php");
exit();
