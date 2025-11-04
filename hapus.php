<?php
include 'includes/koneksi.php';

if (isset($_GET['id'])) {
  $id = (int)$_GET['id']; // Sanitasi ID

  // UK 5: SQL Dasar (DELETE)
  $query = "DELETE FROM barang WHERE id = $id";

  if ($koneksi->query($query) === TRUE) {
    // Redirect kembali ke index.php
    header("Location: index.php");
    exit;
  } else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
  }
} else {
  // Jika tidak ada ID, kembali ke index
  header("Location: index.php");
  exit;
}
?>