<?php

$server = 'localhost';
$user = 'root';
$password = '';
$database = 'penjualan';

$db = mysqli_connect($server, $user, $password, $database);

if (!$db) {
    die ('Gagal Terhubung Dengan Database');
}   else {
    mysqli_connect_error();
}

// function query 

function query ($sql) {
    global $db;

    $query = mysqli_query($db, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows [] = $row;
    }

    return $rows;

}


// tambah data

function addData ($data) {
    global $db;

    $gambar = upload();
    if (!$gambar) {
        return false;
    }
    $nama = htmlspecialchars($data['nama']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $harga = htmlspecialchars($data['harga']);    
    
    $sql = "INSERT INTO penjualan_barang(gambar, nama, deskripsi, harga, tanggal_dibuat)
                VALUES('$gambar', '$nama', '$deskripsi', '$harga', CURRENT_TIMESTAMP())";
    mysqli_query($db, $sql);


    return mysqli_affected_rows($db);
}

//

    function upload() {
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        if ($error === 4) {
            echo "<script>
                        alert('Pilih gambar/foto terlebih dahulu!');
                        </script>";
                
            return false;
        }

        // cek apakah yang di upload adalah gambar

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                        alert('Yang Anda upload bukanlah file gambar/foto. Silahkan pilih dokumen gambar/foto dengan benar');
                        </script>";
                
            return false;
        }

        if ($ukuranFile > 1000000) {
            echo "<script>
            alert('Ukuran file terlalu besar. Silahkan kompres file terlebih dahulu atau pilih file yang lain');
            </script>";
    
            return false;
        }

        // lolos pengecekan siap upload
        // generate nama baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        move_uploaded_file($tmpName, 'img/' . $namaFile);

        return $namaFile;

    }


//function hapus

function removeData($id) {
    global $db;

    mysqli_query($db, "DELETE FROM penjualan_barang WHERE id = $id");
    return mysqli_affected_rows($db);
}


// function update

function updateData ($data) {
    global $db;

    $id = $data['id'];
    $gambar = htmlspecialchars($data['gambar']);
    $nama = htmlspecialchars($data['nama']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $harga = htmlspecialchars($data['harga']); 
    $gambarLama = htmlspecialchars($data['gambarLama']); 
    
    // cek apakah user pilih gambar baru atau tidak

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    }   else {
        $gambar = upload();
    }
    
    

    $sql = "UPDATE penjualan_barang SET
    gambar = '$gambar',
    nama = '$nama',
    deskripsi = '$deskripsi',
    harga = '$harga'
    WHERE id = $id ;";

    mysqli_query($db, $sql);

    return mysqli_affected_rows($db);

}



// function filter

function search ($keyword) {
    $query = "SELECT * FROM penjualan_barang WHERE
                    gambar LIKE '%$keyword%' or
                    nama LIKE '%$keyword%' or
                    deskripsi LIKE '%$keyword%' or
                    harga LIKE '%$keyword%'   
                    ";
            
        return query($query);
}

?>