<?php 
include 'koneksi.php';

$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

// Memasukkan data ke tabel 'tabel pelanggan'
$query = "INSERT INTO `tabel pelanggan` (nama, telepon, alamat) VALUES ('$nama', '$telepon', '$alamat')";
mysqli_query($koneksi, $query);

header("location:pelanggan.php");
?>