<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $conn->real_escape_string($_POST['nama_produk']);
    $harga = floatval($_POST['harga']);
    $stok = intval($_POST['stok']);

    $stmt = $conn->prepare("INSERT INTO products (nama_produk, harga, stok) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $nama_produk, $harga, $stok);

    if ($stmt->execute()) {
        header("Location: tabelproducts.php");
    } else {
        echo "<div class='alert alert-danger'>Gagal menambahkan produk: " . $conn->error . "</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 400px;">
        <h2 class="mb-3 text-center">Tambah Produk</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Produk:</label>
                <input type="text" name="nama_produk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga:</label>
                <input type="number" step="0.01" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok:</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
            <a href="tabelproducts.php" class="btn btn-secondary w-100 mt-2">Batal</a>
        </form>
    </div>
</body>
</html>
