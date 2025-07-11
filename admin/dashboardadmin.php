<?php
require 'function.php';
require 'cek.php';


$where = ""; // Inisialisasi awal untuk mencegah undefined variable
$filterAktif = false;

if (isset($_POST['filter'])) {
    $tanggal_awal = DateTime::createFromFormat('d/m/Y', $_POST['tanggal_awal'])->format('Y-m-d');
    $tanggal_akhir = DateTime::createFromFormat('d/m/Y', $_POST['tanggal_akhir'])->format('Y-m-d');

    $where = "WHERE DATE(tanggal) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    $filterAktif = true;
}


if (isset($_POST['resetdata'])) {
    mysqli_query($conn, "DELETE FROM masuk");
    mysqli_query($conn, "DELETE FROM keluar");
    mysqli_query($conn, "DELETE FROM stock");
    header("Location: dashboardadmin.php");
}

if (isset($_POST['addkategori'])) {
    $namabarang = htmlspecialchars($_POST['namabarang']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock) VALUES ('$namabarang', '$deskripsi', 0)");
    header("Location: dashboardadmin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

<!-- Font Awesome (ikon) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<!-- jQuery UI (untuk datepicker) -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!-- Optional: Custom CSS -->
<style>
    /* General body */
    body {
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #343a40;
    }

    /* Navbar */
    .navbar {
        background: linear-gradient(to right, #343a40, #495057);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar .navbar-brand {
        font-weight: bold;
        color: #ffffff;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        width: 220px;
        background-color: #343a40;
        padding-top: 10px;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .sidebar .nav-link {
        color: #ced4da;
        padding: 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .sidebar .nav-link:hover {
        background-color: #007bff;
        color: #fff;
        border-left: 4px solid #fff;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    /* Main content */
    .content {
        margin-left: 230px;
        padding: 30px;
        margin-top: 70px;
        min-height: 100vh;
        background-color: #ffffff;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.03);
        border-radius: 8px;
    }

    /* Title heading */
    .header-title {
        color: #212529;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 1.5rem;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.08);
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 10px;
    }

    /* Table */
    table.table {
        background-color: #fff;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* Custom header colors */
.table table-bordered {
    background-color: #007bff;
    color: #fff;
}

.table-header-success {
    background-color: #28a745;
    color: #fff;
}

.table-header-danger {
    background-color: #dc3545;
    color: #fff;
}

.table-header-secondary {
    background-color: #6c757d;
    color: #fff;
}

        /* Custom header colors */
    .table-header-primary {
        background-color: #007bff;
        color: #fff;
    }

    .table-header-success {
        background-color: #28a745;
        color: #fff;
    }

    .table-header-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .table-header-secondary {
        background-color: #6c757d;
        color: #fff;
    }


    .btn {
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Responsive fix */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: relative;
        }

        .content {
            margin-left: 0;
            margin-top: 120px;
        }
    }
</style>

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-dark fixed-top">
        <a class="navbar-brand" href="dashboardadmin.php">
            <i class="fas fa-user-shield"></i> Admin Panel
        </a>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a class="nav-link" href="dashboardadmin.php">
            <i class="fas fa-boxes"></i> Dashboard Admin
        </a>
        <a class="nav-link" href="pesanuser.php">
            <i class="fas fa-envelope"></i> Pesan Pengguna
        </a>
        <a class="nav-link" href="logoutadmin.php" onclick="return confirm('Yakin ingin logout?')">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

<!-- Konten -->
<div class="content">
    <div class="header-title">
        <i class="fas fa-user-shield"></i> Dashboard Admin
    </div>

    <div class="mb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus"></i> Tambah Barang
                </button>

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalFilter">
                    <i class="fas fa-filter"></i> Filter Data
                </button>

                <button class="btn btn-danger" data-toggle="modal" data-target="#modalReset">
                    <i class="fas fa-trash"></i> Reset Semua Data
                </button>

                        <button class="btn btn-warning" data-toggle="modal" data-target="#modalExport">
            <i class="fas fa-file-export"></i> Export
        </button>
    </div>


<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-boxes"></i> Ringkasan Stok Barang
    </div>
    <div class="card-body">
        <table id="dataTable" class="table table-bordered">
            <thead class="table-header-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Masuk</th>
                    <th>Jumlah Keluar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        <tbody>
            <?php
            $no = 1;
            $ambil = mysqli_query($conn, "
                SELECT s.*, 
                    (SELECT SUM(jumlah) FROM masuk WHERE idbarang = s.idbarang " . ($where ? str_replace("WHERE", "AND", $where) : "") . ") AS jumlahmasuk,
                    (SELECT SUM(jumlah) FROM keluar WHERE idbarang = s.idbarang " . ($where ? str_replace("WHERE", "AND", $where) : "") . ") AS jumlahkeluar
                FROM stock s
            ");
            while ($data = mysqli_fetch_array($ambil)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($data['namabarang']); ?></td>
                    <td><?= htmlspecialchars($data['deskripsi']); ?></td>
                    <td><?= (int)$data['jumlahmasuk']; ?></td>
                    <td><?= (int)$data['jumlahkeluar']; ?></td>
                    <td>
                        <a href="hapus.php?id=<?= $data['idbarang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
     </table>
    </div>
</div>

    <!-- Riwayat Barang Masuk -->
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <i class="fas fa-arrow-down"></i> Riwayat Barang Masuk
        </div>
        <div class="card-body">
            <table id="masukTable" class="table table-bordered">
                <thead class="table-header-success">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Masuk</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $masuk = mysqli_query($conn, "
                        SELECT m.idmasuk, m.tanggal, s.namabarang, m.jumlah, s.stock 
                        FROM masuk m 
                        JOIN stock s ON m.idbarang = s.idbarang 
                        $where 
                        ORDER BY m.tanggal DESC
                    ");

                    while ($data = mysqli_fetch_array($masuk)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d/m/Y', strtotime($data['tanggal'])); ?></td>
                        <td><?= htmlspecialchars($data['namabarang']); ?></td>
                        <td><?= (int)$data['jumlah']; ?></td>
                        <td><?= (int)$data['stock']; ?></td>
                        <td>
                            <a href="hapus.php?hapusmasuk=<?= $data['idmasuk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data masuk ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Barang Keluar -->
    <div class="card mt-4">
        <div class="card-header bg-danger text-white">
            <i class="fas fa-arrow-up"></i> Riwayat Barang Keluar
        </div>
        <div class="card-body">
            <table id="keluarTable" class="table table-bordered">
               <thead class="table-header-danger">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Keluar</th>
                        <th>Stock</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $keluar = mysqli_query($conn, "
                        SELECT k.idkeluar, k.tanggal, s.namabarang, k.jumlah, s.stock 
                        FROM keluar k 
                        JOIN stock s ON k.idbarang = s.idbarang 
                        $where 
                        ORDER BY k.tanggal DESC
                    ");
                    while ($data = mysqli_fetch_array($keluar)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('d/m/Y', strtotime($data['tanggal'])); ?></td>
                        <td><?= htmlspecialchars($data['namabarang']); ?></td>
                        <td><?= (int)$data['jumlah']; ?></td>
                        <td><?= (int)$data['stock']; ?></td>
                        <td>
                            <a href="hapus.php?hapuskeluar=<?= $data['idkeluar']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data masuk ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" name="namabarang" class="form-control mb-2" placeholder="Nama Barang" required>
                    <select name="deskripsi" class="form-control mb-2" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Makanan Ringan">Makanan Ringan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Sembako">Sembako</option>
                        <option value="Produk Dapur">Produk Dapur</option>
                        <option value="Obat Ringan">Obat Ringan</option>
                        <option value="Gas & Air Galon">Gas & Air Galon</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="addkategori" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Filter -->
<div class="modal fade" id="modalFilter">
    <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Tanggal</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Tanggal Awal:</label>
                    <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control" autocomplete="off" required>
                    
                    <label class="mt-2">Tanggal Akhir:</label>
                    <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control" autocomplete="off" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="filter" class="btn btn-primary">Terapkan</button>
                    <a href="dashboardadmin.php" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal Reset -->
<div class="modal fade" id="modalReset">
    <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Reset Semua Data</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus semua data?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="resetdata" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Export --> 
<div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="modalExportLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExportLabel">Export Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih jenis laporan yang ingin di-export:</p>
        <ul>
          <li>Ringkasan Stok Barang</li>
          <li>Riwayat Barang Masuk</li>
          <li>Riwayat Barang Keluar</li>
        </ul>
      </div>
      <div class="modal-footer">
        <a href="exportpdf.php" class="btn btn-danger" target="_blank">
          <i class="fas fa-file-pdf"></i> PDF
        </a>
        <a href="exportexcel.php" class="btn btn-success" target="_blank">
          <i class="fas fa-file-excel"></i> Excel
        </a>
      </div>
    </div>
  </div>
</div>
<!-- JS LIBRARIES -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- SCRIPT -->
<script>
  $.noConflict();
  jQuery(document).ready(function($) {
    // Inisialisasi semua tabel
    $('#dataTable').DataTable();
    $('#masukTable').DataTable();
    $('#keluarTable').DataTable();

    // Inisialisasi datepicker
    $("#tanggal_awal, #tanggal_akhir").datepicker({
      dateFormat: "dd/mm/yy",
      changeMonth: true,
      changeYear: true
    });
  });
</script>


</body>
</html>
