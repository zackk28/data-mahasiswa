<?php
include 'koneksi.php';

if (!isset($_GET['nim'])) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$nim = $_GET['nim'];
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="bg-primary text-white p-4 rounded-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold"><i class="fas fa-edit me-2"></i>Edit Data Mahasiswa</h1>
                    <p class="lead mb-0">Perbarui informasi mahasiswa</p>
                </div>
                <a href="index.php" class="btn btn-light">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-4">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIM</label>
                            <input type="text" class="form-control" name="nim" value="<?php echo $data['nim']; ?>"
                                readonly>
                            <div class="form-text">NIM tidak dapat diubah</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tgl_lahir"
                                value="<?php echo $data['tgl_lahir']; ?>" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Nama Mahasiswa <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_mhs"
                                value="<?php echo $data['nama_mhs']; ?>" required>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea class="form-control" name="alamat"
                                rows="3"><?php echo $data['alamat']; ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="reset" value="reset" name="reset" class="btn btn-danger">
                            <i class="fas fa-times-circle me-1"></i>Reset
                        </button>
                        <button type="submit" value="submit" name="submit" class="btn btn-warning">
                            <i class="fas fa-check-circle me-1"></i>Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-4 pt-3 border-top text-center text-muted">
            <small>
                <i class="fas fa-code me-1"></i>
                Zackri Kurnia Amri &copy; <?php echo date('Y'); ?> - Teknologi Rekayasa Perangkat Lunak
                <br>
                Teknologi Informasi - Politeknik Negeri Padang
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
                nama_mhs='$nama', 
                tgl_lahir='$tgl_lahir', 
                alamat='$alamat' 
                WHERE nim='$nim'");

    if ($update) {
        echo "<script>
                alert('Data mahasiswa berhasil diubah!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Maaf, data gagal diubah. Silakan coba lagi.');
                window.location.href = 'edit.php?nim=$nim';
              </script>";
    }
}
mysqli_close($koneksi);
?>