 <div class="modal fade" id="inputCustomerModal">
 	<div class="modal-dialog">
 		<div class="modal-content">

 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
 				</button>
 				<h4 class="modal-title" id="inputCustomerModal">Entry Data Customer</h4>
 			</div>
 			<div class="modal-body">
 				<form class="form-horizontal" method="post" action="<?php echo base_url('customer/inputcustomer') ?>">
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<input type="text" class="form-control" id="namacs" name="namacs" autocomplete="off">
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<select id="kelamin" name="kelamin" class="form-control" required>
 								<option value=""></option>
 								<option value="Laki-Laki">Laki-Laki</option>
 								<option value="Perempuan">Perempuan</option>
 							</select>
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<input type="text" class="form-control" id="email" name="email" autocomplete="off">
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">No. Telp</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<input type="text" class="form-control" id="telp" name="telp" autocomplete="off">
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<select id="jenis" name="jenis" class="form-control" required>
 								<option value=""></option>
 								<option value="Umum">Umum</option>
 								<option value="Sales">Reseller</option>
 							</select>
 						</div>
 					</div>
 					<div class="form-group">
 						<label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
 						<div class="col-md-9 col-sm-9 col-xs-12">
 							<textarea col="7" rows="2" class="form-control" name="alamat" id="alamat"></textarea>
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