<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tabel pelanggan"; // Pastikan nama databasenya benar

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>