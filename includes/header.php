<?php
// File ini dipanggil SETELAH cek_session.php, 
// jadi kita bisa asumsikan session sudah dimulai.
// Tapi untuk jaga-jaga, kita cek:
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventaris Barang</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">InventarisKU</a>
    
    <div class="d-flex text-white">
      <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
        <span class="navbar-text me-3">
          Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span>
        <a href="logout.php" class="btn btn-outline-danger">Logout</a>
      <?php endif; ?>
    </div>
    </div>
</nav>

<main class="container mt-4">