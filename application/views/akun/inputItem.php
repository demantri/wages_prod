<div class="modal fade" id="inputDataBarang">
 	<div class="modal-dialog">
 		<div class="modal-content">

 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
 				</button>
 				<h4 class="modal-title" id="inputDataBarang">Entry Data Akun</h4>
 			</div>
 			<div class="modal-body">
 				<form class="form-horizontal" method="post" action="<?php echo base_url('akun/inputakun') ?>" id="form">
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Akun</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<input type="text" class="form-control" id="kodeAkun" name="kode_akun" autocomplete="off">
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Akun</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<input type="text" class="form-control" id="namaAkun" name="nama_akun" autocomplete="off">
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Credit / Debit</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<select name="c_d" id="c_d" class="form-control">
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