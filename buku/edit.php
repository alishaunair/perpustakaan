<?php
include "../koneksi.php";

$id = $_GET['id'];
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $query = "UPDATE buku SET
                judul = '$judul',
                penulis = '$penulis',
                tahun = '$tahun',
                stok = '$stok'
              WHERE id = $id";

    mysqli_query($koneksi, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
</head>

<body>

<h1>Edit Buku</h1>

<form method="POST">

    <label>Judul Buku</label><br>
    <input type="text" name="judul"
           value="<?= $data['judul']; ?>" required>

    <br><br>

    <label>Penulis</label><br>
    <input type="text" name="penulis"
           value="<?= $data['penulis']; ?>" required>

    <br><br>

    <label>Tahun</label><br>
    <input type="number" name="tahun"
           value="<?= $data['tahun']; ?>" required>

    <br><br>

    <label>Stok</label><br>
    <input type="number" name="stok"
           value="<?= $data['stok']; ?>" required>

    <br><br>

    <button type="submit" name="update">Update</button>

</form>

</body>
</html>