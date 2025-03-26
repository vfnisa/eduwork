<?php
session_start();
include 'db.php'; // Sertakan file koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Daftar Produk</h2>
        
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
        
        <!-- Filter Kategori -->
        <form method="GET" class="mb-3">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <?php
                $categoryQuery = "SELECT DISTINCT category FROM products";
                $categoryResult = $conn->query($categoryQuery);
                while ($row = $categoryResult->fetch_assoc()) {
                    $selected = (isset($_GET['category']) && $_GET['category'] == $row['category']) ? "selected" : "";
                    echo "<option value='" . $row['category'] . "' $selected>" . ucfirst($row['category']) . "</option>";
                }
                ?>
            </select>
        </form>

        <!-- Tabel Produk -->
        <div class="row">
            <?php
            $whereClause = "";
            if (isset($_GET['category']) && $_GET['category'] != "") {
                $category = $conn->real_escape_string($_GET['category']);
                $whereClause = "WHERE category='$category'";
            }

            $query = "SELECT * FROM products $whereClause";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='" . $row['image'] . "' class='card-img-top' alt='" . $row['name'] . "'>
                            <div class='card-body'>
                                <h5 class='card-title'>" . $row['name'] . "</h5>
                                <p class='card-text'>" . $row['description'] . "</p>
                                <p class='card-text'><strong>Stok:</strong> " . $row['stock'] . "</p>
                                <p class='card-text'><strong>Kategori:</strong> " . ucfirst($row['category']) . "</p>
                                <p class='card-text'><strong>Harga:</strong> Rp " . number_format($row['price'], 0, ',', '.') . "</p>
                                <form method='POST' action='add_to_cart.php'>
                                    <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                                    <button type='submit' class='btn btn-primary'>Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                echo "<p class='text-center'>Tidak ada produk.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
