<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] !== TRUE) {
    header('Location: login.php');
    exit;
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$error = '';
$success = '';

$user = null;
$q = $koneksi->query("SELECT * FROM pengguna WHERE email='" . mysqli_real_escape_string($koneksi, $email) . "' LIMIT 1");
if ($q && $q->num_rows == 1) {
    $user = $q->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (empty($nama_lengkap)) {
        $error = 'Nama tidak boleh kosong.';
    } elseif (!empty($password)) {
        if (strlen($password) < 6) {
            $error = 'Password harus minimal 6 karakter.';
        } elseif ($password !== $confirm_password) {
            $error = 'Password dan konfirmasi tidak cocok.';
        }
    }

    if (empty($error)) {
        $safe_nama = mysqli_real_escape_string($koneksi, $nama_lengkap);
        $safe_email = mysqli_real_escape_string($koneksi, $email);

        if (!empty($password)) {
            $hashed = md5($password);
            $sql = "UPDATE pengguna SET nama_lengkap='$safe_nama', password='$hashed' WHERE email='$safe_email'";
        } else {
            $sql = "UPDATE pengguna SET nama_lengkap='$safe_nama' WHERE email='$safe_email'";
        }

        if ($koneksi->query($sql)) {
            $_SESSION['nama'] = $nama_lengkap;
            $success = 'Profil berhasil diperbarui.';
            echo "<script>alert('Profil berhasil diperbarui.'); window.location.href = '../index.php';</script>";
            exit;
        } else {
            $error = 'Terjadi kesalahan saat menyimpan: ' . $koneksi->error;
        }
    }
}