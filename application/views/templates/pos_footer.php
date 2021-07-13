		<footer>
			<div class="pull-right">
				Copyright &copy; 2020
			</div>
			<div class="clearfix"></div>
		</footer>
		</div>
		</div>
		<script src="<?php echo base_url('assets/') ?>vendors/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/fastclick/lib/fastclick.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/nprogress/nprogress.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/Chart.js/dist/Chart.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/DateJS/build/date.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/moment/min/moment.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="<?php echo base_url('assets/') ?>build/js/custom.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<!-- <script src="<?php //echo base_url('assets/')
							?>select2/dist/js/select2.full.min.js"></script> -->
		<script type="text/javascript" src="<?php echo base_url('assets/'); ?>DataTables/datatables.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>grafik/chart.js"></script>
		<script src="<?php echo base_url('assets/') ?>Javascript/Js-main.js"></script>
		<script src="<?php echo base_url('assets/') ?>Javascript/modjs-custom.js"></script>
		<script src="<?php echo base_url('assets/select2/select2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/') ?>vendors/switchery/dist/switchery.min.js"></script>
		<script>
			$(document).ready(function() {
				$('.select2').select2();
				$('.datatable').DataTable();
				$('.kode-servis').hide();
				$('.jatuh-tempo').hide();
				var persen_ppn = $('#ppn_persen');
				var subtotal = $('#subtotal');
				var grandtotal = $('#grandtotal');
				var ppn_rp = $('#nominal_ppn');
				persen_ppn.keyup(function() {
					var persen = document.getElementById('ppn_persen').value;
					if (persen == null || persen == 0) {
						grandtotal.val(subtotal.val());
						ppn_rp.val(0);
					} else {
						var nominal_ppn = subtotal.val() * persen_ppn.val() / 100;
						ppn_rp.val(nominal_ppn);
						var total = Number(subtotal.val()) + Number(nominal_ppn);
						grandtotal.val(total);

					}
				});
				$('input:radio[name="metode"]').on('change', function() {
					if ($(this).is(':checked') && $(this).val() == "Cash") {
						$('.jatuh-tempo').hide();
					} else if ($(this).is(':checked') && $(this).val() == "Kredit") {
						$('.jatuh-tempo').show();
					}
				});

				diskon();
				totalbayar();
				invoice();
				$('#ppn_persen').val(0);
				$('#nominal_ppn').val(0);
				$('#diskon1').val(0);
				$('#diskonbeli').val(0);
				$('#selisih').val(0);
			})
		</script>
		</body>

		</html>