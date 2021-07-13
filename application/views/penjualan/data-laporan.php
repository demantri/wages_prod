<?php
//$sql = "SELECT b.id_jual, b.invoice, d.nama_lengkap, c.nama_cs, SUM(a.diskon) AS diskon, SUM(a.subtotal) AS total, SUBSTRING(b.tgl, 1, 10) AS tgl, b.tgl AS waktu, SUM(a.qty_jual) AS qty, b.method FROM detil_penjualan a, penjualan b, customer c, user d  WHERE b.id_jual = a.id_jual AND c.id_cs = b.id_cs AND d.id_user = b.id_user AND SUBSTRING(b.tgl, 1, 10) BETWEEN '$awal' AND '$akhir' GROUP BY a.id_jual ORDER BY tgl ASC";
$sqldetil = "SELECT b.invoice, b.tgl, b.id_jual, a.kode_detil_jual, c.barcode, c.nama_barang, a.harga_item, a.qty_jual, a.diskon,  a.subtotal FROM detil_penjualan a, penjualan b, barang c WHERE b.id_jual = a.id_jual AND c.id_barang = a.id_barang";


$detail = $this->db->query($sqldetil)->result();
?>

<a href="<?=base_url('report/penjualan?tgl_awal=' . $awal . '&&tgl_akhir=' . $akhir);?>" target="_blank" class="btn btn-dark"><i class="fa fa-print"></i> Export to PDF</a>

<table class="table table-bordered table-hover" id="laporan-dataTable" width="100%">
    <thead>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Harga Brang</th>
        <th>QTY Jual</th>
        <th>Subtotal</th>
        
    </thead>
    <tbody>
        <?php foreach($detail as $d) : ?>
        <tr>
            <td><?=$d->invoice;?></td>
            <td><?=$d->tgl;?></td>  
            <td><?=$d->nama_barang;?></td>
            <td><?=$d->harga_item;?></td>
            <td><?=$d->qty_jual;?></td>
            <td><?=$d->subtotal;?></td>
            
       
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<div class="modal fade" id="myModal">
 	<div class="modal-dialog bs-example-modal-sm">
 		<div class="modal-content">
            <div id="viewData"></div>
        </div>
    </div>
</div>