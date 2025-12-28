<?php
include '../config/koneksi.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    $hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");

    if ($hapus) {
        header("location: tampil.php?pesan=Data berhasil dihapus");
    } else {
        header("location: tampil.php?pesan=Gagal menghapus data");
    }
} else {
    header("location: tampil.php");
}
