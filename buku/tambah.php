<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $query = "INSERT INTO buku (judul, penulis, tahun, stok)
              VALUES ('$judul', '$penulis', '$tahun', '$stok')";

    mysqli_query($koneksi, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
</head>

<body>

    <h1>Tambah Buku</h1>

    <form method="POST">

        <label>Judul Buku</label><br>
        <input type="text" name="judul" required>

        <br><br>

        <label>Penulis</label><br>
        <input type="text" name="penulis" required>

        <br><br>

        <label>Tahun</label><br>
        <input type="number" name="tahun" required>

        <br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" required>

        <br><br>

        <button type="submit" name="simpan">Simpan</button>

    </form>

</body>
</html>