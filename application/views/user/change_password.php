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
      <div class="col-md-6 col-sm-12 col-xs-12">
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
            <?php echo $this->session->flashdata('message') ?>
            <form class="form-horizontal" method="post" action="<?php echo base_url('user/change_password') ?>">

              <div class="form-group">
                <label class="">Password Lama</label>
                <input type="password" class="form-control" name="password_lama" id="password_lama">
                <?php echo form_error('password_lama', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label class="">Password Baru</label>
                <input type="password" class="form-control" name="password_baru" id="password_baru">
                <?php echo form_error('password_baru', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label class="">Konfirmasi Password</label>
                <input type="password" class="form-control" name="konfirmasi_pass" id="konfirmasi_pass" autocomplete="off">
                <?php echo form_error('konfirmasi_pass', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div style="text-align: right">
                <button type="reset" class="btn btn-danger"><i class="fa fa-recycle m-right-xs"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o m-right-xs"></i> Change Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>