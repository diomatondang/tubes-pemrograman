<?php
// Pengaturan Database
$host = "localhost";
$user = "root";      // Default XAMPP
$pass = "";          // Default XAMPP (kosong)
$db   = "transaksi"; // Nama database yang ada di phpMyAdmin Anda

// Membuat Koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek Koneksi
if (!$koneksi) {
    // Jika gagal, akan muncul pesan error seperti pada gambar Anda
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>