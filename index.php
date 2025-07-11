<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Soft Blue</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #e3f2fd;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
       h1 {
            color: #2a72d4;
            font-size: 2rem;
            font-weight: 700;
            text-shadow:
                1px 1px 3px rgba(0, 0, 0, 0.15),
                0 1px 1px rgba(255, 255, 255, 0.3);
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        .sb-nav-fixed .sb-topnav {
            z-index: 1030;
            position: fixed;
            top: 0;
            width: 100%;
            background-color: rgb(77, 164, 251);
        }

        .sb-nav-fixed #layoutSidenav {
            margin-top: 56px;
            display: flex;
            min-height: 100vh;
        }

        #layoutSidenav_nav {
            width: 250px;
            background-color: rgb(77, 164, 251);
            color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
            transition: margin-left 0.3s ease;
        }

        .sb-sidenav .nav-link {
            color: white;
            padding: 0.75rem 1rem;
            font-weight: 500;
            text-shadow: 0 0 2px rgba(0, 0, 0, 0.4);
        }

        .sb-sidenav .nav-link:hover,
        .sb-sidenav .nav-link.active {
            background-color: #1565c0;
            color: #ffffff;
            border-left: 4px solid white;
            font-weight: bold;
        }

        .sb-nav-link-icon {
            color: white;
            text-shadow: 0 0 2px rgba(0, 0, 0, 0.3);
        }

        .sb-sidenav .nav-link.active .sb-nav-link-icon,
        .sb-sidenav .nav-link:hover .sb-nav-link-icon {
            color: white;
        }

        #layoutSidenav_content {
            flex: 1;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .card-header {
            background: linear-gradient(90deg, #42a5f5, #90caf9);
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
            border-radius: 0.5rem 0.5rem 0 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-shadow: 1px 1px 2px #00000020;
        }

        .card-body {
            background-color: #ffffff;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        .table {
            background-color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f1f9ff;
        }

        .table-hover tbody tr:hover {
            background-color: #e0f2ff;
        }

        footer.py-4 {
            background-color: #e3f2fd;
            color: #555;
            font-weight: 500;
        }

       #sidebarToggle {
            font-size: 1.2rem;            
            margin-left: 0.5rem;          
            padding: 0.25rem 0.5rem;      
            color: white;
            background: none;
            border: none;
            outline: none;
        }

        #sidebarToggle:hover {
            color: #e0e0e0;
        }

        /* Sidebar toggle functionality */
        #layoutSidenav.layout-sidenav-toggled #layoutSidenav_nav {
            margin-left: -250px;
        }

        #layoutSidenav.layout-sidenav-toggled #layoutSidenav_content {
            margin-left: 0;
        }
    </style>
</head>
<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark">
            <a class="navbar-brand" href="index.php"><i class="fas fa-store"></i> Waroeng Fahmi</a>

            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Kumpulan tombol di kanan navbar -->
            <div class="ml-auto d-flex align-items-center">
                <!-- Tombol Hubungi Admin -->
                <button class="btn btn-info mr-2" data-toggle="modal" data-target="#modalPesanAdmin">
                    <i class="fas fa-envelope"></i> Hubungi Admin
                </button>

                <!-- Tombol Export Excel -->
                <a href="export_excel.php" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export ke Excel
                </a>
            </div>
        </nav>


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark">
                <div class="sb-sidenav-menu">
                    <div class="nav flex-column">
                        <a class="nav-link active" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
<main>
    <div class="container-fluid">
        <h1 class="mt-2 mb-4"><i class="fas fa-box"></i> Dashboard</h1>

        <?php
        $cekstock = mysqli_query($conn, "SELECT * FROM stock WHERE stock <= 5");
        $stock_tersisa = [];

        while ($row = mysqli_fetch_assoc($cekstock)) {
            $stock_tersisa[] = [
                'namabarang' => $row['namabarang'],
                'stock' => $row['stock']
            ];
        }

        if (!empty($stock_tersisa)) {
        ?>
<div class="alert shadow-sm" style="background: #fffde7; color: #795548; border-left: 5px solid #fbc02d; border-radius: 0.5rem;">
    <div class="d-flex align-items-center">
        <div style="font-size: 1.4rem; margin-right: 12px;">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div>
            <strong></i> Stock Hampir Habis!</strong>
            <ul class="mb-0 mt-2 pl-3">
                <?php foreach ($stock_tersisa as $barang): ?>
                    <li><strong><?= htmlspecialchars($barang['namabarang']) ?></strong> (Sisa: <?= $barang['stock'] ?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button type="button" class="close ml-auto text-dark" data-dismiss="alert" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>

        <?php } ?>

        <div class="card mb-4">
            <div class="card-header">
                Daftar Stock Barang
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");
                                $no = 1;
                                while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                    $namabarang = htmlspecialchars($data['namabarang']);
                                    $deskripsi = htmlspecialchars($data['deskripsi']);
                                    $stock = (int)$data['stock'];
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $namabarang; ?></td>
                                <td><?= $deskripsi; ?></td>
                                <td>
                                    <?= $stock == 0 ? '<span class="badge badge-danger">Habis</span>' : $stock; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

        <!-- Modal Kirim Pesan -->
        <div class="modal fade" id="modalPesanAdmin" tabindex="-1">
        <div class="modal-dialog">
            <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Kirim Pesan ke Admin</h5>
                <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Anda" required>
                <textarea name="pesan" class="form-control" rows="4" placeholder="Tulis pesan Anda..." required></textarea>
                </div>
                <div class="modal-footer">
                <button type="submit" name="kirim_pesan" class="btn btn-primary">Kirim</button>
                </div>
            </div>
            </form>
        </div>
        </div>


            <footer class="py-4 mt-auto">
                <div class="container-fluid d-flex justify-content-between small">
                    <div class="text-muted">&copy; Waroeng Kelontong 2025</div>
                    <div>
                        <a href="#">Privacy Policy</a> &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

            $('#sidebarToggle').on('click', function () {
                $('#layoutSidenav').toggleClass('layout-sidenav-toggled');
            });
        });
    </script>
</body>
</html>
