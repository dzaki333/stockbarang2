<?php
ob_clean(); // Bersihkan semua buffer
require 'function.php';
require_once '../library/tcpdf/tcpdf.php';

// Buat instance PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Stok Barang Admin');
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Laporan Stok Barang');
$pdf->setPrintHeader(false); // Nonaktifkan header bawaan TCPDF
$pdf->setPrintFooter(false);

// ------------------- Halaman 1: Ringkasan -------------------
$pdf->AddPage();
$pdf->SetFont('dejavusans', 'B', 14);
$pdf->Cell(0, 10, 'Ringkasan Stok Barang', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('dejavusans', '', 10);

$html = '<table border="1" cellpadding="4">
<tr><th>No</th><th>Nama Barang</th><th>Deskripsi</th><th>Jumlah Masuk</th><th>Jumlah Keluar</th></tr>';

$no = 1;
$ambil = mysqli_query($conn, "
    SELECT s.*, 
        (SELECT SUM(jumlah) FROM masuk WHERE idbarang=s.idbarang) AS jumlahmasuk,
        (SELECT SUM(jumlah) FROM keluar WHERE idbarang=s.idbarang) AS jumlahkeluar
    FROM stock s
");

while ($data = mysqli_fetch_array($ambil)) {
    $html .= '<tr>
        <td>' . $no++ . '</td>
        <td>' . htmlspecialchars($data['namabarang']) . '</td>
        <td>' . htmlspecialchars($data['deskripsi']) . '</td>
        <td>' . (int)$data['jumlahmasuk'] . '</td>
        <td>' . (int)$data['jumlahkeluar'] . '</td>
    </tr>';
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');

// ------------------- Halaman 2: Riwayat Masuk -------------------
$pdf->AddPage();
$pdf->SetFont('dejavusans', 'B', 14);
$pdf->Cell(0, 10, 'Riwayat Barang Masuk', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('dejavusans', '', 10);

$html = '<table border="1" cellpadding="4">
<tr><th>No</th><th>Tanggal</th><th>Nama Barang</th><th>Jumlah</th><th>Stock</th></tr>';

$no = 1;
$masuk = mysqli_query($conn, "
    SELECT m.tanggal, s.namabarang, m.jumlah, s.stock 
    FROM masuk m 
    JOIN stock s ON m.idbarang = s.idbarang 
    ORDER BY m.tanggal DESC
");

while ($data = mysqli_fetch_array($masuk)) {
    $html .= '<tr>
        <td>' . $no++ . '</td>
        <td>' . $data['tanggal'] . '</td>
        <td>' . htmlspecialchars($data['namabarang']) . '</td>
        <td>' . (int)$data['jumlah'] . '</td>
        <td>' . (int)$data['stock'] . '</td>
    </tr>';
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');

// ------------------- Halaman 3: Riwayat Keluar -------------------
$pdf->AddPage();
$pdf->SetFont('dejavusans', 'B', 14);
$pdf->Cell(0, 10, 'Riwayat Barang Keluar', 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('dejavusans', '', 10);

$html = '<table border="1" cellpadding="4">
<tr><th>No</th><th>Tanggal</th><th>Nama Barang</th><th>Jumlah</th><th>Stock</th></tr>';

$no = 1;
$keluar = mysqli_query($conn, "
    SELECT k.tanggal, s.namabarang, k.jumlah, s.stock 
    FROM keluar k 
    JOIN stock s ON k.idbarang = s.idbarang 
    ORDER BY k.tanggal DESC
");

while ($data = mysqli_fetch_array($keluar)) {
    $html .= '<tr>
        <td>' . $no++ . '</td>
        <td>' . $data['tanggal'] . '</td>
        <td>' . htmlspecialchars($data['namabarang']) . '</td>
        <td>' . (int)$data['jumlah'] . '</td>
        <td>' . (int)$data['stock'] . '</td>
    </tr>';
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');

// ------------------- Output PDF -------------------
$pdf->Output('laporan_stok_barang.pdf', 'I'); // I = inline (langsung tampil di tab)
exit;
