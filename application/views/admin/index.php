<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Home</h2>
  </div>
</header>

<section class="tables no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4">
        <a class="btn btn-block" href="<?= base_url('absensiGaji/user'); ?>" target="_blank">
          <div class="card card-home bg-red text-center">
            <div class="card-body">
              <p><i class="fas fa-3x fa-tasks"></i></p>
              <p class="card-text">BUKA ABSENSI</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-block" href="<?= base_url('absensiGaji/admin/karyawan'); ?>">
          <div class="card card-home bg-green text-center">
            <div class="card-body">
              <p><i class="fas fa-3x fa-users"></i></p>
              <p class="card-text">DATA PEGAWAI</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-block" href="<?= base_url('absensiGaji/admin/absen'); ?>">
          <div class="card card-home bg-yellow text-center">
            <div class="card-body">
              <p><i class="fas fa-3x fa-cogs"></i></p>
              <p class="card-text">SETTING ABSENSI</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-block" href="<?= base_url('absensiGaji/admin/laporan'); ?>">
          <div class="card card-home bg-blue text-center">
            <div class="card-body">
              <p><i class="fas fa-3x fa-file-signature"></i></p>
              <p class="card-text">LAPORAN ABSENSI</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-block" href="<?= base_url('absensiGaji/admin/profile'); ?>">
          <div class="card card-home bg-violet text-center">
            <div class="card-body">
              <p><i class="fas fa-3x fa-user-cog"></i></p>
              <p class="card-text">SETTING PROFILE</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-block" href="<?= base_url('absensiGaji/admin/downBarcode'); ?>">
          <div class="card card-home bg-orange text-center">
            <div class="card-body">
              <p><i class="fas fa-3x fa-qrcode"></i></p>
              <p class="card-text">DOWNLOAD BARCODE</p>
            </div>
          </div>
        </a>
      </div>
    </div>

  </div>

</section>