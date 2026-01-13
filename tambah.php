<?php 
// 1. Koneksi ke database
include 'koneksi.php';

// 2. Ambil data dari form modal
$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

// 3. Masukkan ke database
// Gunakan tanda backtick (`) karena nama tabel 'tabel pelanggan' pakai spasi
$query = "INSERT INTO `tabel pelanggan` (nama, telepon, alamat) VALUES ('$nama', '$telepon', '$alamat')";

// 4. Jalankan perintah
if(mysqli_query($koneksi, $query)){
    // Berhasil: balik ke dashboard
    header("location:main_pages.php");
} else {
    // Gagal: kasih tahu errornya apa
    echo "Gagal simpan karena: " . mysqli_error($koneksi);
}
?>