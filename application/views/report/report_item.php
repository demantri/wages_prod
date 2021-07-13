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
$pdf->Cell(0, 5, 'LAPORAN DATA BARANG', 0, 1, 'C');
$sqldetil = "SELECT a.id_barang, a.nama_barang, a.barcode, a.harga_sales, b.satuan, c.kategori,a.harga_jual, a.stok FROM barang a, satuan b, kategori c WHERE c.id_kategori = a.id_kategori AND b.id_satuan = a.id_satuan AND a.is_active = 1";

$detil = $this->model->General($sqldetil)->result_array();
$pdf->Cell(30, 8, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(7, 6, 'NO', 1, 0, 'C');
$pdf->Cell(27, 6, 'BARCODE', 1, 0, 'C');
$pdf->Cell(133, 6, 'NAMA ITEM', 1, 0, 'C');
$pdf->Cell(25, 6, 'SATUAN', 1, 0, 'C');
$pdf->Cell(30, 6, 'HARGA UMUM', 1, 0, 'C');
$pdf->Cell(30, 6, 'HARGA SALES', 1, 0, 'C');
$pdf->Cell(20, 6, 'STOK', 1, 1, 'C');
$i = 1;
foreach ($detil as $d) {
    $pdf->SetFont('Times', '', 9);
    $pdf->Cell(7, 6, $i++, 1, 0);
    $pdf->Cell(27, 6, $d['barcode'], 1, 0);
    $pdf->Cell(133, 6, $d['nama_barang'], 1, 0);
    $pdf->Cell(25, 6, $d['satuan'], 1, 0);
    $pdf->Cell(30, 6, 'Rp. ' . number_format($d['harga_jual'], '0', '.', '.'), 1, 0);
    $pdf->Cell(30, 6, 'Rp. ' . number_format($d['harga_sales'], '0', '.', '.'), 1, 0);
    $pdf->Cell(20, 6, $d['stok'], 1, 1);
}

$pdf->SetFont('Times', '', 10);

$pdf->Output('laporan_barang.pdf', 'I');
