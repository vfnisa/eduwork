<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Keranjang Belanja</h2>
        
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $id => $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total_price += $subtotal;
                    ?>
                        <tr>
                            <td><?= $item['name'] ?></td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td>
                                <a href="remove_from_cart.php?id=<?= $id ?>&action=decrease" class="btn btn-sm btn-warning">-</a>
                                <?= $item['quantity'] ?>
                                <a href="remove_from_cart.php?id=<?= $id ?>&action=increase" class="btn btn-sm btn-success">+</a>
                            </td>
                            <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                            <td>
                                <a href="remove_from_cart.php?id=<?= $id ?>&action=remove" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total</strong></td>
                        <td colspan="2">Rp <?= number_format($total_price, 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
            <a href="index.php" class="btn btn-secondary">Lanjut Belanja</a>
            <a href="checkout.php" class="btn btn-success">Checkout</a>
        <?php else: ?>
            <p class="text-center">Keranjang belanja kosong.</p>
            <a href="index.php" class="btn btn-primary">Lihat Produk</a>
        <?php endif; ?>
    </div>
</body>
</html>
