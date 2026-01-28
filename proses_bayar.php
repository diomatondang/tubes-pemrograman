<?php
include 'koneksi.php'; // Menggunakan variabel $koneksi sesuai main_pages.php

if (isset($_POST['proses_bayar'])) {
    // 1. Ambil data dari form pembayaran
    $id_transaksi  = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
    $total_tagihan = mysqli_real_escape_string($koneksi, $_POST['total_tagihan']);
    $jumlah_terima = mysqli_real_escape_string($koneksi, $_POST['jumlah_terima']);
    
    // Kembalian dihitung ulang di sisi server agar lebih akurat
    $kembalian     = $jumlah_terima - $total_tagihan;
    $tgl_bayar     = date('Y-m-d H:i:s');

    // 2. Validasi: Jangan sampai uangnya kurang
    if ($jumlah_terima < $total_tagihan) {
        echo "<script>alert('Gagal! Uang yang diterima kurang.'); window.history.back();</script>";
        exit;
    }

    // 3. Simpan riwayat ke tabel pembayaran
    // Pastikan nama kolom sesuai: id_transaksi, tgl_bayar, total_tagihan, jumlah_terima, kembalian
    $query_simpan = "INSERT INTO pembayaran (id_transaksi, tgl_bayar, total_tagihan, jumlah_terima, kembalian) 
                     VALUES ('$id_transaksi', '$tgl_bayar', '$total_tagihan', '$jumlah_terima', '$kembalian')";

    if (mysqli_query($koneksi, $query_simpan)) {
        
        // 4. Update status di tabel transaksi menjadi 'selesai'
        // Ini agar status di Dashboard berubah dari DIPROSES/SIAP AMBIL menjadi SELESAI
        $query_update = "UPDATE transaksi SET status = 'selesai' WHERE id = '$id_transaksi'";
        mysqli_query($koneksi, $query_update);

        // 5. Alert Berhasil dan arahkan ke Nota atau Dashboard
        echo "<script>
                alert('Pembayaran Berhasil! Kembalian: Rp " . number_format($kembalian, 0, ',', '.') . "');
                window.location='cetak_nota.php?id=$id_transaksi'; 
              </script>";
    } else {
        // Jika ada error pada SQL (Cek nama tabel/kolom jika ini muncul)
        echo "Terjadi kesalahan database: " . mysqli_error($koneksi);
    }
} else {
    // Jika mencoba akses file ini secara ilegal (tanpa klik tombol bayar)
    header("Location: main_pages.php");
}
?>