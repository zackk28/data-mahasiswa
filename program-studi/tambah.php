<?php
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="bg-primary text-white p-4 rounded-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold"><i class="fas fa-file-alt me-2"></i>Tambah Data Program Studi</h1>
                    <p class="lead mb-0">Tambah data program studi baru</p>
                </div>
                <a href="tampil.php" class="btn btn-light">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-4">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Nama Program Studi <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_prodi" required
                                placeholder="Contoh: Teknik Informatika">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenjang <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenjang" required>
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S2">S2</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Akreditasi <span class="text-danger">*</span></label>
                            <select class="form-select" name="akreditasi" required>
                                <option value="">-- Pilih Akreditasi --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3"
                                placeholder="Masukkan keterangan tambahan"></textarea>
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
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $akreditasi = $_POST['akreditasi'];
    $keterangan = $_POST['keterangan'];

    $cek = mysqli_query($koneksi, "SELECT nama_prodi FROM program_studi WHERE nama_prodi='$nama_prodi'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('NIM $nim sudah terdaftar!');
                window.location.href = 'tambah.php';
              </script>";
        exit;
    }

    $insert = mysqli_query($koneksi, "INSERT INTO program_studi (nama_prodi, jenjang, akreditasi, keterangan) 
                                     VALUES ('$nama_prodi', '$jenjang' , '$akreditasi', '$keterangan')");

    if ($insert) {
        echo "<script>
                alert('Data mahasiswa berhasil ditambahkan!');
                window.location.href = 'tampil.php';
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