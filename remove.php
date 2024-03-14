<?php

include 'config.php';

$id = $_GET['id'];

if (removeData($id) > 0) {
    echo "<script>
            alert('Apakah anda yakin ingin menhapusnya?');
            document.location.href = 'list-barang.php';
            </script>";
}   else {
    echo "<script>
            alert('Data Gagal');
            document.location.href = 'list-barang.php';
            </script>";
}




?>