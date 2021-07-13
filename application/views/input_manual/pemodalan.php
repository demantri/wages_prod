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
                        <form action="<?=base_url();?>inputManual/postPemodalan" method="post">
							<div class="row">
								<div class="col-md-3 d-none d-md-block"></div>
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label for="">Tanggal</label>
										<input type="date" name="tgl" class="form-control">
									</div>
									<div class="form-group">
										<label for="">Akun</label>
										<select name="id_akun" class="form-control">
											<option value=""></option>
											<?php foreach($akun->result() as $i) : ?>
												<option value="<?=$i->id;?>"><?=$i->nama_akun;?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="form-group">
										<label for="">Nominal</label>
										<input type="number" name="nominal" class="form-control">
									</div>
									<div class="form-group mb-3">
										<button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
									</div>
								</div>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>