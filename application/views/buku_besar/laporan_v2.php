<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Jurnal Umum</h2>
  </div>
</header>


<section class="tables no-padding-bottom">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<form action="<?= base_url('absensiGaji/admin/bukubesar')?>" method="post">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-1">
										<label for="">Akun</label>
									</div>
									<div class="col-sm-3">
										<select name="kode_akun" id="kode_akun" class="form-control" required>
											<option value="">Pilih Akun</option>
											<?php foreach ($akun as $key => $value) { ?>
											<option value="<?= $value->kode_akun?>"><?= $value->nama_akun?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-1">
										<label for="">Periode</label>
									</div>
									<div class="col-sm-3">
										<input type="month" class="form-control" name="periode" required>
									</div>
									<div class="col-sm-1">
										<input type="submit" value="Filter" class="btn btn-primary">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">

						<center>
							<h3>Buku Besar</h3>
							<h6>Periode </h6>
						</center>

						<div class="table-responsive">
							<table class="table table-bordered table-sm">
								<thead class="thead-light">
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
