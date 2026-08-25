<?php
include "koneksi.php";

$buku = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku");
$total_buku = mysqli_fetch_assoc($buku)['total'];

$anggota = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM anggota");
$total_anggota = mysqli_fetch_assoc($anggota)['total'];

$peminjaman = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peminjaman");
$total_peminjaman = mysqli_fetch_assoc($peminjaman)['total'];

$transaksi = mysqli_query($koneksi, "
    SELECT 
        anggota.nama,
        buku.judul,
        peminjaman.status,
        peminjaman.tanggal_pinjam
    FROM peminjaman
    JOIN anggota ON peminjaman.anggota_id = anggota.id
    JOIN buku ON peminjaman.buku_id = buku.id
    ORDER BY peminjaman.id DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Perpustakaan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="layout">

    <aside class="sidebar">

    <h2>Perpustakaan</h2>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="buku/index.php">Buku</a>
        <a href="anggota/index.php">Anggota</a>
        <a href="peminjaman/index.php">Peminjaman</a>
    </nav>

</aside>

    <main class="content">

        <h1>Dashboard</h1>

        <div class="dashboard-cards">

            <div class="card">
                <h3>Total Buku</h3>
                <p><?= $total_buku; ?></p>
            </div>

            <div class="card">
                <h3>Total Anggota</h3>
                <p><?= $total_anggota; ?></p>
            </div>

            <div class="card">
                <h3>Total Peminjaman</h3>
                <p><?= $total_peminjaman; ?></p>
            </div>

        </div>

        <br>

        <h2>Peminjaman Terbaru</h2>

        <table>

            <tr>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>

            <?php while ($data = mysqli_fetch_assoc($transaksi)) { ?>

            <tr>

                <td><?= $data['nama']; ?></td>

                <td><?= $data['judul']; ?></td>

                <td><?= $data['tanggal_pinjam']; ?></td>

                <td><?= $data['status']; ?></td>

            </tr>

            <?php } ?>

        </table>


    </main>

</div>

</body>
</html>