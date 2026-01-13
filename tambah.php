<?php 
include 'koneksi.php';

// Menangkap data dari form
$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

// Gunakan tanda backtick (`) untuk nama tabel yang ada spasi
$query = "INSERT INTO `tabel pelanggan` (nama, telepon, alamat) VALUES ('$nama', '$telepon', '$alamat')";

$simpan = mysqli_query($koneksi, $query);

if($simpan){
    // Jika berhasil, balik ke halaman utama
    header("location:main_pages.php");
} else {
    // Jika gagal, akan muncul tulisan errornya apa
    echo "<h1>Waduh, Gagal Simpan!</h1>";
    echo "Pesan Error: " . mysqli_error($koneksi);
    echo "<br><a href='main_pages.php'>Kembali</a>";
}
?>
