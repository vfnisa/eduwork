<?php
require 'database.php'; 

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2 class="mb-4">Edit Produk</h2>

    <form action="proses_produk.php" method="POST" enctype="multipart/form-data" class="shadow p-4 bg-light rounded">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Nama Produk:</label>
            <input type="text" name="name" class="form-control" value="<?= $row['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi:</label>
            <textarea name="description" class="form-control" required><?= $row['description']; ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Stok:</label>
                <input type="number" name="stock" class="form-control" value="<?= $row['stock']; ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Harga:</label>
                <input type="number" name="price" class="form-control" value="<?= $row['price']; ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Kategori:</label>
                <select name="category" class="form-control" required>
                    <option value="elektronik" <?= ($row['category'] == 'elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                    <option value="fashion" <?= ($row['category'] == 'fashion') ? 'selected' : ''; ?>>Fashion</option>
                    <option value="makanan" <?= ($row['category'] == 'makanan') ? 'selected' : ''; ?>>Makanan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Produk:</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            
            <?php if (!empty($row['image'])): ?>
                <div class="mt-3">
                    <img id="imagePreview" src="uploads/<?= $row['image']; ?>" width="150" class="img-thumbnail">
                </div>
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            <?php else: ?>
                <div class="mt-3">
                    <img id="imagePreview" width="150" class="img-thumbnail d-none">
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.classList.remove('d-none');
        }
    </script>

</body>
</html>
