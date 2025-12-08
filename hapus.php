<?php
include 'koneksi.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");

    if ($hapus) {
        header("location: index.php?pesan=Data berhasil dihapus");
    } else {
        header("location: index.php?pesan=Gagal menghapus data");
    }
} else {
    header("location: index.php");
}