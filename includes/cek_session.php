<?php
// Mulai session di setiap halaman
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah variabel session 'is_logged_in' ada dan bernilai true
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Jika tidak login, simpan pesan error
    $_SESSION['error_msg'] = "Anda harus login untuk mengakses halaman ini.";
    
    // Alihkan (redirect) ke halaman login
    header("Location: login.php");
    exit; // Pastikan script berhenti
}

// Jika lolos cek, variabel session bisa digunakan di halaman
$username_yang_login = $_SESSION['username'];
?>