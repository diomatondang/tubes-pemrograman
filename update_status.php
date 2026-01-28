<?php 
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

if ($id) {
    // 1. Mengambil data status saat ini
    $query = mysqli_query($koneksi, "SELECT status FROM transaksi WHERE id='$id'");
    $row = mysqli_fetch_assoc($query);

    // 2. Logika perubahan status otomatis
    $status_baru = 'selesai';
    if($row['status'] == 'diproses') {
        $status_baru = 'siap ambil';
    } elseif($row['status'] == 'siap ambil') {
        $status_baru = 'selesai';
    }

    // 3. Update ke database
    mysqli_query($koneksi, "UPDATE transaksi SET status='$status_baru' WHERE id='$id'");
}

// 4. Langsung lempar balik ke Dashboard
header("location:main_pages.php");
exit();
?>