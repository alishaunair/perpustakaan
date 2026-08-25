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
    + Tambah Anggota
</a>

<button type="button" onclick="urutkanNama()" id="tombolUrut">
    Urutkan Peminjaman A-Z
</button>

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

                <td><?= $data['id']; ?></td>

                <td><?= $data['nama']; ?></td>

                <td><?= $data['judul']; ?></td>

                <td><?= $data['tanggal_pinjam']; ?></td>

                <td><?= $data['tanggal_kembali']; ?></td>

                <td><?= $data['tanggal_dikembalikan'] ?: '-'; ?></td>

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

<script>

let urutanAZ = true;

function urutkanNama() {

    const tabel = document.querySelector("table");

    const baris = Array.from(
        tabel.querySelectorAll("tr")
    ).slice(1);

    baris.sort((a, b) => {

        const namaA = a.cells[1].innerText.toLowerCase();
        const namaB = b.cells[1].innerText.toLowerCase();

        if (urutanAZ) {
            return namaA.localeCompare(namaB);
        } else {
            return namaB.localeCompare(namaA);
        }
    });

    baris.forEach(baris => tabel.appendChild(baris));

    urutanAZ = !urutanAZ;

    document.getElementById("tombolUrutkan").innerText =
        urutanAZ ? "Urutkan Peminjaman A-Z" : "Urutkan Peminjaman Z-A";
}

</script>

</body>
</html>