<?php
session_start(); // Mulai session untuk menyimpan pesan error
include 'includes/koneksi.php'; // Sertakan file koneksi

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// 1. Validasi: Password harus sama
if ($password !== $konfirmasi_password) {
    $_SESSION['error_msg'] = "Password dan Konfirmasi Password tidak cocok!";
    header("Location: register.php"); // Kembalikan ke form register
    exit;
}

// 2. Validasi: Cek apakah username sudah ada
$stmt_check = $koneksi->prepare("SELECT id FROM users WHERE username = ?");
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    $_SESSION['error_msg'] = "Username sudah digunakan, silakan pilih yang lain!";
    header("Location: register.php");
    exit;
}
$stmt_check->close();

// 3. Keamanan: Hash password (Wajib UK 4)
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// 4. Simpan ke Database
// Menggunakan prepared statement untuk keamanan (mencegah SQL Injection)
$stmt_insert = $koneksi->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
$stmt_insert->bind_param("ss", $username, $password_hash);

if ($stmt_insert->execute()) {
    // Jika berhasil, arahkan ke halaman login
    header("Location: login.php");
    exit;
} else {
    // Jika gagal
    $_SESSION['error_msg'] = "Registrasi gagal, silakan coba lagi.";
    header("Location: register.php");
    exit;
}

$stmt_insert->close();
$koneksi->close();
?>