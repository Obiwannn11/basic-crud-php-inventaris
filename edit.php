<?php
// Selalu sertakan file header dan koneksi di awal
include 'includes/header.php';
include 'includes/koneksi.php';

// Inisialisasi variabel untuk data lama
$id = 0;
$nama_barang_lama = "";
$jumlah_lama = "";
$kategori_lama = "";

// --- LOGIKA BAGIAN 1: MEMPROSES SUBMIT (UPDATE DATA) ---
// UK 5: Percabangan - Cek apakah ini metode POST (form disubmit)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil data BARU dari form (dan ID dari hidden input)
    $id = (int)$_POST['id']; // Ambil ID untuk query WHERE
    
    // UK 4: Keamanan - Sanitasi input baru
    $nama_baru = $koneksi->real_escape_string($_POST['nama_barang']);
    $jumlah_baru = (int)$_POST['jumlah'];
    $kategori_baru = $koneksi->real_escape_string($_POST['kategori']);

    // UK 5: SQL Dasar (UPDATE)
    $query_update = "UPDATE barang SET 
                        nama_barang = '$nama_baru', 
                        jumlah = $jumlah_baru, 
                        kategori = '$kategori_baru' 
                     WHERE id = $id";

    // Eksekusi query update
    if ($koneksi->query($query_update) === TRUE) {
        // Jika berhasil, redirect kembali ke halaman utama (index.php)
        header("Location: index.php");
        exit; // Pastikan script berhenti setelah redirect
    } else {
        // UK 5: Penanganan Kesalahan
        echo "Error: Gagal mengupdate data. " . $koneksi->error;
    }
}

// --- LOGIKA BAGIAN 2: MENAMPILKAN FORM (GET DATA) ---
// Cek apakah ada parameter 'id' di URL (saat link "Edit" diklik)
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Sanitasi ID dari URL
    
    // UK 5: SQL Dasar (SELECT by ID)
    $query_select = "SELECT * FROM barang WHERE id = $id";
    $result = $koneksi->query($query_select);
    
    // Cek apakah data ditemukan
    if ($result->num_rows > 0) {
        // Ambil data lama dan masukkan ke variabel
        $data_lama = $result->fetch_assoc(); // Ini adalah Array (Syarat Soal)
        
        $nama_barang_lama = $data_lama['nama_barang'];
        $jumlah_lama = $data_lama['jumlah'];
        $kategori_lama = $data_lama['kategori'];
        
    } else {
        // Jika ID tidak ditemukan, kembalikan ke index.php
        echo "Data tidak ditemukan.";
        header("Location: index.php");
        exit;
    }
} else {
    // Jika tidak ada ID di URL, ini adalah akses yang tidak valid
    // Kembalikan ke index.php
    header("Location: index.php");
    exit;
}

// Jika script sampai di sini, artinya kita punya data untuk ditampilkan di form.
?>

<h1>Edit Barang</h1>
<p>Silakan ubah data barang di bawah ini.</p>

<form action="edit.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="mb-3">
        <label for="nama_barang" class="form-label">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" 
               value="<?php echo htmlspecialchars($nama_barang_lama); ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" 
               value="<?php echo $jumlah_lama; ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" 
               value="<?php echo htmlspecialchars($kategori_lama); ?>">
    </div>
    
    <button type="submit" class="btn btn-success">Update Data</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

<?php
// Selalu sertakan file footer di akhir
include 'includes/footer.php'; 
?>