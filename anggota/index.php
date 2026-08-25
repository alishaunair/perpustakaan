<?php
include "../koneksi.php";

$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");
$query = mysqli_query($koneksi, "SELECT * FROM anggota");

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
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
    <a href="../peminjaman/index.php">Peminjaman</a>
    <a href="../logout.php">Logout</a>
</nav>

</aside>


    <main class="content">

        <h1>Data Anggota</h1>

        <a href="tambah.php" class="btn btn-tambah">
            + Tambah Anggota
        </a>

        <br><br>

        <table>

            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>

            <?php while ($data = mysqli_fetch_assoc($query)) { ?>

            <tr>

                <td><?= $data['id']; ?></td>
                <td><?= $data['nama']; ?></td>
                <td><?= $data['alamat']; ?></td>
                <td><?= $data['telepon']; ?></td>

                <td>

                    <a
                        class="btn-edit"
                        href="edit.php?id=<?= $data['id']; ?>"
                    >
                        Edit
                    </a>

                    |

                    <a
                        class="btn-hapus"
                        href="hapus.php?id=<?= $data['id']; ?>"
                        onclick="return confirm('Yakin ingin menghapus anggota ini?')"
                    >
                        Hapus
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </main>

</div>

</body>
</html>