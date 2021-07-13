<div class="modal fade" id="printBarcodeModal">
	<div class="modal-dialog">
	  <div class="modal-content">

		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title" id="printBarcodeModal">Cetak Barcode</h4>
		</div>
		<div class="modal-body">
		 <form class="form-horizontal" method="post" action="<?php echo base_url('report/print_barcode')?>">
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" class="form-control" id="jumlah_barcode" name="jumlah_barcode"autocomplete="off">
					<input type="hidden" class="form-control" id="barcode_num" name="barcode_num"autocomplete="off">
				</div>
			  </div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Barcode</button>
			</div>
		  </form>
		</div>
	  </div>
	</div>
  </div>