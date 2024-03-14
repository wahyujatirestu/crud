<?php

include 'config.php';

$penjualan = query("SELECT * FROM penjualan_barang");

if (isset($_POST["search"])) {
    $penjualan = search ($_POST['keyword']);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <br>
    <div class="container ">
        <h1 class="text-center">Harga Dan Spesisfikasi Handphone</h1>
        <br>
        <form action="" method="post">
            <div class="mb-3">
                <input name="keyword" type="text" class="form-control-sm w-40 col-sm-4" id="search" aria-describedby="emailHelp"  autofocus autocomplete placeholder="masukkan keyword pencarian...">
                <input type="submit" class="btn btn-primary" name="search" value="search">

            </div>
        </form>
        <table class="table border border-1 border-black text-center">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Aksi | Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($penjualan as $row) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><img src="img/<?= $row['gambar']; ?>" alt="" width="70"></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["deskripsi"] ?></td>
                    <td>IDR <?= number_format($row["harga"],0, ',', '.'); ?></td>
                    <td><?= date("d/m/Y | H:i:s", strtotime($row["tanggal_dibuat"])) ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-warning">Update</a>
                        <a href="remove.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapusnya?');">Hapus</a>
                    </td>
                </tr>
                    <?php endforeach ; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>
        <a href="form-daftar.php" class="btn btn-secondary mb-3">Daftar Baru</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>