<?php
session_start(); // Wajib ada untuk mengelola session
include 'includes/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// 1. Cari user berdasarkan username
$stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// 2. Cek apakah user ada
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // 3. Verifikasi password (UK 4 Keamanan)
    if (password_verify($password, $user['password_hash'])) {
        // Password benar!
        
        // 4. Buat Session
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        // Arahkan ke halaman utama (aman)
        header("Location: index.php");
        exit;
    } else {
        // Password salah
        $_SESSION['error_msg'] = "Password yang Anda masukkan salah.";
        header("Location: login.php");
        exit;
    }
} else {
    // User tidak ditemukan
    $_SESSION['error_msg'] = "Username tidak ditemukan.";
    header("Location: login.php");
    exit;
}

$stmt->close();
$koneksi->close();
?>