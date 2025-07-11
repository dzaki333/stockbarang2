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
    <title>Barang Masuk</title>

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
        <a class="navbar-brand" href="masuk.php"><i class="fas fa-store"></i> Waroeng Fahmi</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark">
                <div class="sb-sidenav-menu">
                    <div class="nav flex-column">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link active" href="masuk.php">
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
                    <h1 class="mt-2 mb-4"><i class="fas fa-dolly"></i> Barang Masuk</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#myModal">
                                 <i class="fas fa-plus-circle"></i> Tambah Barang Masuk
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambil = mysqli_query($conn, "SELECT m.*, s.namabarang, s.stock FROM masuk m JOIN stock s ON m.idbarang = s.idbarang");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($ambil)) {
                                            $tanggal = $data['tanggal'];
                                            $namabarang = $data['namabarang'];
                                            $jumlah = $data['jumlah'];
                                            $stock = $data['stock'];
                                            ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $namabarang; ?></td>
                                                <td><?= $jumlah; ?></td>
                                                <td><?= $stock; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <footer class="py-4">
                <div class="container-fluid d-flex justify-content-between small">
                    <div class="text-muted">&copy; Waroeng Kelontong 2025</div>
                    <div>
                        <a href="#">Privacy Policy</a> &middot; <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div class="modal-header" style="background: linear-gradient(90deg, #42a5f5, #90caf9); color: white; border-top-left-radius: 12px; border-top-right-radius: 12px;">
              <h5 class="modal-title mb-0"><i class="fas fa-plus-circle"></i> Tambah Barang Masuk</h5>
            </div>

            <form method="post">
                <div class="modal-body" style="background-color: #f9fbff;">
                    <div class="form-group">
                        <label for="barangnya">Pilih Barang</label>
                        <select name="barangnya" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Barang --</option>
                            <?php
                            $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM stock");
                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                $namabarangnya = $fetcharray['namabarang'];
                                $idbarangnya = $fetcharray['idbarang'];
                                echo "<option value='$idbarangnya'>$namabarangnya</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah Masuk</label>
                        <input type="number" name="jumlah" placeholder="Masukkan jumlah barang" class="form-control" min="1" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary" name="barangmasuk"><i class="fas fa-paper-plane"></i> Simpan</button>
                    </div>
                </div>
            </form>
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
