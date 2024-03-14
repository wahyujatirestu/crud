<?php

include 'config.php';

$id = $_GET['id'];

$update = query("SELECT * FROM penjualan_barang WHERE id =$id")[0];


if (isset($_POST['submit_update'])) {
    
    if (updateData($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = 'list-barang.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diubah');
        document.location.href = 'list-barang.php';
        </script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Daftar Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container pt-5">
        <h1>Form Update Barang</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $update['id']; ?>">
            <div class="mb-3">
                <label for="gambar" class="form-label">Foto</label>
                <input name="gambar" type="text" class="form-control" id="gambar" aria-describedby="emailHelp" required value="<?= $update['gambar']; ?>">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" required value="<?= $update['nama']; ?>">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" aria-describedby="emailHelp" required value="<?= $update['deskripsi']; ?>">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" aria-describedby="emailHelp" required value="<?= $update['harga']; ?>">
            </div>
            <input type="submit" class="btn btn-primary" name="submit_update" value="Update" onclick="return confirm('Apakah anda yakin ingin mengubah data ini?')">
        </form>
        <br>
        <a href="list-barang.php" class="btn btn-secondary mb-3">Kembali</a>
    </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>