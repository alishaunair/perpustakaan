<?php

include "../koneksi.php";

$id = $_GET['id'];
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");
$query = "DELETE FROM buku WHERE id = $id";

mysqli_query($koneksi, $query);

header("Location: index.php");
exit;

?>