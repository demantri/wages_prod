	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<section class="mt-5">
					<h2 class="text-center" style="padding-top: 25px; padding-bottom: 25px"><img src="<?php echo base_url('assets/img/profil/') . $toko->logo_toko ?>" width="40"> <?php echo $title ?></h2>
					<?php echo $this->session->flashdata('message'); ?>
					<form action="<?php echo base_url('auth') ?>" method="post">
						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
							<?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
						</div>
						<div>
							<input type="password" class="form-control" name="password" placeholder="Password">
							<?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
						</div>
						<!-- <a href="" style="float:right">Forgot Password</a><br> -->
						<div class="form-group" style="padding-top: 10px">
							<button class="btn btn-success btn-block" type="submit"><i class="fa fa-unlock"></i> Log in</button>
						</div>
						<div class="clearfix"></div>
						<div class="separator">
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>