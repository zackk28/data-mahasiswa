<?php
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = 'tampil.php';
          </script>";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM program_studi WHERE id='$id'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = 'tampil.php';
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
    <title>Edit Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="bg-primary text-white p-4 rounded-3 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="display-6 fw-bold"><i class="fas fa-edit me-2"></i>Edit Data Program Studi</h1>
                    <p class="lead mb-0">Perbarui informasi program studi</p>
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
                            <input type="text" class="form-control" name="nama_prodi"
                                value="<?php echo $data['nama_prodi']; ?>" required
                                placeholder="Contoh: Teknik Informatika">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jenjang <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenjang" required>
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="D2" <?php echo ($data['jenjang'] == 'D2') ? 'selected' : ''; ?>>D2
                                </option>
                                <option value="D3" <?php echo ($data['jenjang'] == 'D3') ? 'selected' : ''; ?>>D3
                                </option>
                                <option value="D4" <?php echo ($data['jenjang'] == 'D4') ? 'selected' : ''; ?>>D4
                                </option>
                                <option value="S2" <?php echo ($data['jenjang'] == 'S2') ? 'selected' : ''; ?>>S2
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Akreditasi <span class="text-danger">*</span></label>
                            <select class="form-select" name="akreditasi" required>
                                <option value="">-- Pilih Akreditasi --</option>
                                <option value="A" <?php echo ($data['akreditasi'] == 'A') ? 'selected' : ''; ?>>A
                                </option>
                                <option value="B" <?php echo ($data['akreditasi'] == 'B') ? 'selected' : ''; ?>>B
                                </option>
                                <option value="C" <?php echo ($data['akreditasi'] == 'C') ? 'selected' : ''; ?>>C
                                </option>
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="3"
                                placeholder="Masukkan keterangan tambahan"><?php echo $data['keterangan']; ?></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
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
    $id = $_POST['id'];
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $akreditasi = $_POST['akreditasi'];
    $keterangan = $_POST['keterangan'];

    $cek = mysqli_query($koneksi, "SELECT * FROM program_studi 
                                   WHERE nama_prodi='$nama_prodi' AND id != '$id'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Nama Program Studi \"$nama_prodi\" sudah terdaftar!');
                window.location.href = 'edit.php?id=$id';
              </script>";
        exit;
    }

    $update = mysqli_query($koneksi, "UPDATE program_studi SET 
                nama_prodi='$nama_prodi', 
                jenjang='$jenjang', 
                akreditasi='$akreditasi', 
                keterangan='$keterangan' 
                WHERE id='$id'");

    if ($update) {
        echo "<script>
                alert('Data program studi berhasil diubah!');
                window.location.href = 'tampil.php';
              </script>";
    } else {
        echo "<script>
                alert('Maaf, data gagal diubah. Silakan coba lagi.');
                window.location.href = 'edit.php?id=$id';
              </script>";
    }
}
mysqli_close($koneksi);
?>