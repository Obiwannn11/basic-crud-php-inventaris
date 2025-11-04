<?php
include 'includes/header.php'; // UK 3
include 'includes/koneksi.php'; // UK 5
?>

<h1 class="mb-3">Daftar Barang</h1>
<a href="tambah.php" class="btn btn-primary mb-3">Tambah Barang Baru</a>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Kategori</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // UK 5: SQL Dasar (SELECT)
    $query = "SELECT * FROM barang ORDER BY nama_barang ASC";
    $result = $koneksi->query($query);

    $no = 1;
    // UK 5: Iterasi (Perulangan)
    while ($row = $result->fetch_assoc()) {
      // fetch_assoc mengubah hasil query menjadi Array (Syarat Soal)
      echo "<tr>";
      echo "<td>" . $no++ . "</td>";
      echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>"; // UK 4: Keamanan (Cegah XSS)
      echo "<td>" . $row['jumlah'] . "</td>";
      echo "<td>" . htmlspecialchars($row['kategori']) . "</td>";
      echo "<td>
              <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
              <a href='hapus.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm link-hapus'>Hapus</a>
            </td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<?php include 'includes/footer.php'; // UK 3 ?>