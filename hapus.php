<?php 
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM `tabel pelanggan` WHERE id='$id'");

header("location:main_pages.php");
?>