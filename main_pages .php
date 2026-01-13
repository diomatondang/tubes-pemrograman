<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin Laundry | Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./css/adminlte.css">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

  <!-- ================= HEADER ================= -->
  <nav class="app-header navbar navbar-expand bg-white shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">🧺 Laundry Ibu</a>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-person-circle"></i> Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <!-- ================= SIDEBAR ================= -->
  <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
    <div class="sidebar-brand p-3 text-center text-white fw-bold">
      ADMIN LAUNDRY
    </div>

    <div class="sidebar-wrapper">
      <ul class="nav flex-column mt-2">

        <li class="nav-item">
          <a href="dashboard.html" class="nav-link active">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a href="pelanggan.html" class="nav-link">
            <i class="bi bi-people me-2"></i> Pelanggan
          </a>
        </li>

        <li class="nav-item">
          <a href="transaksi.html" class="nav-link">
            <i class="bi bi-basket me-2"></i> Transaksi
          </a>
        </li>

        <li class="nav-item">
          <a href="laporan.html" class="nav-link">
            <i class="bi bi-bar-chart me-2"></i> Laporan
          </a>
        </li>

        <li class="nav-item">
          <a href="users.html" class="nav-link">
            <i class="bi bi-person-gear me-2"></i> Pengguna
          </a>
        </li>

        <li class="nav-item mt-3">
          <a href="logout.php" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
          </a>
        </li>

      </ul>
    </div>
  </aside>

  <!-- ================= MAIN ================= -->
  <main class="app-main">
    <div class="app-content p-4">

      <h3 class="mb-4">Dashboard</h3>

      <!-- INFO BOX -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-primary">
            <div class="inner">
              <h3>120</h3>
              <p>Total Pesanan</p>
            </div>
            <i class="bi bi-basket small-box-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3>18</h3>
              <p>Diproses</p>
            </div>
            <i class="bi bi-arrow-repeat small-box-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-success">
            <div class="inner">
              <h3>25</h3>
              <p>Siap Diambil</p>
            </div>
            <i class="bi bi-check-circle small-box-icon"></i>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-danger">
            <div class="inner">
              <h3>Rp 2.500.000</h3>
              <p>Pendapatan</p>
            </div>
            <i class="bi bi-cash-stack small-box-icon"></i>
          </div>
        </div>
      </div>

      <!-- TABEL TRANSAKSI -->
      <div class="card mt-4">
        <div class="card-header fw-bold">
          Transaksi Terbaru
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Budi</td>
                <td>Cuci Kering</td>
                <td><span class="badge bg-warning">Diproses</span></td>
                <td>Rp 25.000</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Siti</td>
                <td>Cuci Setrika</td>
                <td><span class="badge bg-success">Selesai</span></td>
                <td>Rp 40.000</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>

  <!-- ================= FOOTER ================= -->
  <footer class="app-footer text-center p-3">
    <strong>© 2025 Laundry Ibu</strong>
  </footer>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="./js/adminlte.js"></script>
</body>
</html>
