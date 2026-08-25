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

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {

        // Hapus gambar lama
        if ($data['gambar'] != "") {

            $file_lama = "../uploads/" . $data['gambar'];

            if (file_exists($file_lama)) {
                unlink($file_lama);
            }
        }

        // Upload gambar baru
        move_uploaded_file(
            $tmp,
            "../uploads/" . $gambar
        );

        $query = "UPDATE buku SET
                    judul = '$judul',
                    penulis = '$penulis',
                    tahun = '$tahun',
                    stok = '$stok',
                    gambar = '$gambar'
                  WHERE id = $id";

    } else {

        // Tidak memilih gambar baru
        // Gambar lama tetap digunakan
        $query = "UPDATE buku SET
                    judul = '$judul',
                    penulis = '$penulis',
                    tahun = '$tahun',
                    stok = '$stok'
                  WHERE id = $id";
    }

    mysqli_query($koneksi, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
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
            <a href="../logout.php">Logout</a>
        </nav>

    </aside>

    <main class="content">

        <h1>Edit Buku</h1>

        <form method="POST" enctype="multipart/form-data">

            <label>Judul Buku</label><br>
            <input
                type="text"
                name="judul"
                value="<?= $data['judul']; ?>"
                required
            >

            <br><br>

            <label>Penulis</label><br>
            <input
                type="text"
                name="penulis"
                value="<?= $data['penulis']; ?>"
                required
            >

            <br><br>

            <label>Tahun</label><br>
            <input
                type="number"
                name="tahun"
                value="<?= $data['tahun']; ?>"
                required
            >

            <br><br>

            <label>Stok</label><br>
            <input
                type="number"
                name="stok"
                value="<?= $data['stok']; ?>"
                required
            >

            <br><br>

            <label>Gambar Saat Ini</label><br>

            <?php if ($data['gambar'] != "") { ?>

                <img
                    src="../uploads/<?= $data['gambar']; ?>"
                    width="100"
                >

            <?php } else { ?>

                Tidak ada gambar

            <?php } ?>

            <br><br>

            <label>Ganti Gambar</label><br>
            <input
                type="file"
                name="gambar"
                accept="image/*"
            >

            <br><br>

            <button type="submit" name="update">
                Update
            </button>

        </form>

    </main>

</div>

</body>
</html>