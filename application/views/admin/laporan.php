<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Laporan Absensi</h2>
  </div>
</header>

<section class="tables no-padding-bottom">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <div> <?php if ($tombol == 1) : ?>
          <a href="<?= base_url('absensiGaji/admin/exExcel') ?>" class="btn btn-sm btn-outline-success float-right"><img
              width="30px;" src="<?= base_url('assets1/images/logo/excel.png') ?>" alt=""> Export</a>
          <?php elseif ($tombol == 2) : ?>
          <a href="<?= base_url('absensiGaji/admin/exExcel1?nik=' . $nik . '&filter=' . $filter) ?>"
            class="btn btn-sm btn-outline-success float-right"><img width="30px;"
              src="<?= base_url('assets1/images/logo/excel.png') ?>" alt=""> Export</a>
          <?php elseif ($tombol == 3) : ?>
          <a href="<?= base_url('absensiGaji/admin/exExcel2?option=' . $option . '&filter=' . $filter) ?>"
            class="btn btn-sm btn-outline-success float-right"><img width="30px;"
              src="<?= base_url('assets1/images/logo/excel.png') ?>" alt=""> Export</a>
          <?php endif; ?>
        </div>


        <button data-toggle="modal" data-target="#modalPerkaryawan" class="btn btn-primary mt-1 to-per"><i
            class="fas fa-user"></i> Data Per Pegawai</button>
        <button data-toggle="modal" data-target="#modalAll" class="btn btn-primary mt-1 to-all"><i
            class="fas fa-users"></i> Data Semua Pegawai</button>
        <a href="<?= base_url('absensiGaji/admin/laporan') ?>" class="btn btn-info mt-1 to-all"><i class="fas fa-calendar-alt"></i>
          Data Absen Bulan Sekarang</a>
      </div>
      <div class="card-body">
        <div class="row">

          <div class="col-md-12">
            <h3 class="mb-4 text-center">Laporan Absensi <br><span
                style="color: red; font-size: 14px;"><?= $tgl; ?></span></h3>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th>Tanggal</th>
                    <th>Nik / ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telp/Hp</th>
                    <th>Waktu Absen Masuk</th>
                    <th>Waktu Absen Pulang</th>
                    <th>Terlambat Masuk</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($absen as $row) : ?>
                  <?php
                      $userKar = $this->db->get_where('karyawan', ['nik' => $row['nik']])->row_array();
                      ?>
                  <tr>
                    <td><?= date('d-M-Y', $row['time']); ?></td>
                    <td><?= $userKar['nik']; ?></td>
                    <td><?= $userKar['nama']; ?></td>
                    <td><?= $userKar['email']; ?></td>
                    <td><?= $userKar['telp']; ?></td>
                    <td><?= date('d-m-Y (H:i:s)', strtotime($row['masuk'])); ?></td>
                    <?php if ($row['status'] == 3) : ?>
                    <td><span class="badge badge-danger badge-pill">Tidak Masuk Kerja</span></td>
                    <?php else : ?>
                    <td><?= date('d-m-Y (H:i:s)', strtotime($row['pulang'])); ?></td>
                    <?php endif; ?>
                    <td><?= $row['terlambat']; ?> Menit</td>
                    <?php if ($row['status'] == 3) : ?>
                    <td><span class="badge badge-danger badge-pill">Bolos</span></td>
                    <?php elseif ($row['status'] == 2 & $row['terlambat'] > 0) : ?>
                    <td><span class="badge badge-warning badge-pill">Masuk Terlambat</span></td>
                    <?php elseif ($row['status'] == 2 & $row['terlambat'] <= 0) : ?>
                    <td><span class="badge badge-success badge-pill">Success Absen</span></td>
                    <?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>



<!-- modal filter perkaryawan -->
<div class="modal fade" id="modalPerkaryawan" tabindex="-1" role="dialog" aria-labelledby="modalPerkaryawanLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPerkaryawanLabel"><i class="fas fa-user"></i> Filter Per Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col fo-all">
            <form action="<?= base_url('absensiGaji/admin/absenPerOrg') ?>" method="post">
              <div class="custom-control custom-radio custom-control-inline">
                <input checked type="radio" id="r-bulan" name="option1" class="custom-control-input" value="1">
                <label class="custom-control-label" for="r-bulan">Perbulan</label>
              </div>
              <div class="form-group">
                <input type="month" name="filter" class="form-control mt-3" required>
              </div>
              <div class="form-group">
                <select class="form-control" name="nik" id="" required>
                  <option value="">-Pilih Nama-</option>
                  <?php foreach ($karyawan as $ab) : ?>
                  <option value="<?= $ab['nik'] ?>"><?= $ab['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- modal filter Semua -->
<div class="modal fade" id="modalAll" tabindex="-1" role="dialog" aria-labelledby="modalAllLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAllLabel"><i class="fas fa-users"></i> Filter Semua Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col fo-all">
            <form action="<?= base_url('absensiGaji/admin/absenPerAll') ?>" method="post">
              <div class="custom-control custom-radio custom-control-inline">
                <input checked onclick="bulan()" type="radio" id="rs-bulan" name="option1" class="custom-control-input"
                  value="1">
                <label class="custom-control-label" for="rs-bulan">Perbulan</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input onclick="hari()" type="radio" id="rs-hari" name="option1" class="custom-control-input" value="2">
                <label class="custom-control-label" for="rs-hari">Perhari</label>
              </div>
              <div class="form-group">
                <input type="month" name="filter" id="input-filter" class="form-control mt-3" required>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
      </div>
      </form>
    </div>
  </div>
</div>



<script>
function bulan() {
  $('#input-filter').attr('type', 'month');
};
</script>
<script>
function hari() {
  $('#input-filter').attr('type', 'date');
};
</script>