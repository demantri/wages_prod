    <?php
      cek_user();

      $sqldetil = "SELECT a.id_barang, a.nama_barang, a.barcode, a.harga_sales, b.satuan, c.kategori,a.harga_jual, a.stok FROM barang a, satuan b, kategori c WHERE c.id_kategori = a.id_kategori AND b.id_satuan = a.id_satuan AND a.is_active = 1";

      $detil = $this->model->General($sqldetil)->result();
    ?>
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3><?php echo $title ?></h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-12">
            <div class="x_panel">
              <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <a href="<?php echo base_url('report/semua_barang') ?>" target="_blank" class="btn btn-dark"><i class="fa fa-download"></i> Export Data</a>
                <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="laporan-dataTable" width="100%">
                    <thead>
                      <th width="1%">No.</th>
                      <th>Barcode</th>
                      <th>Nama Item</th>
                      <th>Satuan</th>
                      <th>Stok</th>
                      <th>Harga Umum</th>
                      <th>Harga Sales</th>
                      
                    </thead>
                    <tbody>
                      <?php $no = 1;foreach($detil as $i) : ?>
                      <tr>
                        <td class="text-center"><?=$no++;?>.</td>
                        <td><?=$i->barcode;?></td>
                        <td><?=$i->nama_barang;?></td>
                        <td><?=$i->satuan;?></td>
                        <td><?=$i->stok;?></td>
                        <td class="text-right">Rp. <?=number_format($i->harga_jual, 0, ',', '.');?></td>
                        <td class="text-right">Rp. <?=number_format($i->harga_sales, 0, ',', '.');?></td>
                        
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>