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
						<form action="<?= base_url('absensiGaji/admin/jurnalUmum')?>" method="post">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-1">
										<label for="">Tanggal Awal</label>
									</div>
									<div class="col-sm-3">
										<input type="date" class="form-control" name="tgl_awal" required>
									</div>
									<div class="col-sm-1">
										<label for="">Tanggal Akhir</label>
									</div>
									<div class="col-sm-3">
										<input type="date" class="form-control" name="tgl_akhir" required>
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
							<h3>Jurnal Umum</h3>
							<h6>Per <?= $tgl_awal .' - '. $tgl_akhir?></h6>
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
								</tr>
								</thead>
								<tbody>
								<?php 
								$saldo_d = 0;
								$saldo_k = 0;
								foreach ($list as $key => $value) { ?>
								<tr>
									<?php if ($value->posisi_dr_cr == 'd') { ?>
										<td><?= $value->tgl_jurnal?></td>
										<td><?= $value->id_transaksi?></td>
									<?php } else { ?>
										<td></td>
										<td></td>
									<?php } ?>
									<td><?= $value->no_coa?></td>
									<?php if ($value->posisi_dr_cr == 'd') { ?>
										<td><?= $value->nominal?></td>
										<td></td>
										<?php $saldo_d += $value->nominal; ?> 
									<?php } else { ?>
										<td></td>
										<td><?= $value->nominal?></td>
										<?php $saldo_k += $value->nominal; ?>
									<?php } ?>
								</tr>
								<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3">Total</th>
										<th><?= $saldo_d?></th>
										<th><?= $saldo_k?></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
