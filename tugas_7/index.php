<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Form Input Produk</h2>
        <form id="productForm" action="process.php" method="POST" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
                <div class="invalid-feedback">Nama produk wajib diisi.</div>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                <div class="invalid-feedback">Deskripsi produk wajib diisi.</div>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
                <div class="invalid-feedback">Harga harus berupa angka positif dan tidak boleh 0.</div>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
                <div class="invalid-feedback">Stok harus lebih dari 0.</div>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                <div class="invalid-feedback">Silakan unggah gambar produk.</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('productForm').addEventListener('submit', function(event) {
            let form = event.target;
            let harga = document.getElementById('harga');
            let stok = document.getElementById('stok');
            let valid = true;
            
            if (harga.value <= 0 || isNaN(harga.value)) {
                harga.classList.add('is-invalid');
                valid = false;
            } else {
                harga.classList.remove('is-invalid');
            }
            
            if (stok.value <= 0 || isNaN(stok.value)) {
                stok.classList.add('is-invalid');
                valid = false;
            } else {
                stok.classList.remove('is-invalid');
            }
            
            if (!form.checkValidity() || !valid) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
