<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");
    $query = "INSERT INTO anggota (nama, alamat, telepon)
              VALUES ('$nama', '$alamat', '$telepon')";

    mysqli_query($koneksi, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>
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

        <h1>Tambah Anggota</h1>

        <form method="POST">

            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>Alamat</label>
            <input type="text" name="alamat" required>

            <label>Nomor Telepon</label>
            <input type="text" name="telepon" required>

            <br>

            <button type="submit" name="simpan">
                Simpan
            </button>

        </form>

    </main>

</div>

</body>
</html>