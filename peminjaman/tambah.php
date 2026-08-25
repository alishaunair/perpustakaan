<?php
include "../koneksi.php";

$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
$buku = mysqli_query($koneksi, "SELECT * FROM buku");

if (isset($_POST['simpan'])) {

    $anggota_id = $_POST['anggota_id'];
    $buku_id = $_POST['buku_id'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $tanggal_dikembalikan = $_POST['tanggal_dikembalikan'];
    $status = $_POST['status'];

    $query = "INSERT INTO peminjaman
              (anggota_id, buku_id, tanggal_pinjam, tanggal_kembali,
               tanggal_dikembalikan, status)
              VALUES
              ('$anggota_id', '$buku_id', '$tanggal_pinjam',
               '$tanggal_kembali', 
               " . ($tanggal_dikembalikan ? "'$tanggal_dikembalikan'" : "NULL") . ",
               '$status')";

    mysqli_query($koneksi, $query);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <h2>Perpustakaan</h2>

        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="../buku/index.php">Buku</a>
            <a href="../anggota/index.php">Anggota</a>
            <a href="index.php">Peminjaman</a>
        </nav>

    </aside>

    <main class="content">

        <h1>Tambah Peminjaman</h1>

        <form method="POST">

            <label>Anggota</label>

            <select name="anggota_id" required>

                <option value="">-- Pilih Anggota --</option>

                <?php while ($data = mysqli_fetch_assoc($anggota)) { ?>

                    <option value="<?= $data['id']; ?>">
                        <?= $data['nama']; ?>
                    </option>

                <?php } ?>

            </select>


            <label>Buku</label>

            <select name="buku_id" required>

                <option value="">-- Pilih Buku --</option>

                <?php while ($data = mysqli_fetch_assoc($buku)) { ?>

                    <option value="<?= $data['id']; ?>">
                        <?= $data['judul']; ?>
                    </option>

                <?php } ?>

            </select>


            <label>Tanggal Pinjam</label>

            <input
                type="date"
                name="tanggal_pinjam"
                required
            >


            <label>Batas Pengembalian</label>

            <input
                type="date"
                name="tanggal_kembali"
                required
            >


            <label>Tanggal Dikembalikan</label>

            <input
                type="date"
                name="tanggal_dikembalikan"
            >


            <label>Status</label>

            <select name="status" required>

                <option value="Dipinjam">Dipinjam</option>
                <option value="Terlambat">Terlambat</option>
                <option value="Sudah Dikembalikan">
                    Sudah Dikembalikan
                </option>

            </select>


            <br>

            <button type="submit" name="simpan">
                Simpan
            </button>

        </form>

    </main>

</div>

</body>
</html>