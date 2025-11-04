<?php
// Mulai session (diperlukan untuk menampilkan pesan error jika ada)
session_start(); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .register-card { max-width: 400px; margin: 5rem auto; }
  </style>
</head>
<body>
  <div class="card register-card shadow-sm">
    <div class="card-body p-4">
      <h3 class="card-title text-center mb-4">Buat Akun Baru</h3>
      
      <?php if(isset($_SESSION['error_msg'])): ?>
        <div class="alert alert-danger">
          <?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?>
        </div>
      <?php endif; ?>

      <form action="proses_register.php" method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
      </form>
      
      <p class="text-center mt-3 mb-0">
        Sudah punya akun? <a href="login.php">Login di sini</a>
      </p>
    </div>
  </div>
</body>
</html>