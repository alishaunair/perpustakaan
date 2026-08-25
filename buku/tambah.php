<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];
    $koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        move_uploaded_file($tmp, "../uploads/" . $gambar);
    }

    $query = "INSERT INTO buku (judul, penulis, tahun, stok, gambar)
              VALUES ('$judul', '$penulis', '$tahun', '$stok', '$gambar')";

    mysqli_query($koneksi, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <h2>Perpustakaan</h2>

        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="index.php">Buku</a>
            <a href="../anggota/index.php">Anggota</a>
            <a href="../peminjaman/index.php">Peminjaman</a>
        </nav>

    </aside>

    <main class="content">

        <h1>Tambah Buku</h1>

        <form method="POST" enctype="multipart/form-data">

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

            <label>Gambar Buku</label><br>
            <input type="file" name="gambar" accept="image/*">

            <br><br>

            <button type="submit" name="simpan">
                Simpan
            </button>

        </form>

    </main>

</div>

</body>
</html>