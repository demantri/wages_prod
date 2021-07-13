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
$pdf->Line(10, 36, 287, 36);
$pdf->SetLineWidth(0);
$pdf->Line(10, 37, 287, 37);
$pdf->Cell(30, 17, '', 0, 1);

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 5, 'LAPORAN JURNAL UMUM', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 11);

$pdf->Cell(0, 7, 'Periode :' . $awal . ' s/d ' . $akhir, 0, 1, 'C');

$this->db->select(['a.tgl', 'a.nominal', 'b.kode_akun', 'b.nama_akun', 'b.c_d']);
$this->db->from('jurnal_umum a');
$this->db->join('akun b', 'b.id=a.id_akun', 'inner');
$this->db->where('tgl BETWEEN "' . date('Y-m-d', strtotime($awal)) . '" and "' . date('Y-m-d', strtotime($akhir)) . '"');
$this->db->order_by('tgl', 'ASC');
$jurnal = $this->db->get()->result_array();


$pdf->cell(0, 10, '', 0, 1);
$pdf->cell(12, 8, 'NO.', 1, 0, 'C');
$pdf->cell(55, 8, 'Tanggal', 1, 0, 'C');
$pdf->cell(85, 8, 'Keterangan', 1, 0, 'C');
$pdf->cell(26, 8, 'Ref', 1, 0, 'C');
$pdf->cell(50, 8, 'Debit', 1, 0, 'C');
$pdf->cell(50, 8, 'Kredit', 1, 1, 'C');

$no = 1;

foreach ($jurnal as $j) {
    if(strcmp($j['c_d'], 'c')){
        $debit = 'Rp. ' . number_format($j['nominal'], 0, ',', '.');
        $kredit = '-';
    } else {
        $debit = '-';
        $kredit = 'Rp. ' . number_format($j['nominal'], 0, ',', '.');
    }
    $pdf->SetFont('Times', '', 10);
    $pdf->cell(12, 6, $no++, 1, 0, 'L');
    $pdf->cell(55, 6, $j['tgl'], 1, 0, 'L');
    $pdf->cell(85, 6, $j['nama_akun'], 1, 0, 'L');
    $pdf->cell(26, 6, $j['kode_akun'], 1, 0, 'L');
    $pdf->cell(50, 6, $debit, 1, 0, 'L');
    $pdf->cell(50, 6, $kredit, 1, 1, 'L');
}

$pdf->SetFont('Times', '', 10);
$pdf->Output('laporan_jurnal_umum.pdf', 'I');
