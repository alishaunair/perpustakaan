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
        <a href="index.php">Buku</a>
        <a href="../anggota/index.php">Anggota</a>
        <a href="../peminjaman/index.php">Peminjaman</a>
        <a href="../logout.php">Logout</a>
    </nav>

</aside>

<main class="content">

    <h1>Data Buku</h1>

    <a href="tambah.php" class="btn btn-tambah">
        + Tambah Buku
    </a>

    <button type="button" onclick="urutkanBuku()" id="tombolUrut">
    Urutkan Judul A-Z
    </button>

    <br><br>

    <table id="tabelBuku">

        <thead>
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody id="dataBuku">

        <?php while ($data = mysqli_fetch_assoc($query)) { ?>

            <tr>

                <td>
                    <?= $data['id']; ?>
                </td>

                <td>
                    <?php if ($data['gambar'] != "") { ?>

                        <img
                            src="../uploads/<?= $data['gambar']; ?>"
                            width="80"
                        >

                    <?php } else { ?>

                        Tidak ada gambar

                    <?php } ?>
                </td>

                <td class="judul-buku">
                    <?= $data['judul']; ?>
                </td>

                <td>
                    <?= $data['penulis']; ?>
                </td>

                <td>
                    <?= $data['tahun']; ?>
                </td>

                <td>
                    <?= $data['stok']; ?>
                </td>

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

        </tbody>

    </table>

</main>

</div>


<script>

let urutanAZ = true;

function urutkanBuku() {

    let tbody = document.getElementById("dataBuku");

    let baris = Array.from(
        tbody.getElementsByTagName("tr")
    );

    let daftarBuku = [];

    baris.forEach(function(barisBuku) {

        let judul = barisBuku
            .getElementsByClassName("judul-buku")[0]
            .textContent
            .trim();

        daftarBuku.push({
            judul: judul,
            baris: barisBuku
        });

    });

    daftarBuku.sort(function(a, b) {

        let hasil = a.judul
            .toLowerCase()
            .localeCompare(
                b.judul.toLowerCase()
            );

        if (urutanAZ) {
            return hasil;
        } else {
            return -hasil;
        }

    });

    daftarBuku.forEach(function(buku) {

        tbody.appendChild(buku.baris);

    });

    let tombol = document.getElementById("tombolUrut");

    if (urutanAZ) {
        tombol.textContent = "Urutkan Judul Z-A";
    } else {
        tombol.textContent = "Urutkan Judul A-Z";
    }

    urutanAZ = !urutanAZ;

}

</script>

</body>
</html>