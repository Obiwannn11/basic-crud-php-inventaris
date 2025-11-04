<?php
include 'includes/header.php';
include 'includes/koneksi.php';

// UK 5: Seleksi (Percabangan)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Logika untuk CREATE (INSERT)

  // UK 4: Keamanan - Sanitasi Input Sederhana
  $nama = $koneksi->real_escape_string($_POST['nama_barang']);
  $jumlah = (int)$_POST['jumlah']; // Casting ke integer
  $kategori = $koneksi->real_escape_string($_POST['kategori']);

  // UK 5: SQL Dasar (INSERT)
  $query = "INSERT INTO barang (nama_barang, jumlah, kategori) 
            VALUES ('$nama', $jumlah, '$kategori')";

  if ($koneksi->query($query) === TRUE) {
    // Redirect kembali ke index.php setelah berhasil
    header("Location: index.php");
    exit;
  } else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
  }
}

// Bagian HTML (Formulir)
?>

<h1>Tambah Barang Baru</h1>

<form action="tambah.php" method="POST">
  <div class="mb-3">
    <label for="nama_barang" class="form-label">Nama Barang</label>
    <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
  </div>
  <div class="mb-3">
    <label for="jumlah" class="form-label">Jumlah</label>
    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
  </div>
  <div class="mb-3">
    <label for="kategori" class="form-label">Kategori</label>
    <input type="text" class="form-control" id="kategori" name="kategori">
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
  <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'includes/footer.php'; ?>