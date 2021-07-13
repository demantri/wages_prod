		 <?php cek_user() ?>
		 <div class="right_col" role="main">
		 	<div class="">
		 		<div class="page-title">
		 			<div class="title_left">
		 				<h3><?php echo $title ?></h3>
		 			</div>
		 		</div>
		 		<div class="clearfix"></div>
		 		<div class="row">
		 			<div class="col-md-12 col-sm-12 col-xs-12">
		 				<div class="x_panel">
		 					<div class="x_title">
		 						<h2><?php echo $title ?></h2>
		 						<ul class="nav navbar-right panel_toolbox">
		 							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		 							</li>
		 							<li><a class="close-link"><i class="fa fa-close"></i></a>
		 							</li>
		 						</ul>
		 						<div class="clearfix"></div>
		 					</div>
		 					<div class="x_content">
		 						<?php echo $this->session->flashdata('message'); ?>
		 						<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
		 							<div class="profile_img">
		 								<div id="crop-avatar">
		 									<img class="img-responsive avatar-view" src="<?php echo base_url('assets/img/profil/') . $toko->logo_toko ?>" alt="Avatar">
		 								</div>
		 							</div>
		 							<h3><?php echo $toko->nama_toko ?></h3>
		 							<ul class="list-unstyled user_data">
		 								<li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $toko->alamat_toko ?>
		 								</li>
		 								<li>
		 									<i class="fa fa-phone user-profile-icon"></i> Telp. <?php echo $toko->telp_toko ?>
		 								</li>
		 								<li>
		 									<i class="fa fa-tty user-profile-icon"></i> Fax: <?php echo $toko->fax_toko ?>
		 								</li>
		 								<li>
		 									<i class="fa fa-envelope user-profile-icon"></i> <?php echo $toko->email_toko ?>
		 								</li>
		 								<li class="m-top-xs">
		 									<i class="fa fa-external-link user-profile-icon"></i>
		 									<a href="<?php echo $toko->website_toko ?>" target="_blank"> <?php echo $toko->website_toko ?></a>
		 								</li>

		 							</ul>
		 							<br />
		 						</div>
		 						<div class="col-md-9 col-sm-9 col-xs-12">
		 							<div class="profile_title">
		 								<div class="col-md-6">
		 									<h2>Setting Profil Toko</h2>
		 								</div>
		 							</div>
		 							<br>
		 							<form class="form-horizontal" method="post" action="<?php echo base_url('profil/index') ?>" enctype="multipart/form-data">
		 								<div class="form-group">
		 									<input type="hidden" class="form-control has-feedback-left" id="idtoko" name="idtoko" value="<?php echo $toko->id_toko ?>">
		 									<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		 										<input type="text" class="form-control has-feedback-left" id="namatoko" name="namatoko" placeholder="Nama Toko" value="<?php echo $toko->nama_toko ?>" autocomplete="off">
		 										<span class="fa fa-university form-control-feedback left" aria-hidden="true"></span>
		 										<?php echo form_error('namatoko', '<small class="text-danger pl-3">', '</small>'); ?>
		 									</div>
		 									<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		 										<input type="text" class="form-control has-feedback-left" id="alamattoko" name="alamattoko" placeholder="Alamat" value="<?php echo $toko->alamat_toko ?>" autocomplete="off">
		 										<span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
		 										<?php echo form_error('alamattoko', '<small class="text-danger pl-3">', '</small>'); ?>
		 									</div>
		 								</div>
		 								<div class="form-group">
		 									<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		 										<input type="text" class="form-control" id="telp" name="telp" placeholder="Telp" value="<?php echo $toko->telp_toko ?>" autocomplete="off">
		 										<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
		 										<?php echo form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
		 									</div>
		 									<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		 										<input type="text" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php echo $toko->fax_toko ?>" autocomplete="off">
		 										<span class="fa fa-tty form-control-feedback right" aria-hidden="true"></span>
		 										<?php echo form_error('fax', '<small class="text-danger pl-3">', '</small>'); ?>
		 									</div>
		 								</div>
		 								<div class="form-group">
		 									<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		 										<input type="text" class="form-control has-feedback-left" id="email" name="email" placeholder="Email" value="<?php echo $toko->email_toko ?>" autocomplete="off">
		 										<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
		 										<?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
		 									</div>
		 									<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		 										<input type="text" class="form-control has-feedback-left" id="website" name="website" placeholder="Website" value="<?php echo $toko->website_toko ?>" autocomplete="off">
		 										<span class="fa fa-external-link form-control-feedback left" aria-hidden="true"></span>
		 										<?php echo form_error('website', '<small class="text-danger pl-3">', '</small>'); ?>
		 									</div>
		 								</div>
		 								<div class="form-group">
		 									<label class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>
		 									<div class="col-md-9 col-sm-9 col-xs-12">
		 										<input type="file" class="form-control" name="logo" id="logo">
		 									</div>
		 								</div>
		 								<br>
		 								<button type="submit" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</button>
		 							</form>
		 						</div>
		 					</div>
		 				</div>
		 			</div>
		 		</div>
		 	</div>
		 </div>