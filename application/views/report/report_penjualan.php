<?php
include 'report_header.php';
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 5, 'LAPORAN PENJUALAN', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 11);

$pdf->Cell(0, 7, 'Periode :' . $awal . ' s/d ' . $akhir, 0, 1, 'C');
$sql = "SELECT b.id_jual, b.invoice, d.nama_lengkap, c.nama_cs, SUM(a.diskon) AS diskon, SUM(a.subtotal) AS total, SUBSTRING(b.tgl, 1, 10) AS tgl, b.tgl AS waktu, SUM(a.qty_jual) AS qty, b.method FROM detil_penjualan a, penjualan b, customer c, user d  WHERE b.id_jual = a.id_jual AND c.id_cs = b.id_cs AND d.id_user = b.id_user AND SUBSTRING(b.tgl, 1, 10) BETWEEN '$awal' AND '$akhir' GROUP BY a.id_jual ORDER BY tgl ASC";

$sqldetil = "SELECT b.id_jual, a.kode_detil_jual, c.barcode, c.nama_barang, a.harga_item, a.qty_jual, a.diskon,  a.subtotal FROM detil_penjualan a, penjualan b, barang c WHERE b.id_jual = a.id_jual AND c.id_barang = a.id_barang";

$detil = $this->db->query($sqldetil)->result_array();
$jual = $this->db->query($sql)->result_array();
foreach ($jual as $j) {
    $pdf->Cell(30, 17, '', 0, 1);
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(20, 6, 'INVOICE', 0, 0, 'L');
    $pdf->Cell(2, 6, ': ', 0, 0, 'C');
    $pdf->Cell(65, 6, $j['invoice'], 0, 0, 'L');
    $pdf->Cell(25, 6, 'KASIR', 0, 0, 'L');
    $pdf->Cell(3, 6, ': ', 0, 0, 'R');
    $pdf->Cell(50, 6, $j['nama_lengkap'], 0, 1, 'L');
    $pdf->Cell(30, 0, '', 0, 1);
    $pdf->Cell(20, 6, 'WAKTU', 0, 0, 'L');
    $pdf->Cell(3, 6, ': ', 0, 0, 'C');
    $pdf->Cell(64, 6, $j['waktu'], 0, 0, 'L');
    $pdf->Cell(25, 6, 'CUSTOMER', 0, 0, 'L');
    $pdf->Cell(3, 6, ': ', 0, 0, 'R');
    $pdf->Cell(20, 6, $j['nama_cs'], 0, 0, 'L');
    $pdf->Cell(30, 6, '', 0, 1);
    $i = 1;
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(7, 6, 'NO', 1, 0, 'C');
    $pdf->Cell(25, 6, 'BARCODE', 1, 0, 'C');
    $pdf->Cell(68, 6, 'ITEM', 1, 0, 'C');
    $pdf->Cell(25, 6, 'HARGA', 1, 0, 'C');
    $pdf->Cell(17, 6, 'QTY', 1, 0, 'C');
    $pdf->Cell(25, 6, 'DISC (Rp.)', 1, 0, 'C');
    $pdf->Cell(25, 6, 'SUBTOTAL', 1, 1, 'C');

    foreach ($detil as $d) {
        if ($j['id_jual'] == $d['id_jual']) {
            $pdf->SetFont('Times', '', 9);
            $pdf->Cell(7, 6, $i++, 1, 0);
            $pdf->Cell(25, 6, $d['barcode'], 1, 0);
            $pdf->Cell(68, 6, $d['nama_barang'], 1, 0);
            $pdf->Cell(25, 6, number_format($d['harga_item'], '0', '.', '.'), 1, 0);
            $pdf->Cell(17, 6, $d['qty_jual'], 1, 0);
            $pdf->Cell(25, 6, number_format($d['diskon'], '0', '.', '.'), 1, 0);
            $pdf->Cell(25, 6, number_format($d['subtotal'], '0', '.', '.'), 1, 1);
        }
    }

    $pdf->Cell(132, 2, '', 0, 1, 'R');
    $pdf->Cell(132, 6, '', 0, 0, 'R');
    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Cell(28, 6, 'Disc (Rp)', 1, 0, 'L');
    $pdf->Cell(32, 6, 'Rp. ' . number_format($j['diskon'], '0', '.', '.') . ' ,-', 1, 1, 'L');
    $pdf->Cell(132, 6, '', 0, 0, 'R');
    $pdf->Cell(28, 6, 'Subtotal', 1, 0, 'L');
    $pdf->Cell(32, 6, 'Rp. ' . number_format($j['total'], '0', '.', '.') . ' ,-', 1, 1, 'L');
}

$pdf->SetFont('Times', '', 10);
$pdf->Output('laporan_penjualan.pdf', 'I');
