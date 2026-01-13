<?php 
// 1. Hubungkan ke database
include 'koneksi.php'; 
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin Laundry | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./css/adminlte.css">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

  <nav class="app-header navbar navbar-expand bg-white shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">🧺 Laundry Ibu</a>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"><i class="bi bi-person-circle"></i> Admin</a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item text-danger" href="index.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
    <div class="sidebar-brand p-3 text-center text-white fw-bold">ADMIN LAUNDRY</div>
    <div class="sidebar-wrapper">
      <ul class="nav flex-column mt-2">
        <li class="nav-item"><a href="#" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="bi bi-people me-2"></i> Pelanggan</a></li>
      </ul>
    </div>
  </aside>

  <main class="app-main">
    <div class="app-content p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
          <h3>Dashboard</h3>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pelanggan
          </button>
      </div>

      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-primary p-3 rounded shadow-sm">
            <?php 
            // Menghitung total pelanggan di database
            $jml = mysqli_query($koneksi, "SELECT * FROM `tabel pelanggan` ");
            $total = mysqli_num_rows($jml);
            ?>
            <h3><?php echo $total; ?></h3>
            <p>Total Pelanggan</p>
          </div>
        </div>
      </div>

      <div class="card mt-4 shadow-sm">
        <div class="card-header fw-bold bg-white">Data Pelanggan Terbaru</div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              // Mengambil data asli dari database kamu
              $data = mysqli_query($koneksi, "SELECT * FROM `tabel pelanggan` ORDER BY id DESC");
              while($d = mysqli_fetch_array($data)){
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama']; ?></td>
                <td><?php echo $d['telepon']; ?></td>
                <td><?php echo $d['alamat']; ?></td>
                <td class="text-center">
                    <a href="hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Pelanggan Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="tambah.php" method="POST">
          <div class="modal-body">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Budi Santoso" required>
            </div>
            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" name="telepon" class="form-control" placeholder="0812345678" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>