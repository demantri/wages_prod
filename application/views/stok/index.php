<?php cek_user() ?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php echo $title ?></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <a href="<?php echo base_url('stok/input') ?>" class="btn btn-sm btn-primary" title="Tambah Data" id="tambahkaryawan"><i class="fa fa-plus"></i> Tambah Data</a>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo $this->session->flashdata('message'); ?>
            <table width="100%" class="table table-striped table-bordered datatable">
              <thead>
                <tr>
                  <th>Barcode</th>
                  <th>Nama Item</th>
                  <th>Satuan</th>
                  <th>Jumlah</th>
                 
                  <th>Jenis</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($stok as $value) { ?>
                  <tr>
                    <td><?php echo $value['barcode'] ?></td>
                    <td><?php echo $value['nama_barang'] ?></td>
                    <td><?php echo $value['satuan'] ?></td>
                    <td><?php echo $value['jml'] ?></td>
                   
                    <td><?php echo $value['jenis'] ?></td>
                    <td><?php echo $value['tanggal'] ?></td>
                    <td><?php echo $value['keterangan'] ?></td>
                    <td>
                      <a href="#" class="btn btn-danger btn-xs" title="Hapus Data" onclick="hapusStok('<?php echo $value['id_stok'] ?>')"><i class="fa fa-trash "></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'script.php' ?>