<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Ganti dengan user DB kamu
define('DB_PASS', '');     // Ganti dengan password DB kamu
define('DB_NAME', 'belajar_php_db_inventaris_2'); // Ganti dengan nama DB kamu

// Buat koneksi
$koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($koneksi->connect_error) {
  // Ini adalah contoh Penanganan Kesalahan (UK 5)
  die("Koneksi Gagal: " . $koneksi->connect_error);
}

// echo "Koneksi Berhasil!"; // Hapus atau jadikan komentar setelah tes
?>