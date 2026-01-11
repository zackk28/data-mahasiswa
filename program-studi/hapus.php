<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM program_studi WHERE id = $id"
    );

    if ($hapus) {
        echo "
            <script>
                alert('Data program studi berhasil dihapus');
                window.location.href = '../index.php?page=data_prodi';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menghapus data program studi');
                window.location.href = '../index.php?page=data_prodi';
            </script>
        ";
    }
} else {
    echo "
        <script>
            alert('ID tidak ditemukan');
            window.location.href = '../index.php?page=data_prodi';
        </script>
    ";
}
