<?php 
// Menghubungkan ke database
include 'koneksi.php';

// Menangkap id yang dikirim melalui URL
$id = $_GET['id'];

// Menghapus data dari tabel 'tabel pelanggan'
$query = "DELETE FROM `tabel pelanggan` WHERE id='$id'";

if(mysqli_query($koneksi, $query)){
    // Jika berhasil, kembali ke halaman utama
    header("location:main_pages.php");
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
?>