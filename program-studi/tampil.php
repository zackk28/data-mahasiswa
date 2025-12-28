<?php
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="bg-primary text-white p-4 rounded-3 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-6 fw-bold"><i class="fas fa-file me-2"></i>Data Program Studi</h1>
                    <p class="lead mb-0">Sistem Manajemen Data Akademik</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="../index.php" class="btn btn-success">
                    <i class="fas fa-home me-1"></i>Halaman Utama
                </a>
            </div>
            <div>
                <a href="tambah.php" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i>Tambah Program Studi
                </a>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-center" width="50">No</th>
                                <th>Nama Prodi</th>
                                <th>Jenjang</th>
                                <th>Akreditasi</th>
                                <th>Keterangan</th>
                                <th class="text-center" width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM program_studi ORDER BY id";
                            $result = mysqli_query($koneksi, $query);
                            $no = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><strong><?= $row['nama_prodi'] ?></strong></td>
                                    <td><?= $row['jenjang'] ?></td>
                                    <td><?= $row['akreditasi'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"
                                            title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus data <?= $row['nama_prodi'] ?>?')"
                                            title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4 pt-3 border-top text-center text-muted">
            <small>
                <i class="fas fa-code me-1"></i>
                Zackri Kurnia Amri &copy; <?= date('Y') ?> - Teknologi Rekayasa Perangkat Lunak
                <br>
                Teknologi Informasi - Politeknik Negeri Padang
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php mysqli_close($koneksi); ?>