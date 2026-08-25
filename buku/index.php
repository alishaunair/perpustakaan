<?php
include "../koneksi.php";

$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");
$query = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
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
</nav>

</aside>


    <main class="content">

        <h1>Data Buku</h1>

        <a href="tambah.php" class="btn btn-tambah">
            + Tambah Buku
        </a>

        <br><br>

        <table>

            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php while ($data = mysqli_fetch_assoc($query)) { ?>

            <tr>

                <td><?= $data['id']; ?></td>
                <td><?= $data['judul']; ?></td>
                <td><?= $data['penulis']; ?></td>
                <td><?= $data['tahun']; ?></td>
                <td><?= $data['stok']; ?></td>

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
                        onclick="return confirm('Yakin ingin menghapus buku ini?')"
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