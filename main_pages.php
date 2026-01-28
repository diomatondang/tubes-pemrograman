<?php 
include 'koneksi.php'; 

// 1. Ambil Data Statistik dari Database
$query_total = mysqli_query($koneksi, "SELECT * FROM transaksi");
$total_pesanan = ($query_total) ? mysqli_num_rows($query_total) : 0;

$query_proses = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status='diproses'");
$total_proses  = ($query_proses) ? mysqli_num_rows($query_proses) : 0;

$query_siap = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status='siap ambil'");
$total_siap    = ($query_siap) ? mysqli_num_rows($query_siap) : 0;

// Pendapatan diambil dari tabel pembayaran (uang masuk asli)
$query_duit = mysqli_query($koneksi, "SELECT SUM(jumlah_terima) as total_duit FROM pembayaran");
$data_duit     = mysqli_fetch_assoc($query_duit);
$pendapatan    = $data_duit['total_duit'] ?? 0;

// 2. Logika Grafik Pendapatan 7 Hari Terakhir
$grafik_label = [];
$grafik_data = [];
for ($i = 6; $i >= 0; $i--) {
    $tgl = date('Y-m-d', strtotime("-$i day"));
    $label = date('D', strtotime($tgl)); // Nama hari (Mon, Tue, etc)
    
    $q_g = mysqli_query($koneksi, "SELECT SUM(jumlah_terima) as total FROM pembayaran WHERE DATE(tgl_bayar) = '$tgl'");
    $d_g = mysqli_fetch_assoc($q_g);
    
    $grafik_label[] = $label;
    $grafik_data[] = $d_g['total'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Laundry Ibu | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background: #34495e; color: white; }
        .sidebar .nav-link { color: #bdc3c7; padding: 12px 20px; margin: 4px 10px; border-radius: 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #2c3e50; color: white; }
        .main-content { margin-left: 250px; padding: 30px; }
        .card-stat { border: none; border-radius: 12px; color: white; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .icon-stat { font-size: 3rem; opacity: 0.3; }
    </style>
</head>
<body>

<div class="sidebar d-flex flex-column">
    <div class="p-4 text-center">
        <h4 class="fw-bold border-bottom pb-3">LAUNDRY IBU</h4>
    </div>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="main_pages.php" class="nav-link active"><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
        </li>
    </ul>
    <div class="p-3 border-top">
        <a href="#" class="nav-link text-danger small"><i class="bi bi-box-arrow-left me-2"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard Admin</h2>
        <button class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle me-1"></i> Transaksi Baru
        </button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card card-stat bg-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div><h2><?= $total_pesanan; ?></h2><p class="mb-0">Total Pesanan</p></div>
                    <i class="bi bi-basket icon-stat"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stat bg-warning text-dark">
                <div class="d-flex justify-content-between align-items-center">
                    <div><h2><?= $total_proses; ?></h2><p class="mb-0">Sedang Diproses</p></div>
                    <i class="bi bi-arrow-repeat icon-stat"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stat bg-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div><h2><?= $total_siap; ?></h2><p class="mb-0">Siap Diambil</p></div>
                    <i class="bi bi-check2-circle icon-stat"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stat bg-danger">
                <div class="d-flex justify-content-between align-items-center">
                    <div><h4 class="fw-bold">Rp <?= number_format($pendapatan, 0, ',', '.'); ?></h4><p class="mb-0">Pendapatan</p></div>
                    <i class="bi bi-wallet2 icon-stat"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-4 text-secondary"><i class="bi bi-graph-up-arrow me-2"></i>Tren Pendapatan 7 Hari</h5>
            <canvas id="incomeChart" height="80"></canvas>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-3">
        <h5 class="fw-bold mb-3">Daftar Transaksi</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-dark text-white text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php 
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id DESC");
                    while($d = mysqli_fetch_array($data)){
                        $status_raw = strtolower($d['status']);
                        $badge = ($status_raw == 'diproses') ? 'bg-warning text-dark' : (($status_raw == 'siap ambil') ? 'bg-info' : 'bg-success');
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="fw-bold text-start ps-4"><?= htmlspecialchars($d['nama']); ?></td>
                        <td><span class="badge <?= $badge; ?> rounded-pill px-3"><?= strtoupper($d['status']); ?></span></td>
                        <td class="fw-bold text-primary">Rp <?= number_format($d['total'], 0, ',', '.'); ?></td>
                        <td>
                            <div class="btn-group shadow-sm border">
                                <?php if($status_raw != 'selesai'): ?>
                                    <a href="pembayaran.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-light" title="Bayar"><i class="bi bi-cash-stack text-success"></i></a>
                                    <a href="update_status.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-light" title="Update"><i class="bi bi-arrow-repeat text-warning"></i></a>
                                <?php else: ?>
                                    <a href="cetak_nota.php?id=<?= $d['id']; ?>" target="_blank" class="btn btn-sm btn-light" title="Cetak"><i class="bi bi-printer text-primary"></i></a>
                                <?php endif; ?>
                                <a href="hapus_transaksi.php?id=<?= $d['id']; ?>" class="btn btn-sm btn-light" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash text-danger"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="tambah_transaksi.php" method="POST" class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Transaksi Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nama Pelanggan</label><input type="text" name="nama" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Jenis Cuci</label><input type="text" name="jenis" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Total (Rp)</label><input type="number" name="total" class="form-control" required></div>
                <input type="hidden" name="status" value="diproses">
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Simpan</button></div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const ctx = document.getElementById('incomeChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($grafik_label); ?>,
            datasets: [{
                label: 'Pendapatan',
                data: <?= json_encode($grafik_data); ?>,
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
    });
</script>
</body>
</html>