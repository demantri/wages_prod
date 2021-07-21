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
          <div class="col-md-12 col-sm-6 col-xs-12">
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
                <form class="form-horizontal" method="post" action="<?php echo base_url('Laporan/kartuStok') ?>">
                  <div class="form-group">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="id_barang">Nama Barang<i class="text-danger"> *</i></label>
                      <select name="id_barang" id="id_barang" class="form-control select2" required>
                          <option value="">Select</option>
                          <?php foreach($barang as $i) : ?>
                              <option value="<?=$i->id_barang;?>"><?=$i->nama_barang;?></option>
                          <?php endforeach;?>
                      </select>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="periode">Periode</label>
                      <input type="month" id="periode" class="form-control" name="periode" required />
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                      <label for="">&nbsp</label>
                      <input type="submit" class="btn btn-primary form-control" value="Search" />
                    </div>
                  </div>
                  <hr>
                  <center>
                    <h3>Kartu Stok</h3>
                    <h5></h5>
                  </center>
                  <br>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center" rowspan="2">Waktu Transaksi</th>
                        <th class="text-center" rowspan="2">Keterangan</th>
                        <th class="text-center" colspan="3">Pembelian</th>
                        <th class="text-center" colspan="3">Harga Pokok Penjualan</th>
                        <th class="text-center" colspan="3">Saldo</th>
                      </tr>
											<tr>
												<th class="text-center">Unit</th>
												<th class="text-center">Harga</th>
												<th class="text-center">Total</th>
												<th class="text-center">Unit</th>
												<th class="text-center">Harga</th>
												<th class="text-center">Total</th>
												<th class="text-center">Unit</th>
												<th class="text-center">Harga</th>
												<th class="text-center">Total</th>
											</tr>
                    <tbody>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
