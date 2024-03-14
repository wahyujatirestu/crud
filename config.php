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

    $gambar = htmlspecialchars($data['gambar']);
    $nama = htmlspecialchars($data['nama']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $harga = htmlspecialchars($data['harga']);    
    
    $sql = "INSERT INTO penjualan_barang(gambar, nama, deskripsi, harga, tanggal_dibuat)
                VALUES('$gambar', '$nama', '$deskripsi', '$harga', CURRENT_TIMESTAMP())";
    mysqli_query($db, $sql);


    return mysqli_affected_rows($db);
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