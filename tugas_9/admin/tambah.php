

<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Upload Gambar
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $query = "INSERT INTO products (name, description, stock, image, category, price) 
              VALUES ('$name', '$description', '$stock', '$image', '$category', '$price')";
    
    if ($conn->query($query) === TRUE) {
        header("Location: manajemenproduk.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2>Tambah Produk</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>

</body>
</html>
