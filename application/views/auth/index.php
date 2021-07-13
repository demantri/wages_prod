<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <a title="Absensi" href="<?= base_url('absensiGaji/user'); ?>">
        <h3 class="text-info float-right"><i class="fas fa-2x fa-list-alt"></i></h3>
      </a>
      <h2 class="text-center mt-5 text-blue">SISTEM INFORMASI ABSENSI</h2>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="card card-login p-1 shadow-lg mt-7">
        <h4 class="text-center pt-3"><i class="fas fa-user-lock fa-3x"></i></h4>
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="email" placeholder="Email"
                value="<?= set_value('email'); ?>">
              <?= form_error('email', '<small class="text-danger pl-4">', '</small>'); ?>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password">
              <?= form_error('password', '<small class="text-danger pl-4">', '</small>'); ?>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-block mt-4 btn-login">Login</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="berhasil" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
<div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>