<?php
require 'database.php';

// Ambil data produk dari database
$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2>Manajemen Produk</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Produk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td><img src="<?= $row['image']; ?>" alt="<?= $row['name']; ?>" width="100"></td>
                    <td><?= ucfirst($row['category']) ?></td>
                    <td>Rp <?= number_format($row['price'], 0, ',', '.') ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
