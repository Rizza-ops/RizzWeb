<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Menu Tambah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 320px;
        }
        .btn-custom {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2 class="mb-3">Pilihan Menu Tambah</h2>
        <a href="users/create.php" class="btn btn-custom">Tambah User</a>
        <a href="products/createproducts.php" class="btn btn-custom">Tambah Produk</a>
    </div>
</body>
</html>
