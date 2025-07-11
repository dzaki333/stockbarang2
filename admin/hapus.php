<?php
require 'function.php';

if (isset($_GET['id'])) {
    // Hapus dari tabel stock
    $id = $_GET['id'];
    $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang = '$id'");

    if ($hapus) {
        header("Location: dashboardadmin.php");
        exit;
    } else {
        echo "Gagal menghapus data stok!";
        exit;
    }
}

if (isset($_GET['hapusmasuk'])) {
    // Hapus dari tabel masuk
    $idmasuk = $_GET['hapusmasuk'];
    $hapusMasuk = mysqli_query($conn, "DELETE FROM masuk WHERE idmasuk='$idmasuk'");

    if ($hapusMasuk) {
        header("Location: dashboardadmin.php");
        exit;
    } else {
        echo "Gagal menghapus data masuk!";
        exit;
    }
}

if (isset($_GET['hapuskeluar'])) {
    // Hapus dari tabel keluar
    $idkeluar = $_GET['hapuskeluar'];
    $hapusKeluar = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idkeluar'");

    if ($hapusKeluar) {
        header("Location: dashboardadmin.php");
        exit;
    } else {
        echo "Gagal menghapus data keluar!";
        exit;
    }
}


if (isset($_GET['idpesan'])) {
    $id = (int)$_GET['idpesan'];
    mysqli_query($conn, "DELETE FROM pesan_user WHERE idpesan = $id");
    header('Location: dashboardadmin.php'); // atau sesuaikan dengan halaman kamu
    exit;
}

// Jika tidak ada parameter yang dikirim
echo "Permintaan tidak valid.";
?>