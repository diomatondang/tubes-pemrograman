<?php
include 'koneksi.php';

// Ambil ID transaksi dari URL
$id = $_GET['id'];

// Query untuk menggabungkan data transaksi dan pembayaran
$query = mysqli_query($koneksi, "SELECT transaksi.*, pembayaran.tgl_bayar, pembayaran.jumlah_terima, pembayaran.kembalian 
                                 FROM transaksi 
                                 INNER JOIN pembayaran ON transaksi.id = pembayaran.id_transaksi 
                                 WHERE transaksi.id = '$id'");
$d = mysqli_fetch_array($query);

if (!$d) {
    echo "Data nota tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembayaran - <?= $d['nama']; ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 300px; margin: auto; padding: 20px; border: 1px solid #eee; }
        .header { text-align: center; border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; }
        .info { font-size: 12px; margin-bottom: 10px; }
        .table { width: 100%; font-size: 12px; border-collapse: collapse; }
        .table td { padding: 5px 0; }
        .total-section { border-top: 1px dashed #000; margin-top: 10px; padding-top: 10px; font-size: 12px; }
        .footer { text-align: center; margin-top: 20px; font-size: 10px; }
        @media print { .btn-print { display: none; } }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAUNDRY IBU</h2>
        <p style="font-size: 10px; margin: 5px 0;">Jl. Raya Laundry No. 123<br>Telp: 0812-XXXX-XXXX</p>
    </div>

    <div class="info">
        No. Nota: #<?= $d['id']; ?><br>
        Tanggal : <?= date('d/m/Y H:i', strtotime($d['tgl_bayar'])); ?><br>
        Nama    : <?= $d['nama']; ?>
    </div>

    <table class="table">
        <tr>
            <td>Jenis Cuci</td>
            <td style="text-align: right;"><?= $d['jenis']; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right; font-weight: bold; padding-top: 10px;">
                TOTAL: Rp <?= number_format($d['total'], 0, ',', '.'); ?>
            </td>
        </tr>
    </table>

    <div class="total-section">
        <table class="table">
            <tr>
                <td>Bayar (Tunai)</td>
                <td style="text-align: right;">Rp <?= number_format($d['jumlah_terima'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Kembalian</td>
                <td style="text-align: right;">Rp <?= number_format($d['kembalian'], 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Terima Kasih Telah Mempercayai Kami!<br>Pakaian Bersih, Hati Senang.</p>
        <button class="btn-print" onclick="window.print()" style="margin-top: 10px; cursor: pointer;">Cetak Sekarang</button>
    </div>

    <script>
        // Otomatis membuka jendela print saat halaman dimuat
        window.onload = function() { window.print(); }
    </script>
</body>
</html>