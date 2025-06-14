<?php
include 'koneksi.php';

// Cek apakah parameter ID ada di URL
if (!isset($_GET['id'])) {
    header('Location: utama.php?status=gagal&pesan=ID Barang tidak ditemukan!');
    exit();
}

$id_barang = $_GET['id'];

// Ambil data barang dari database
$sql = "SELECT * FROM barang WHERE id_barang = $id_barang";
$query = mysqli_query($koneksi, $sql);
$barang = mysqli_fetch_assoc($query);

// Jika barang tidak ditemukan
if (!mysqli_num_rows($query)) {
    header('Location: utama.php?status=gagal&pesan=Barang tidak ditemukan di database!');
    exit();
}

// Proses update data jika form disubmit
if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $kategori    = $_POST['kategori'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];
    $deskripsi   = $_POST['deskripsi'];

    // Validasi sederhana
    if (empty($nama_barang) || empty($stok) || empty($harga)) {
        header('Location: edit_barang.php?id=' . $id_barang . '&status=gagal&pesan=Data nama, stok, dan harga tidak boleh kosong!');
        exit();
    }

    $sql_update = "UPDATE barang SET
                    nama_barang = '$nama_barang',
                    kategori    = '$kategori',
                    stok        = '$stok',
                    harga       = '$harga',
                    deskripsi   = '$deskripsi'
                    WHERE id_barang = $id_barang";
    $query_update = mysqli_query($koneksi, $sql_update);

    if ($query_update) {
        header('Location: utama.php?status=sukses');
    } else {
        header('Location: edit_barang.php?id=' . $id_barang . '&status=gagal&pesan=' . urlencode(mysqli_error($koneksi)));
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang: <?php echo htmlspecialchars($barang['nama_barang']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Edit Barang</h1>
            <nav>
                <a href="utama.php">Daftar Barang</a>
                <a href="tambah_barang.php">Tambah Barang Baru</a>
            </nav>
        </header>

        <main>
            <h2>Form Edit Barang: <?php echo htmlspecialchars($barang['nama_barang']); ?></h2>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'gagal') {
                echo '<p class="pesan-gagal">' . htmlspecialchars($_GET['pesan']) . '</p>';
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($barang['nama_barang']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($barang['kategori']); ?>">
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" id="stok" name="stok" min="0" value="<?php echo htmlspecialchars($barang['stok']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga (Rp):</label>
                    <input type="number" id="harga" name="harga" step="0.01" min="0" value="<?php echo htmlspecialchars($barang['harga']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($barang['deskripsi']); ?></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update Barang</button>
                <a href="utama.php" class="btn btn-secondary">Batal</a>
            </form>
        </main>

        <footer>
            <p>&copy; fadila.insai 
                <a href="https://github.com/fdlaainsni" target="_blank" class="github-link">
                    <i class="fab fa-github"></i>
                </a>
            </p>
        </footer>
    </div>
</body>
</html>