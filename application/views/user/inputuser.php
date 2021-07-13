 <div class="modal fade" id="inputUserModal">
	<div class="modal-dialog">
	  <div class="modal-content">

		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title" id="inputUserModal">Entry Data User</h4>
		</div>
		<div class="modal-body">
		 <form class="form-horizontal" method="post" action="<?php echo base_url('user/inputuser')?>">
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control" id="username" name="username" autocomplete="off">
				</div>
			  </div>
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control" id="nama" name="nama"autocomplete="off">
				</div>
			  </div>
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="password" class="form-control" id="password" name="password">
				</div>
			  </div>
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">No. Telp</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control" id="telp" name="telp" autocomplete="off">
				</div>
			  </div>
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control" id="email" name="email" autocomplete="off">
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Tipe User</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				   <select id="tipe" name="tipe" class="form-control" required>
					  <option value=""></option>
					  <option value="Kasir">Kasir</option>
					  <option value="Administrator">Administrator</option>
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