<?php
include 'report_header.php';
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 5, 'LAPORAN LABA BERSIH', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 11);

$pdf->Cell(0, 7, 'Periode :' . $awal . ' s/d ' . $akhir, 0, 1, 'C');
$sql = "SELECT b.diskon, SUBSTRING(a.tgl, 1, 10) AS tgl, c.nama_barang, c.harga_beli, c.harga_jual, b.qty_jual, b.subtotal, b.harga_item FROM penjualan a, detil_penjualan b, barang c WHERE a.id_jual = b.id_jual AND c.id_barang = b.id_barang AND tgl BETWEEN '$awal' AND '$akhir'";

$sqlhpp = "SELECT SUM(c.harga_beli*b.qty_jual) AS total_hpp, SUBSTRING(a.tgl, 1, 10) AS tgl
FROM penjualan a, detil_penjualan b, barang c WHERE a.id_jual = b.id_jual AND c.id_barang = b.id_barang AND tgl BETWEEN '$awal' AND '$akhir'";

$sqltotal = "SELECT SUM(b.subtotal) AS total, SUBSTRING(a.tgl, 1, 10) AS tgl
FROM penjualan a, detil_penjualan b, barang c WHERE a.id_jual = b.id_jual AND c.id_barang = b.id_barang AND tgl BETWEEN '$awal' AND '$akhir'";

$hpp = $this->model->General($sqlhpp)->row_array();
$total = $this->model->General($sqltotal)->row_array();
$item = $this->model->General($sql)->result_array();

$laba = $total['total'] - $hpp['total_hpp'] - (int)$lain;

$pdf->Cell(30, 10, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(7, 6, 'NO', 1, 0, 'C');
$pdf->Cell(23, 6, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(65, 6, 'NAMA BARANG', 1, 0, 'C');
$pdf->Cell(24, 6, 'HPP', 1, 0, 'C');
$pdf->Cell(24, 6, 'PENJUALAN', 1, 0, 'C');
$pdf->Cell(12, 6, 'QTY', 1, 0, 'C');
$pdf->Cell(17, 6, 'DISKON', 1, 0, 'C');
$pdf->Cell(24, 6, 'SUBTOTAL', 1, 1, 'C');
$i = 1;
foreach ($item as $item) {
    $pdf->SetFont('Times', '', 9);
    $pdf->Cell(7, 6, $i++, 1, 0);
    $pdf->Cell(23, 6, $item['tgl'], 1, 0);
    $pdf->Cell(65, 6, $item['nama_barang'], 1, 0);
    $pdf->Cell(24, 6, 'Rp. ' . number_format($item['harga_beli'], '0', '.', '.'), 1, 0);
    $pdf->Cell(24, 6, 'Rp. ' . number_format($item['harga_item'], '0', '.', '.'), 1, 0);
    $pdf->Cell(12, 6, $item['qty_jual'], 1, 0);
    $pdf->Cell(17, 6, $item['diskon'], 1, 0);
    $pdf->Cell(24, 6, 'Rp. ' . $item['subtotal'], 1, 1);
}
$pdf->Cell(136, 2, '', 0, 1, 'R');
$pdf->Cell(136, 6, '', 0, 0, 'R');
$pdf->SetFont('Times', 'B', 10);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(28, 6, 'TOTAL', 1, 0, 'L');
$pdf->Cell(32, 6, 'Rp. ' . number_format($total['total'], '0', '.', '.') . ',-', 1, 1, 'L');
$pdf->Cell(136, 6, '', 0, 0, 'R');
$pdf->Cell(28, 6, 'HPP', 1, 0, 'L');
$pdf->Cell(32, 6, 'Rp. ' . number_format($hpp['total_hpp'], '0', '.', '.') . ',-', 1, 1, 'L');
$pdf->Cell(136, 6, '', 0, 0, 'R');
$pdf->Cell(28, 6, 'LAIN-LAIN', 1, 0, 'L');
$pdf->Cell(32, 6, 'Rp. ' . number_format($lain, '0', '.', '.') . ',-', 1, 1, 'L');
$pdf->Cell(136, 6, '', 0, 0, 'R');
$pdf->Cell(28, 6, 'LABA', 1, 0, 'L');
$pdf->Cell(32, 6, 'Rp. ' . number_format($laba, '0', '.', '.') . ',-', 1, 1, 'L');

$pdf->SetFont('Times', '', 10);
$pdf->Output('laporan_laba_kotor.pdf', 'I');
