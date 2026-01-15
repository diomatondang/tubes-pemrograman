<?php 
include 'koneksi.php';
$id = $_GET['id'];

// Mengambil data saat ini
$data = mysqli_query($koneksi, "SELECT status FROM transaksi WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// Logika perubahan status sederhana
$status_baru = 'selesai';
if($row['status'] == 'diproses') {
    $status_baru = 'siap ambil';
} elseif($row['status'] == 'siap ambil') {
    $status_baru = 'selesai';
}

mysqli_query($koneksi, "UPDATE transaksi SET status='$status_baru' WHERE id='$id'");
header("location:main_pages.php");
?>