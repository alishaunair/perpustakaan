<?php
include "../koneksi.php";

$id = $_GET['id'];
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");

mysqli_query(
    $koneksi,
    "DELETE FROM peminjaman WHERE id='$id'"
);

header("Location: index.php");
exit;
?>