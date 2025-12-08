<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="bg-primary text-white p-4 rounded-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold"><i class="fas fa-user-plus me-2"></i>Tambah Data Mahasiswa</h1>
                    <p class="lead mb-0">Tambah data mahasiswa baru</p>
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
                            <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nim" required placeholder="Contoh: 2411082023"
                                maxlength="15">
                            <div class="form-text">Masukkan Nomor Induk Mahasiswa (unik)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tgl_lahir" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Nama Mahasiswa <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_mhs" required
                                placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3"
                                placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="reset" value="reset" name="reset" class="btn btn-danger">
                            <i class="fas fa-times-circle me-1"></i>Reset
                        </button>
                        <button type="submit" value="submit" name="submit" class="btn btn-success">
                            <i class="fas fa-check-circle me-1"></i>Simpan Data
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

    $cek = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE nim='$nim'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('NIM $nim sudah terdaftar!');
                window.location.href = 'tambah.php';
              </script>";
        exit;
    }

    $insert = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat) 
                                     VALUES ('$nim', '$nama', '$tgl_lahir', '$alamat')");

    if ($insert) {
        echo "<script>
                alert('Data mahasiswa berhasil ditambahkan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Maaf, data gagal ditambahkan. Silakan coba lagi.');
                window.location.href = 'tambah.php';
              </script>";
    }
}
mysqli_close($koneksi);
?>