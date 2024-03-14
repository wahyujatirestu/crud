<?php

include 'config.php';

if (isset($_POST['submit'])) {
    
    
    if (addData($_POST) > 0) {
        echo "<script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'list-barang.php';
            </script>";
    } else {
        echo "<script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>";
    }
    
}



?>

