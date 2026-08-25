<?php
include "../koneksi.php";

$id = $_GET['id'];

$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM anggota WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $query = "UPDATE anggota SET
              nama='$nama',
              alamat='$alamat',
              telepon='$telepon'
              WHERE id='$id'";

    mysqli_query($koneksi, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <h2>Perpustakaan</h2>

        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="../buku/index.php">Buku</a>
            <a href="index.php">Anggota</a>
            <a href="#">Peminjaman</a>
            <a href="#">Pengembalian</a>
        </nav>

    </aside>

    <main class="content">

        <h1>Edit Anggota</h1>

        <form method="POST">

            <label>Nama</label>
            <input
                type="text"
                name="nama"
                value="<?= $data['nama']; ?>"
                required
            >

            <label>Alamat</label>
            <input
                type="text"
                name="alamat"
                value="<?= $data['alamat']; ?>"
                required
            >

            <label>Nomor Telepon</label>
            <input
                type="text"
                name="telepon"
                value="<?= $data['telepon']; ?>"
                required
            >

            <br>

            <button type="submit" name="update">
                Update
            </button>

        </form>

    </main>

</div>

</body>
</html>