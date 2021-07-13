<?php
$pdf = new FPDF('P', 'mm', array(1000, 60));
$pdf->setMargins(4, 10, 20);
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 18);

// $pdf->SetLineWidth(1);
// $pdf->Line(10,36,197,36);
// $pdf->SetLineWidth(0);
// $pdf->Line(10,37,197,37);
// $pdf->Cell(30,17,'',0,1);
$x = 10;
$y = 10;
for ($i = 1; $i <= $jumlah; $i++) {
    $pdf->EAN13($x, $y, $barcode_num, 9, 0.4, 9);
    $y = $y + 25;
}


// $pdf->EAN13(10, 30,'711844110519',8,0.4,9);
// $pdf->EAN13(60, 30,'711844110519',8,0.4,9);
// $pdf->EAN13(110, 30,'711844110519',8,0.4,9);
// $pdf->EAN13(160, 30,'711844110519',8,0.4,9);

// $pdf->EAN13(10, 50,'711844110519',8,0.4,9);
// $pdf->EAN13(60, 50,'711844110519',8,0.4,9);
// $pdf->EAN13(110, 50,'711844110519',8,0.4,9);
// $pdf->EAN13(160, 50,'711844110519',8,0.4,9);

// $pdf->EAN13(60, 70,'711844110519',8,0.4,9);
// $pdf->EAN13(10, 70,'711844110519',8,0.4,9);
// $pdf->EAN13(110, 70,'711844110519',8,0.4,9);
// $pdf->EAN13(160, 70,'711844110519',8,0.4,9);

$pdf->Output($barcode_num . '_barcode.pdf', 'I');
