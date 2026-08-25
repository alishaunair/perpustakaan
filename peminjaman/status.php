<?php
include "../koneksi.php";

$id = $_POST['id'];
$status = $_POST['status'];
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");

if ($status == "Sudah Dikembalikan") {

    $tanggal_dikembalikan = date("Y-m-d");

    $query = "UPDATE peminjaman 
              SET status='$status',
                  tanggal_dikembalikan='$tanggal_dikembalikan'
              WHERE id='$id'";

} else {

    $query = "UPDATE peminjaman 
              SET status='$status',
                  tanggal_dikembalikan=NULL
              WHERE id='$id'";
}

mysqli_query($koneksi, $query);

header("Location: index.php");
exit;
?>