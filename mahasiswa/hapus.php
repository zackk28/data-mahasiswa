<?php
include '../config/koneksi.php';

if (isset($_GET['nim'])) {

    $nim = mysqli_real_escape_string($koneksi, $_GET['nim']);

    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM mahasiswa WHERE nim = '$nim'"
    );

    if ($hapus) {
        echo "
            <script>
                alert('Data mahasiswa berhasil dihapus');
                window.location.href = '../index.php?page=data_mahasiswa';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menghapus data mahasiswa');
                window.location.href = '../index.php?page=data_mahasiswa';
            </script>
        ";
    }
} else {
    echo "
        <script>
            alert('NIM tidak ditemukan');
            window.location.href = '../index.php?page=data_mahasiswa';
        </script>
    ";
}
