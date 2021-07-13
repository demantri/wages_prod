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

$akun = $this->db->get_where('akun', ['id' => $id_akun]);
$akun = $akun->row();

$pdf->Cell(0, 7, 'Periode :' . $awal . ' s/d ' . $akhir . '   |   Nama Akun : ' . $akun->nama_akun, 0, 1, 'C');

$sql = $this->db->get_where('akun', ['id' => $id_akun]);
$posisi_awal = $sql->row();
$posisi_awal = $posisi_awal->c_d;

$this->db->select(['sum(a.nominal) as nominal', 'a.tgl', 'b.c_d']);
$this->db->from('jurnal_umum a');
$this->db->join('akun b', 'b.id=a.id_akun', 'inner');
$this->db->where('a.id_akun', $id_akun);
$this->db->where('tgl BETWEEN "' . date('Y-m-d', strtotime($awal)) . '" and "' . date('Y-m-d', strtotime($akhir)) . '"');
$this->db->group_by('b.c_d');
$this->db->order_by('a.tgl', 'ASC');
$hasil = $this->db->get();

$saldo_debit = 0;
$saldo_kredit = 0;

foreach($hasil->result() as $i){
    if(strcmp($i->c_d, 'd') == 0){
        $saldo_debit = $saldo_debit + $i->nominal;
    } else {
        $saldo_kredit = $saldo_kredit + $i->nominal;
    }
}

if(strcmp($akun->c_d, 'd') == 0){
    $saldo = $saldo_debit - $saldo_kredit;
} else {
    $saldo = $saldo_kredit - $saldo_debit;
}

$pdf->cell(0, 10, '', 0, 1);
$pdf->cell(45, 8, 'Tanggal', 1, 0, 'C');
$pdf->cell(40, 8, 'Pos', 1, 0, 'C');
$pdf->cell(46, 8, 'Debit', 1, 0, 'C');
$pdf->cell(46, 8, 'Kredit', 1, 0, 'C');
$pdf->cell(50, 8, 'Saldo Debet', 1, 0, 'C');
$pdf->cell(50, 8, 'Saldo Kredit', 1, 1, 'C');

$pdf->SetFont('Times', 'B', 10);
$pdf->cell(45, 6, '-', 1, 0, 'L');
$pdf->cell(40, 6, 'Saldo Awal', 1, 0, 'L');
$pdf->cell(46, 6, '-', 1, 0, 'L');
$pdf->cell(46, 6, '-', 1, 0, 'L');

if(strcmp($posisi_awal, 'd') == 0){
    $saldo_debit = $saldo;
    $saldo_kredit = 0;
    $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_debit, 0, ',', '.'), 1, 0, 'L');
    $pdf->cell(50, 6, '-', 1, 1, 'L');
} else {
    $saldo_debit = 0;
    $saldo_kredit = $saldo;
    $pdf->cell(50, 6, '-', 1, 0, 'L');
    $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_kredit, 0, ',', '.'), 1, 1, 'L');
}


$this->db->select(['a.tgl', 'b.nama_akun', 'a.nominal', 'b.c_d']);
$this->db->from('jurnal_umum a');
$this->db->join('akun b', 'b.id=a.id_akun', 'inner');
$this->db->where('a.id_akun', $id_akun);
$this->db->where('tgl BETWEEN "' . date('Y-m-d', strtotime($awal)) . '" and "' . date('Y-m-d', strtotime($akhir)) . '"');
$this->db->group_by('tgl');
$this->db->order_by('a.tgl', 'ASC');
$data = $this->db->get();

$pdf->SetFont('Times', '', 10);

foreach($data->result() as $d){
    $pdf->cell(45, 6, $d->tgl, 1, 0, 'L');
    $pdf->cell(40, 6, $d->nama_akun, 1, 0, 'L');

    if(strcmp($d->c_d, 'd') == 0){
        $pdf->cell(46, 6, 'Rp. ' . number_format($d->nominal, 0, ',', '.'), 1, 0, 'L');
        $pdf->cell(46, 6, '-', 1, 0, 'L');

        if(strcmp($posisi_awal, 'd') == 0){
            $saldo_debit = $saldo_debit + $d->nominal;
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_debit, 0, ',', '.'), 1, 0, 'L');
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_kredit, 0, ',', '.'), 1, 1, 'L');
        } else {
            $saldo_kredit = $saldo_kredit - $d->nominal;
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_debit, 0, ',', '.'), 1, 0, 'L');
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_kredit, 0, ',', '.'), 1, 1, 'L');
        }
    } else {
        $pdf->cell(46, 6, '-', 1, 0, 'L');
        $pdf->cell(46, 6, 'Rp. ' . number_format($d->nominal, 0, ',', '.'), 1, 0, 'L');

        if(strcmp($posisi_awal, 'd') == 0){
            $saldo_debit = $saldo_debit - $d->nominal;
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_debit, 0, ',', '.'), 1, 0, 'L');
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_kredit, 0, ',', '.'), 1, 1, 'L');
        } else {
            $saldo_kredit = $saldo_kredit + $d->nominal;
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_debit, 0, ',', '.'), 1, 0, 'L');
            $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_kredit, 0, ',', '.'), 1, 1, 'L');
        }
    }

}

$pdf->SetFont('Times', 'B', 10);
$pdf->cell(45, 6, '-', 1, 0, 'L');
$pdf->cell(40, 6, 'Saldo Akhir', 1, 0, 'L');
$pdf->cell(46, 6, '-', 1, 0, 'L');
$pdf->cell(46, 6, '-', 1, 0, 'L');

if(strcmp($posisi_awal, 'd') == 0){
    $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_debit, 0, ',', '.'), 1, 0, 'L');
    $pdf->cell(50, 6, '-', 1, 1, 'L');
} else {
    $pdf->cell(50, 6, '-', 1, 0, 'L');
    $pdf->cell(50, 6, 'Rp. ' . number_format($saldo_kredit, 0, ',', '.'), 1, 1, 'L');
}

$pdf->SetFont('Times', '', 10);
$pdf->Output('laporan_penjualan.pdf', 'I');
