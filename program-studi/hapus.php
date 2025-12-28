<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapus = mysqli_query($koneksi, "DELETE FROM program_studi WHERE id='$id'");

    if ($hapus) {
        header("location: tampil.php?pesan=Data berhasil dihapus");
    } else {
        header("location: tampil.php?pesan=Gagal menghapus data");
    }
} else {
    header("location: tampil.php");
}
