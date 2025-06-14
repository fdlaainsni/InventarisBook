<?php
include 'koneksi.php'; // Panggil file koneksi database
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Buku</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Inventaris Buku</h1>
            <nav>
                <a href="utama.php">Daftar Buku</a>
                <a href="tambah_barang.php">Tambah Buku Baru</a>
            </nav>
        </header>

        <main>
            <h2>Daftar Buku Tersedia</h2>
            <?php
            // Pesan sukses jika ada
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'sukses') {
                    echo '<p class="pesan-sukses">Operasi berhasil!</p>';
                } else if ($_GET['status'] == 'gagal') {
                    echo '<p class="pesan-gagal">Operasi gagal!</p>';
                }
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM barang ORDER BY nama_barang ASC";
                    $query = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        $no = 1;
                        while ($barang = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($barang['nama_barang']) . "</td>";
                            echo "<td>" . htmlspecialchars($barang['kategori']) . "</td>";
                            echo "<td>" . htmlspecialchars($barang['stok']) . "</td>";
                            echo "<td>Rp " . number_format($barang['harga'], 2, ',', '.') . "</td>";
                            echo "<td>" . htmlspecialchars($barang['deskripsi']) . "</td>";
                            echo "<td class='aksi-buttons'>";
                            echo "<a href='edit_barang.php?id=" . $barang['id_barang'] . "' class='btn btn-edit'>Edit</a> ";
                            echo "<a href='hapus_barang.php?id=" . $barang['id_barang'] . "' class='btn btn-hapus' onclick='return confirm(\"Yakin ingin menghapus barang ini?\")'>Hapus</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Tidak ada data barang.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>

        <footer>
            <p>&copy; fadila.insani 
                <a href="https://github.com/fdlaainsni" target="_blank" class="github-link">
                    <i class="fab fa-github"></i>
                </a>
            </p>
        </footer>
    </div>
</body>
</html>