<?php 
include 'koneksi.php'; 

// Mengambil ID dari URL
$id_order = $_GET['id']; 

// Menggunakan $koneksi sesuai file main_pages.php kamu
// Kolom 'id' dan 'total' disesuaikan dengan tabel transaksi kamu
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = '$id_order'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan, balikkan ke dashboard
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='main_pages.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proses Pembayaran - Laundry Ibu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .card { border-radius: 15px; border: none; }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white p-3 text-center">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-cash-stack me-2"></i>Konfirmasi Pembayaran</h5>
                </div>
                <div class="card-body p-4">
                    <form action="proses_bayar.php" method="POST">
                        <input type="hidden" name="id_transaksi" value="<?= $data['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Pelanggan</label>
                            <input type="text" class="form-control bg-light" value="<?= $data['nama']; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Total Tagihan (Rp)</label>
                            <input type="number" name="total_tagihan" id="total_tagihan" 
                                   class="form-control bg-light fw-bold text-primary" 
                                   value="<?= $data['total']; ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-success">Uang Diterima (Rp)</label>
                            <input type="number" name="jumlah_terima" id="jumlah_terima" 
                                   class="form-control form-control-lg border-success" 
                                   placeholder="Masukkan nominal..." required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kembalian (Rp)</label>
                            <input type="text" id="tampil_kembalian" class="form-control form-control-lg bg-light" value="0" readonly>
                            <input type="hidden" name="kembalian" id="kembalian_input">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="proses_bayar" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle me-1"></i> Bayar Sekarang
                            </button>
                            <a href="main_pages.php" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center text-muted mt-3 small">Laundry Ibu Management System &copy; 2026</p>
        </div>
    </div>
</div>

<script>
    const inputTerima = document.getElementById('jumlah_terima');
    const totalTagihan = document.getElementById('total_tagihan').value;
    const tampilKembalian = document.getElementById('tampil_kembalian');
    const inputKembalian = document.getElementById('kembalian_input');

    inputTerima.addEventListener('input', function() {
        let bayar = parseFloat(this.value) || 0;
        let sisa = bayar - totalTagihan;

        if (bayar === 0) {
            tampilKembalian.value = "0";
            inputKembalian.value = 0;
        } else if (sisa < 0) {
            tampilKembalian.value = "Uang Kurang";
            tampilKembalian.classList.add('text-danger');
            inputKembalian.value = 0;
        } else {
            tampilKembalian.classList.remove('text-danger');
            tampilKembalian.classList.add('text-success');
            tampilKembalian.value = new Intl.NumberFormat('id-ID').format(sisa);
            inputKembalian.value = sisa;
        }
    });
</script>
</body>
</html>