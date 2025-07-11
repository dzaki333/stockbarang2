<?php
require '../function.php';

//header untuk file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_stok_barang.xls");

// Mulai isi tabel
echo '<h3>Ringkasan Stok Barang</h3>';
echo '<table border="1" cellpadding="5">';
echo '<tr><th>No</th><th>Nama Barang</th><th>Deskripsi</th><th>Jumlah Masuk</th><th>Jumlah Keluar</th></tr>';

$no = 1;
$ambil = mysqli_query($conn, "
    SELECT s.*, 
        (SELECT SUM(jumlah) FROM masuk WHERE idbarang=s.idbarang) AS jumlahmasuk,
        (SELECT SUM(jumlah) FROM keluar WHERE idbarang=s.idbarang) AS jumlahkeluar
    FROM stock s
");
while ($data = mysqli_fetch_array($ambil)) {
    echo '<tr>
        <td>'.$no++.'</td>
        <td>'.htmlspecialchars($data['namabarang']).'</td>
        <td>'.htmlspecialchars($data['deskripsi']).'</td>
        <td>'.(int)$data['jumlahmasuk'].'</td>
        <td>'.(int)$data['jumlahkeluar'].'</td>
    </tr>';
}
echo '</table>';

echo '<br><h3>Riwayat Barang Masuk</h3>';
echo '<table border="1" cellpadding="5">';
echo '<tr><th>No</th><th>Tanggal</th><th>Nama Barang</th><th>Jumlah</th><th>Stock</th></tr>';

$no = 1;
$masuk = mysqli_query($conn, "SELECT m.tanggal, s.namabarang, m.jumlah, s.stock FROM masuk m JOIN stock s ON m.idbarang = s.idbarang ORDER BY m.tanggal DESC");
while ($data = mysqli_fetch_array($masuk)) {
    echo '<tr>
        <td>'.$no++.'</td>
        <td>'.$data['tanggal'].'</td>
        <td>'.htmlspecialchars($data['namabarang']).'</td>
        <td>'.(int)$data['jumlah'].'</td>
        <td>'.(int)$data['stock'].'</td>
    </tr>';
}
echo '</table>';

echo '<br><h3>Riwayat Barang Keluar</h3>';
echo '<table border="1" cellpadding="5">';
echo '<tr><th>No</th><th>Tanggal</th><th>Nama Barang</th><th>Jumlah</th><th>Stock</th></tr>';

$no = 1;
$keluar = mysqli_query($conn, "SELECT k.tanggal, s.namabarang, k.jumlah, s.stock FROM keluar k JOIN stock s ON k.idbarang = s.idbarang ORDER BY k.tanggal DESC");
while ($data = mysqli_fetch_array($keluar)) {
    echo '<tr>
        <td>'.$no++.'</td>
        <td>'.$data['tanggal'].'</td>
        <td>'.htmlspecialchars($data['namabarang']).'</td>
        <td>'.(int)$data['jumlah'].'</td>
        <td>'.(int)$data['stock'].'</td>
    </tr>';
}
echo '</table>';
?>
