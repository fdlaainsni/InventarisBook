<?php
include 'koneksi.php';

// Cek apakah parameter ID ada di URL
if (!isset($_GET['id'])) {
    header('Location: utama.php?status=gagal&pesan=ID Barang tidak ditemukan untuk dihapus!');
    exit();
}

$id_barang = $_GET['id'];

$sql = "DELETE FROM barang WHERE id_barang = $id_barang";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    header('Location: index.php?status=sukses');
} else {
    header('Location: index.php?status=gagal&pesan=' . urlencode(mysqli_error($koneksi)));
}
?>