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
                        <th>Waktu Transaksi</th>
                        <th>Keterangan</th>
                        <th>Stok Masuk</th>
                        <th>Stok Keluar</th>
                        <th>Stok Akhir</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $key => $value): ?>
                      <tr>
                        <td><?= $value->tgl_input?></td>
                        <td><?= $value->jenis?></td>
                        <?php if ($value->jenis == 'Stok Masuk') { ?>
                        <td><?= $value->jml?></td>
                        <td></td>
                        <?php } else { ?>
                        <td></td>
                        <td><?= $value->jml?></td>
                        <?php } ?>
                        <td><?= $value->stok_akhir?></td>
                      </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>