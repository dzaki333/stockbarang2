<?php
require 'function.php';

// Set headers untuk Excel
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=stok_barang_" . date('Ymd') . ".xls");
?>

<table border="1" cellpadding="5">
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
        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($data['namabarang']) . "</td>";
            echo "<td>" . htmlspecialchars($data['deskripsi']) . "</td>";
            echo "<td>" . (int)$data['stock'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
