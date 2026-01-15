<?php 
include 'koneksi.php';

$nama   = $_POST['nama'];
$jenis  = $_POST['jenis'];
$status = $_POST['status'];
$total  = $_POST['total'];

// Query lengkap: kolom id diisi NULL karena AUTO_INCREMENT
$query = "INSERT INTO transaksi (id, nama, jenis, status, total) VALUES (NULL, '$nama', '$jenis', '$status', '$total')";

if (mysqli_query($koneksi, $query)) {
    header("location:main_pages.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>