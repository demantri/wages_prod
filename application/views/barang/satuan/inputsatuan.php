 <div class="modal fade" id="inputSatuanModal">
	<div class="modal-dialog bs-example-modal-sm">
	  <div class="modal-content">

		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title" id="inputSatuanModal">Entry Data Satuan</h4>
		</div>
		<div class="modal-body">
		 <form class="form-horizontal" method="post" action="<?php echo base_url('satuan/inputsatuan')?>">
		 	<div class="form-group">
			 	<label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Satuan</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control" id="satuan" name="satuan" autocomplete="off">
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