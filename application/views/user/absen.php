<div class="lolos-absen" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
<div class="gagal-absen" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
<div class="warning-absen" data-flashdata="<?= $this->session->flashdata('warning'); ?>"></div>
<audio autoplay>
  <source src="<?= base_url('assets11/audio/' . $this->session->flashdata('suara')); ?>" type="audio/mp3">
</audio>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <a title="login" href="<?= base_url('absensiGaji/auth'); ?>">
        <h3 class="text-info float-right"><i class="fas fa-2x fa-power-off"></i></h3>
      </a>
      <h2 class="text-center mt-2 text-blue">SISTEM INFORMASI ABSENSI</h2>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="card card-login p-1 shadow-lg mt-7">
        <div class="card-header bg-info text-center">
          <h2 class="jam-sekarang"></h2>
          <h5 class="tgl-sekarang"></h5>
          <h5 class="mb-0"><i class="fas fa-clock"></i> Masuk <span
              class="text-warning h4"><?= date('H:i', $jamMasuk) ?></span></h5>
          <h5 class="mt-0"><i class="fas fa-clock"></i> Keluar <span
              class="text-warning h4"><?= date('H:i', $jamPulang) ?></span></h5>
        </div>
        <div class="card-body">
          <form action="<?= base_url('absensiGaji/user/absensi') ?>" method="post">

            <?php if ($jamPulang <= time()) : ?>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="masuk" name="option1" class="custom-control-input" value="1">
              <label class="custom-control-label" for="masuk">Masuk</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input checked type="radio" id="pulang" name="option1" class="custom-control-input" value="2">
              <label class="custom-control-label" for="pulang">Pulang</label>
            </div>
            <?php else : ?>
            <div class="custom-control custom-radio custom-control-inline">
              <input checked type="radio" id="masuk" name="option1" class="custom-control-input" value="1">
              <label class="custom-control-label" for="masuk">Masuk</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="pulang" name="option1" class="custom-control-input" value="2">
              <label class="custom-control-label" for="pulang">Pulang</label>
            </div>
            <?php endif; ?>
            <div class="form-group mt-2">
              <input type="text" class="form-control" id="scanBarcode" name="barcode" autocomplete="off" autofocus>
            </div>
          </form>
          <div class="text-center">
            <p>*** Pilih Absen Masuk / Pulang</p>
            <p>Scan Barcode <br> Atau <br> Input NIK / ID</p>
            <small class="text-muted">Tekan F5 Untuk Refresh Halaman</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
      <div class="card card-login p-1 shadow-lg mt-4 id-card">
        <div class="text-center">
          <img width="80px;" src="<?= base_url('assets1/images/logo/bolong.png') ?>" alt="logo">
        </div>

        <div class="card-body">

          <img class="logo-card" src="<?= base_url('assets1/images/logo/' . $user['logo']) ?>" alt="logo">
          <h6>company</h6>



          <div class="text-center mt-3">
            <div class="poto">
              <img src="<?= base_url('assets1/images/user/' . $user['poto']) ?>" alt="img">
              <p class="text-uppercase mt-2"><?= $user['nama'] ?></p>
              <h6>Direktur <br>0812-3456-7890</h6>
            </div>

          </div>
          <div class="id-number text-center">
            <img src="<?= base_url('assets1/images/qr/RM.png') ?>" alt="qr">
            <img class="potoBarcode"
              src="<?= base_url('absensiGaji/user/barcode/?name=ID&codetype=Code128&size=50&print=true&text=1234567891011') ?>"
              alt="barcode">
          </div>
        </div>
        <div class="card-footer bg-info text-center">
          <p>Email : <?= $user['email'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>