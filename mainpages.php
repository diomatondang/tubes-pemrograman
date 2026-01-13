<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Laundry</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Data Pelanggan</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Pelanggan</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // "tabel pelanggan" adalah nama tabel kamu
                        $query = mysqli_query($koneksi, "SELECT * FROM `tabel pelanggan` text");
                        while($d = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $d['nama']; ?></td>
                            <td><?= $d['telepon']; ?></td>
                            <td><?= $d['alamat']; ?></td>
                            <td>
                                <a href="hapus.php?id=<?= $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="tambah.php" method="POST" class="modal-content">
                <div class="modal-header"><h5>Tambah Pelanggan</h5></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
                    <div class="mb-3"><label>Telepon</label><input type="text" name="telepon" class="form-control" required></div>
                    <div class="mb-3"><label>Alamat</label><textarea name="alamat" class="form-control" required></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>