<?php
include '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passw = mysqli_real_escape_string($conn, $_POST['passw']);
    $passw = password_hash($passw, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, passw) VALUES ('$name', '$email','$passw')";
    if ($conn->query($query)) {
        header("Location: tabelusers.php");
        exit();
    } else {
        echo "Gagal menambahkan data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow p-4" style="max-width: 500px; margin: auto;">
            <h2 class="text-center text-primary mb-4">Tambah Pengguna</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="passw" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Simpan</button>
                <a href="tabelusers.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>