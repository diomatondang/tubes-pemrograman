<?php 
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan backtick (`) karena nama database kamu pakai spasi
// Tabel 'users' harus sudah kamu buat di phpMyAdmin
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:main_pages.php"); 
} else {
    header("location:index.php?pesan=gagal");
}
?>