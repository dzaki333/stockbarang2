<?php
session_start();
$conn = mysqli_connect("localhost:3307", "root", "", "stockbarang");

// Cek apakah admin sudah login (khusus halaman admin)
if (basename($_SERVER['PHP_SELF']) === 'dashboardadmin.php' || basename($_SERVER['PHP_SELF']) === 'function.php') {
    if (!isset($_SESSION['admin_id'])) {
        header('Location: loginadmin.php');
        exit;
    }
}

// Tambah nama barang dan deskripsi (khusus jika ada request POST addkategori)
if (isset($_POST['addkategori'])) {
    $namabarang = mysqli_real_escape_string($conn, $_POST['namabarang']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $idadmin = $_SESSION['admin_id'];

    $addtotable = mysqli_query($conn, "INSERT INTO stock 
        (namabarang, deskripsi, idadmin)
        VALUES ('$namabarang', '$deskripsi', '$idadmin')");

    header("Location: dashboardadmin.php?status=" . ($addtotable ? "sukses" : "gagal"));
    exit;
}