<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    
    // Validasi nama produk
    if (empty($_POST['nama'])) {
        $errors[] = "Nama produk wajib diisi.";
    } else {
        $nama = htmlspecialchars($_POST['nama']);
    }
    
    // Validasi deskripsi
    if (empty($_POST['deskripsi'])) {
        $errors[] = "Deskripsi produk wajib diisi.";
    } else {
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
    }
    
    // Validasi harga
    if (empty($_POST['harga']) || !is_numeric($_POST['harga']) || $_POST['harga'] <= 0) {
        $errors[] = "Harga harus berupa angka positif dan tidak boleh 0.";
    } else {
        $harga = floatval($_POST['harga']);
    }
    
    // Validasi stok
    if (empty($_POST['stok']) || !is_numeric($_POST['stok']) || $_POST['stok'] <= 0) {
        $errors[] = "Stok harus berupa angka dan harus lebih dari 0.";
    } else {
        $stok = intval($_POST['stok']);
    }
    
    // Validasi dan upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $allowed_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['gambar']['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Format gambar tidak valid. Gunakan JPEG, PNG, atau GIF.";
        } else {
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_name = uniqid() . "_" . basename($_FILES['gambar']['name']);
            $upload_path = $upload_dir . $file_name;
            
            if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_path)) {
                $errors[] = "Gagal mengunggah gambar.";
            } else {
                $gambar = $file_name;
            }
        }
    } else {
        $errors[] = "Silakan unggah gambar produk.";
    }
    
    // Jika tidak ada error, simpan data atau tampilkan sukses
    if (empty($errors)) {
        echo "<div class='alert alert-success'>Produk berhasil ditambahkan!</div>";
        echo "<p>Nama: $nama</p>";
        echo "<p>Deskripsi: $deskripsi</p>";
        echo "<p>Harga: Rp " . number_format($harga, 2, ',', '.') . "</p>";
        echo "<p>Stok: $stok</p>";
        echo "<p><img src='$upload_path' alt='Gambar Produk' width='200'></p>";
    } else {
        echo "<div class='alert alert-danger'><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
} else {
    echo "<div class='alert alert-warning'>Akses ditolak.</div>";
}
?>
