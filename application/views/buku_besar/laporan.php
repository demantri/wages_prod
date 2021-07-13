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
                <form class="form-horizontal" method="post" action="<?php echo base_url('Laporan/bukuBesar') ?>">
                  <div class="form-group">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="id_akun">Nama Akun<i class="text-danger"> *</i></label>
                      <select name="id_akun" id="id_akun" class="form-control select2" required>
                          <option value="">Select</option>
                          <?php foreach($akun as $i) : ?>
                              <option value="<?=$i->id;?>"><?=$i->nama_akun;?></option>
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
                    <h3>Buku Besar</h3>
                    <h5><?= $header_akun?> - Periode <?= date('F Y', strtotime($where['periode'])) ?> </h5>
                  </center>
                  <br>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="4">Saldo Awal</td>
                        <td><?= $saldo_awal ?></td>
                      </tr>
                      <?php foreach ($list as $key => $value) { ?>
                        <tr>
                          <td><?= $value->tgl_jurnal?></td>
                          <td><?= $value->nama_akun?></td>
                          <?php if ($value->posisi_dr_cr == 'd') { ?>
                            <td><?= $value->nominal?></td>
                            <td></td>
                          <?php } else { ?>
                            <td></td>
                            <td><?= $value->nominal?></td>
                          <?php } ?>
                          <td><?= $value->nominal?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>