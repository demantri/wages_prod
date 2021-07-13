<?php

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 18);
$profil = $this->db->get('profil_perusahaan')->row_array();
$pdf->Image('./assets/img/profil/' . $profil['logo_toko'], 70, 5, 27, 24);
$pdf->Cell(25);
$pdf->SetFont('Times', 'B', 20);
$pdf->Cell(0, 5, $profil['nama_toko'], 0, 1, 'C');
$pdf->Cell(25);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, 'Website :' . $profil['website_toko'] . '/ E-Mail : ' . $profil['email_toko'], 0, 1, 'C');
$pdf->Cell(25);
$pdf->SetFont('Times', 'B', 10);
$pdf->Cell(0, 5, $profil['alamat_toko'] . ' Telp. / Fax : ' . $profil['telp_toko'] . ' / ' . $profil['fax_toko'], 0, 1, 'C');

$pdf->SetLineWidth(1);
$pdf->Line(10, 36, 285, 36);
$pdf->SetLineWidth(0);
$pdf->Line(10, 37, 285, 37);
$pdf->Cell(30, 17, '', 0, 1);

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 5, 'LAPORAN STOK MASUK', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(0, 7, 'Periode :' . $awal . ' s/d ' . $akhir, 0, 1, 'C');



$sql = "SELECT d.id_stok, a.barcode, a.nama_barang, d.jenis, d.nilai, d.keterangan, SUBSTRING(d.tanggal, 1, 10) AS tanggal, d.jml, c.satuan FROM  barang a, satuan c, stok d        
WHERE a.id_satuan = c.id_satuan AND d.id_barang = a.id_barang AND SUBSTRING(d.tanggal, 1, 10) BETWEEN '$awal' AND '$akhir'";


$data = $this->db->query($sql)->result_array();

$pdf->Cell(30, 8, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(30, 6, 'BARCODE', 1, 0, 'C');
$pdf->Cell(65, 6, 'NAMA ITEM', 1, 0, 'C');
$pdf->Cell(20, 6, 'SATUAN', 1, 0, 'C');
$pdf->Cell(17, 6, 'JUMLAH', 1, 0, 'C');
$pdf->Cell(25, 6, 'NILAI', 1, 0, 'C');
$pdf->Cell(25, 6, 'JENIS', 1, 0, 'C');
$pdf->Cell(23, 6, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(74, 6, 'KETERANGAN', 1, 1, 'C');
foreach ($data as $d) {
    $pdf->SetFont('Times', '', 9);
    $pdf->Cell(30, 6, $d['barcode'], 1, 0);
    $pdf->Cell(65, 6, $d['nama_barang'], 1, 0);
    $pdf->Cell(20, 6, $d['satuan'], 1, 0);
    $pdf->Cell(17, 6, $d['jml'], 1, 0);
    $pdf->Cell(25, 6, 'Rp. ' . number_format($d['nilai'], '0', '.', '.'), 1, 0);
    $pdf->Cell(25, 6, $d['jenis'], 1, 0);
    $pdf->Cell(23, 6, $d['tanggal'], 1, 0);
    $pdf->Cell(74, 6, $d['keterangan'], 1, 1);
}



    $sql_nilai_masuk = "SELECT SUM(nilai) AS nilai_masuk FROM stok WHERE jenis = 'Stok Masuk' AND SUBSTRING(tanggal, 1, 10) BETWEEN '$awal' AND '$akhir'";
    $sql_nilai_keluar = "SELECT SUM(nilai) AS nilai_keluar FROM stok WHERE jenis = 'Stok Keluar' AND SUBSTRING(tanggal, 1, 10) BETWEEN '$awal' AND '$akhir'";
    $nilai_masuk = $this->db->query($sql_nilai_masuk)->row_array();
    $nilai_keluar = $this->db->query($sql_nilai_keluar)->row_array();

    $pdf->Cell(202, 2, '', 0, 1, 'R');
    $pdf->Cell(202, 6, '', 0, 0, 'R');
    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Cell(40, 6, 'Total Nilai Stok Masuk', 1, 0, 'L');
    $pdf->Cell(37, 6, 'Rp. ' . number_format($nilai_masuk['nilai_masuk'], '0', '.', '.') . ',-', 1, 1, 'L');
    $pdf->Cell(202, 6, '', 0, 0, 'R');
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Cell(40, 6, 'Total Nilai Stok Keluar', 1, 0, 'L');
    $pdf->Cell(37, 6, 'Rp. ' . number_format($nilai_keluar['nilai_keluar'], '0', '.', '.') . ',-', 1, 1, 'L');



$pdf->Output('laporan_stok.pdf', 'I');
