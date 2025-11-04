<?php
session_start(); // Ambil session yang ada

// Hapus semua variabel session
session_unset();

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login
header("Location: login.php");
exit;
?>