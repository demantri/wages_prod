<div class="modal fade" id="inputDataBarang">
 	<div class="modal-dialog">
 		<div class="modal-content">

 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
 				</button>
 				<h4 class="modal-title" id="inputDataBarang">Entry Data Akun</h4>
 			</div>
 			<div class="modal-body">
 				<form class="form-horizontal" method="post" action="<?php echo base_url('transaksi_coa/inputakun') ?>" id="form">
 					<div class="form-group">
					 	<input type="hidden" name="id" id="id">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Transaksi</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<select name="transaksi" id="transaksi" class="form-control">
                                <option value=""></option>
                                <option value="pembebanan">Pembebanan</option>
                                <option value="pemodalan">Pemodalan</option>
                                <option value="penjualan">Penjualan</option>
                            </select>
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Akun</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
						 	<select name="id_akun" id="id_akun" class="form-control">
                                <option value=""></option>
								<?php foreach($akun->result() as $i) : ?>
                                <option value="<?=$i->id;?>"><?=$i->nama_akun;?></option>
								<?php endforeach;?>
                            </select>
 						</div>
 					</div>
					 <div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Posisi</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<select name="posisi" id="posisi" class="form-control">
                                <option value=""></option>
                                <option value="c">Credit</option>
                                <option value="d">Debit</option>
                            </select>
 						</div>
 					</div>
 					<div class="modal-footer">
 						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 						<button type="submit" class="btn btn-primary">Save changes</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>
 </div>