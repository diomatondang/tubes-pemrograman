<?php 
include 'koneksi.php';
$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id='$id'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Struk Laundry - <?= $d['nama']; ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 300px; padding: 10px; }
        .header { text-align: center; border-bottom: 1px dashed #000; padding-bottom: 10px; }
        .item { margin-top: 10px; display: flex; justify-content: space-between; }
        .footer { margin-top: 20px; text-align: center; border-top: 1px dashed #000; padding-top: 10px; font-size: 12px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2 style="margin:0">LAUNDRY IBU</h2>
        <p style="margin:0; font-size:12px">Jl. Mawar No. 123, Bandung</p>
    </div>

    <p style="font-size:14px">Nota: #<?= $d['id']; ?><br>Tgl: <?= date('d/m/Y H:i'); ?><br>Nama: <?= $d['nama']; ?></p>
    <hr>
    
    <div class="item">
        <span>Layanan:</span>
        <span><?= $d['jenis']; ?></span>
    </div>
    <div class="item" style="font-weight: bold; font-size: 18px; margin-top: 20px;">
        <span>TOTAL:</span>
        <span>Rp <?= number_format($d['total'], 0, ',', '.'); ?></span>
    </div>

    <div class="footer">
        Terima kasih sudah mencuci di sini!<br>Simpan struk ini untuk pengambilan.
    </div>
    
    <br>
    <button class="no-print" onclick="window.close()">Tutup Halaman</button>
</body>
</html>