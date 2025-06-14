<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $kategori    = $_POST['kategori'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];
    $deskripsi   = $_POST['deskripsi'];

    // Validasi sederhana
    if (empty($nama_barang) || empty($stok) || empty($harga)) {
        header('Location: tambah_barang.php?status=gagal&pesan=Data nama, stok, dan harga tidak boleh kosong!');
        exit();
    }

    $sql = "INSERT INTO barang (nama_barang, kategori, stok, harga, deskripsi)
            VALUES ('$nama_barang', '$kategori', '$stok', '$harga', '$deskripsi')";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        header('Location: utama.php?status=sukses');
    } else {
        header('Location: tambah_barang.php?status=gagal&pesan=' . urlencode(mysqli_error($koneksi)));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Tambah Barang Baru</h1>
            <nav>
                <a href="utama.php">Daftar Barang</a>
                <a href="tambah_barang.php">Tambah Barang Baru</a>
            </nav>
        </header>

        <main>
            <h2>Form Tambah Barang</h2>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'gagal') {
                echo '<p class="pesan-gagal">' . htmlspecialchars($_GET['pesan']) . '</p>';
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" id="nama_barang" name="nama_barang" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <input type="text" id="kategori" name="kategori">
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" id="stok" name="stok" min="0" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp):</label>
                    <input type="number" id="harga" name="harga" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Simpan Barang</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
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