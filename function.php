<?php
session_start();
$conn = mysqli_connect("localhost:3307", "root", "", "stockbarang");


// Tambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock) 
        VALUES ('$namabarang', '$deskripsi', '$stock')");
}


// Barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $jumlah = $_POST['jumlah'];

    // Cek stok sekarang
    $cekstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $data = mysqli_fetch_array($cekstock);

    if ($data) {
        $stocksekarang = $data['stock'];
        $newstock = $stocksekarang + $jumlah;

        // Simpan ke tabel masuk (tanpa tanggal di PHP)
        mysqli_query($conn, "INSERT INTO masuk (idbarang, jumlah, stock) VALUES ('$barangnya', '$jumlah', '$newstock')");

        // Update stok di tabel stock
        mysqli_query($conn, "UPDATE stock SET stock='$newstock' WHERE idbarang='$barangnya'");
    }

    header('location:masuk.php');
}


// Barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $jumlah = $_POST['jumlah'];

    $cekstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $data = mysqli_fetch_array($cekstock);

    if ($data) {
        $stocksekarang = $data['stock'];

        if ($stocksekarang >= $jumlah) {
            $newstock = $stocksekarang - $jumlah;

            // Masukkan data ke tabel keluar beserta stok terkini
            mysqli_query($conn, "INSERT INTO keluar (idbarang, jumlah, stock) VALUES ('$barangnya', '$jumlah', '$newstock')");

            // Update stok di tabel stock
            mysqli_query($conn, "UPDATE stock SET stock='$newstock' WHERE idbarang='$barangnya'");
        } else {
            echo "<script>alert('Stock tidak cukup!'); window.location='keluar.php';</script>";
            exit;
        }
    }

    header('location:keluar.php');
}


if (isset($_POST['kirim_pesan'])) {
    $namauser = mysqli_real_escape_string($conn, $_POST['nama']); // ambil dari input form
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);
    $waktu = date('Y-m-d H:i:s');

    $query = mysqli_query($conn, "INSERT INTO pesan_user (namauser, pesan, waktu) VALUES ('$namauser', '$pesan', '$waktu')");
    
    if ($query) {
        echo "<script>alert('Pesan berhasil dikirim!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan.'); window.location='index.php';</script>";
    }
}




?>
