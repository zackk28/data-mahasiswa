<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'data_mahasiswa') {
                echo "List Data Mahasiswa";
            } elseif ($page == 'create_mahasiswa') {
                echo "Create Data Mahasiswa";
            } elseif ($page == 'edit_mahasiswa') {
                echo "Edit Data Mahasiswa";
            } elseif ($page == 'data_prodi') {
                echo "List Data Prodi";
            } elseif ($page == 'create_prodi') {
                echo "Create Data Prodi";
            } elseif ($page == 'edit_prodi') {
                echo "Edit Data Prodi";
            } else {
                echo "Home";
            }
        } else {
            echo "Home";
        }
        ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-university me-2"></i>Data Mahasiswa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'active' : '' ?>"
                            href="index.php">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($_GET['page']) && ($_GET['page'] == 'data_mahasiswa' || $_GET['page'] == 'create_mahasiswa' || $_GET['page'] == 'edit_mahasiswa')) ? 'active' : '' ?>"
                            href="index.php?page=data_mahasiswa">
                            <i class="fas fa-users me-1"></i>Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($_GET['page']) && ($_GET['page'] == 'data_prodi' || $_GET['page'] == 'create_prodi' || $_GET['page'] == 'edit_prodi')) ? 'active' : '' ?>"
                            href="index.php?page=data_prodi">
                            <i class="fas fa-graduation-cap me-1"></i>Program Studi
                        </a>
                    </li>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === TRUE): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i
                                class="fas fa-user me-1"></i><?= isset($_SESSION['nama']) ? ' ' . htmlspecialchars($_SESSION['nama']) : ' User' ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">
                                    <i class="fas fa-user-cog me-2"></i>Edit Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="auth/logout.php">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/login.php">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/register.php">
                            <i class="fas fa-user-plus me-1"></i>Register
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        if ($page == 'home' && file_exists("home.php")) include("home.php");
        if ($page == 'data_mahasiswa' && file_exists("mahasiswa/tampil.php")) include("mahasiswa/tampil.php");
        if ($page == 'create_mahasiswa' && file_exists("mahasiswa/create.php")) include("mahasiswa/create.php");
        if ($page == 'edit_mahasiswa' && file_exists("mahasiswa/edit.php")) include("mahasiswa/edit.php");
        if ($page == 'data_prodi' && file_exists("program-studi/tampil.php")) include("program-studi/tampil.php");
        if ($page == 'create_prodi' && file_exists("program-studi/create.php")) include("program-studi/create.php");
        if ($page == 'edit_prodi' && file_exists("program-studi/edit.php")) include("program-studi/edit.php");
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === TRUE): ?>
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="auth/edit_profile.php" id="editProfileForm">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control"
                                value="<?= isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : '' ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email (tidak bisa diubah)</label>
                            <input type="email" class="form-control"
                                value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru (kosongkan bila tidak ingin mengganti)</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Minimal 6 karakter">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Ulangi password baru">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="editProfileForm" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</body>

</html>