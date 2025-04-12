<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Foto Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 0.95rem;
            color: #6c757d;
        }
        .footer span {
            display: inline-block;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            margin-top: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Upload Foto Profil Pengguna</h2>

    <div class="card p-4 shadow-sm">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id_pengguna" class="form-label">ID Pengguna</label>
                <input type="number" name="id_pengguna" id="id_pengguna" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Pilih Foto Profil</label>
                <input type="file" name="foto" id="foto" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                <a href="dashboard.php" class="btn btn-outline-secondary">Lihat Dashboard</a>
            </div>
        </form>
    </div>

<?php
if (isset($_POST['upload'])) {
    $id_pengguna = intval($_POST['id_pengguna']);
    $file = $_FILES['foto'];
    $allowed_mimes = ['image/jpeg', 'image/png'];
    $maxSize = 1024 * 1024; // 1MB
    $upload_dir = "uploads/profile_pics/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $fileSize = $file['size'];
    $fileTmp  = $file['tmp_name'];

    // Cek ukuran
    if ($fileSize > $maxSize) {
        echo "<div class='alert alert-warning mt-3'>Ukuran maksimal 1MB.</div>";
        exit;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $fileTmp);
    finfo_close($finfo);

    if (!in_array($mime, $allowed_mimes)) {
        echo "<div class='alert alert-danger mt-3'>Tipe file tidak valid.</div>";
        exit;
    }

    // Ekstensi berdasarkan MIME
    $ext = $mime === 'image/png' ? 'png' : 'jpg';

    // Nama file unik
    $nama_file = uniqid("profil_") . '.' . $ext;
    $lokasi_file = $upload_dir . $nama_file;

    // Resize
    list($src_width, $src_height) = getimagesize($fileTmp);
    $max_width = 300;
    $new_width = $src_width > $max_width ? $max_width : $src_width;
    $new_height = floor($src_height * ($new_width / $src_width));

    $src_img = ($mime === 'image/png') ? imagecreatefrompng($fileTmp) : imagecreatefromjpeg($fileTmp);
    $resized_img = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($resized_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $src_width, $src_height);

    $save_success = ($mime === 'image/png')
        ? imagepng($resized_img, $lokasi_file)
        : imagejpeg($resized_img, $lokasi_file, 85);

    if ($save_success) {
        $sql = "INSERT INTO foto_profil (id_pengguna, nama_file, lokasi_file) 
                VALUES ('$id_pengguna', '$nama_file', '$lokasi_file')";
        if ($conn->query($sql)) {
            echo "<div class='alert alert-success mt-3'>Foto berhasil diupload dan di-resize otomatis!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal menyimpan ke database.</div>";
        }
    } else {
        echo "<div class='alert alert-danger mt-3'>Gagal menyimpan gambar.</div>";
    }

    imagedestroy($src_img);
    imagedestroy($resized_img);
}
?>

    <!-- Dibuat oleh -->
    <div class="footer">
        <span>Dibuat oleh: <strong>Rizza Husna Aufa Putra</strong> | NIM: <strong>A12.2023.07053</strong></span>
    </div>
</div>

</body>
</html>
