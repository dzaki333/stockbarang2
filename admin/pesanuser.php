<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pesan Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Style tambahan -->
<style>
    body {
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #343a40;
    }

    .navbar {
        background: linear-gradient(to right, #343a40, #495057);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 1030;
    }

    .navbar .navbar-brand {
        font-weight: bold;
        color: #ffffff;
    }

    .sidebar {
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        width: 220px;
        background-color: #343a40;
        padding-top: 10px;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        z-index: 1020;
    }

    .sidebar .nav-link {
        color: #ced4da;
        padding: 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: #007bff;
        color: #fff;
        border-left: 4px solid #fff;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    .content {
        margin-left: 230px;
        padding: 30px;
        margin-top: 70px;
        min-height: 100vh;
        background-color: #ffffff;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.03);
        border-radius: 8px;
    }

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

    .table.table {
        background-color: #fff;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

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

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            position: relative;
            top: 0;
        }

        .content {
            margin-left: 0;
            margin-top: 120px;
        }
    }
</style>


</head>
<body>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-dark fixed-top">
    <a class="navbar-brand" href="dashboardadmin.php"><i class="fas fa-user-shield"></i> Admin Panel</a>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <a class="nav-link" href="dashboardadmin.php"><i class="fas fa-boxes"></i> Dashboard Admin</a>
    <a class="nav-link" href="pesanuser.php"><i class="fas fa-envelope"></i> Pesan Pengguna</a>
    <a class="nav-link" href="logoutadmin.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="content">
    <div class="header-title"><i class="fas fa-envelope"></i> Pesan Pengguna</div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Pesan</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $ambil = mysqli_query($conn, "SELECT * FROM pesan_user ORDER BY waktu DESC");
            while ($data = mysqli_fetch_array($ambil)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($data['namauser']); ?></td>
                    <td><?= htmlspecialchars($data['pesan']); ?></td>
                    <td><?= $data['waktu']; ?></td>
                    <td>
                        <a href="hapus.php?idpesan=<?= $data['idpesan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
