<?php
include "../koneksi.php";

$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");
$query = mysqli_query($koneksi, "
    SELECT 
        peminjaman.id,
        anggota.nama,
        buku.judul,
        peminjaman.tanggal_pinjam,
        peminjaman.tanggal_kembali,
        peminjaman.tanggal_dikembalikan,
        peminjaman.status
    FROM peminjaman
    JOIN anggota ON peminjaman.anggota_id = anggota.id
    JOIN buku ON peminjaman.buku_id = buku.id
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="../style.css">
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
            <a href="index.php">Peminjaman</a>
            <a href="../logout.php">Logout</a>
        </nav>

    </aside>


    <main class="content">

        <h1>Data Peminjaman</h1>

        <a href="tambah.php" class="btn btn-tambah">
            + Tambah Peminjaman
        </a>

        <br><br>


        <table>

            <tr>
                <th>ID</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tanggal Dikembalikan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>


            <?php while ($data = mysqli_fetch_assoc($query)) { ?>

            <tr>

                <td>
                    <?= $data['id']; ?>
                </td>

                <td>
                    <?= $data['nama']; ?>
                </td>

                <td>
                    <?= $data['judul']; ?>
                </td>

                <td>
                    <?= $data['tanggal_pinjam']; ?>
                </td>

                <td>
                    <?= $data['tanggal_kembali']; ?>
                </td>

                <td>
                    <?= $data['tanggal_dikembalikan'] ?: '-'; ?>
                </td>


                <!-- STATUS -->
                <td>

                    <form action="status.php" method="POST">

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $data['id']; ?>"
                        >

                        <select
                            name="status"
                            onchange="this.form.submit()"
                            class="status-select"
                        >

                            <option
                                value="Dipinjam"
                                <?= $data['status'] == 'Dipinjam' ? 'selected' : ''; ?>
                            >
                                Dipinjam
                            </option>

                            <option
                                value="Terlambat"
                                <?= $data['status'] == 'Terlambat' ? 'selected' : ''; ?>
                            >
                                Terlambat
                            </option>

                            <option
                                value="Sudah Dikembalikan"
                                <?= $data['status'] == 'Sudah Dikembalikan' ? 'selected' : ''; ?>
                            >
                                Sudah Dikembalikan
                            </option>

                        </select>

                    </form>

                </td>


                <!-- AKSI -->
                <td>

                    <a
                        class="btn-hapus"
                        href="hapus.php?id=<?= $data['id']; ?>"
                        onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
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