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
                              <option value="<?=$i->kode_akun;?>"><?=$i->nama_akun;?></option>
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
									<h5>No Akun : <?= $where['akun']?></h5>
									<h5>Akun : <?= $header_akun?></h5>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
												<th>Tanggal</th>
												<th>Keterangan</th>
												<th>Ref</th>
												<th>Debit</th>
												<th>Credit</th>
												<th>Saldo</th>
                      </tr>
                    </thead>
                    <tbody>
										<?php 
											$saldo_a = $saldo_awal->debit - $saldo_awal->kredit;
											$saldo_awal = $saldo + $saldo_a;
											// print_r($saldo);
										?>
										<tr>
											<td>0000-00-00</td>
											<td>Saldo Awal</td>
											<td></td>
											<td></td>
											<td></td>
											<td class="text-right"><?= $saldo_awal?></td>
										</tr>
										<?php
										foreach ($list as $key => $value) { ?>
										<?php $header = substr($value->no_coa, 0, 1); ?>
												<tr>
													<td><?= $value->tgl_jurnal?></td>
													<td><?= $value->nama_akun?></td>
																		<td><?= $value->no_coa?></td>
													<?php if ($value->posisi_dr_cr == 'd') {?>
														<?php if ($header == 1 OR $header == 5 OR $header == 6 ) { ?>
															<?php $saldo_awal = $saldo_awal + $value->nominal; ?>
														<?php } else { ?>
															<?php $saldo_awal = $saldo_awal - $value->nominal; ?>
														<?php } ?>
														<td class="text-right"><?= $value->nominal?></td>
														<td></td>
													<?php } else { ?>
														<?php if ($header == 1 OR $header == 5 OR $header == 6 ) { ?>
															<?php $saldo_awal = $saldo_awal - $value->nominal; ?>
														<?php } else { ?>
															<?php $saldo_awal = $saldo_awal + $value->nominal; ?>
														<?php } ?>
														<td></td>
														<td class="text-right"><?= $value->nominal?></td>
													<?php } ?>
													<td class="text-right"><?= $saldo_awal?></td>
												</tr>
											<?php } ?>
										<tr>
											<td>0000-00-00</td>
											<td>Saldo Akhir</td>
											<td></td>
											<td></td>
											<td></td>
											<td class="text-right"><?= $saldo_awal?></td>
										</tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
