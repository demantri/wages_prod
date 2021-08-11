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
                <form class="form-horizontal" method="post" action="<?php echo base_url('Laporan/jurnalUmum') ?>">
                  <div class="form-group">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Tanggal Awal :</label>
                      <input type="date" id="awal" class="form-control datepicker" name="awal" required />
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <label for="">Tanggal Akhir :</label>
                      <input type="date" id="akhir" class="form-control datepicker" name="akhir" required />
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                      <label for="">&nbsp</label>
                      <input type="submit" class="btn btn-primary form-control" value="Search" />
                    </div>
                  </div>
                  <hr>
                  <center>
                    <h3>Jurnal Umum</h3>
                    <h5><?= $periode ?> </h5>
                  </center>
                  <br>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Ref</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $total_d = 0;
                      $total_k = 0;
                      foreach ($list as $key => $value) {?>
                      <tr>

                        <?php if ($value->posisi_dr_cr == 'd') { ?>
                          <td><?= $value->tgl_jurnal?></td>
                          <td><?= $value->nama_akun?></td>
                        <?php } else { ?>
                          <td></td>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $value->nama_akun?></td>
                        <?php } ?>
                        
                        <td><?= $value->no_coa?></td>

                        <?php if ($value->posisi_dr_cr == 'd') { ?>
                          <td><?= $value->nominal?></td>
                          <td></td>
													<?php $total_d += $value->nominal ?>
                        <?php } else { ?>
                          <td></td>
                          <td><?= $value->nominal?></td>
													<?php $total_k += $value->nominal ?>
                        <?php } ?>

                      </tr>
                      <?php } ?>
                    </tbody>
										<tfoot>
											<tr>
												<td colspan="3">Total</td>
												<td><?= $total_d ?></td>
												<td><?= $total_k ?></td>
											</tr>
										</tfoot>
                  </table>
                  <!-- <div class="form-group">
                    <div class="col-md-1 col-sm-6 col-xs-12">
                      <button type="submit" class="btn btn-sm btn-primary btn-block"><i class="fa fa-file-pdf-o"></i> Export PDF</button>
                    </div>
                  </div> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
