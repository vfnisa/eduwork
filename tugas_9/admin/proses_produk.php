<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $uploadDir = "uploads/";
    $imageName = "";

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
            // Berhasil upload
        } else {
            die("Gagal mengunggah gambar.");
        }
    }

    if ($id) {
        // Update produk
        if (!empty($imageName)) {
            $sql = "UPDATE products SET name='$name', description='$description', stock='$stock', price='$price', category='$category', image='$imageName' WHERE id=$id";
        } else {
            $sql = "UPDATE products SET name='$name', description='$description', stock='$stock', price='$price', category='$category' WHERE id=$id";
        }
    } else {
        // Tambah produk baru
        $sql = "INSERT INTO products (name, description, stock, price, category, image) VALUES ('$name', '$description', '$stock', '$price', '$category', '$imageName')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: manajemenproduk.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
