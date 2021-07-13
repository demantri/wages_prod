<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Detail Gaji Pegawai</h2>
  </div>
</header>


<section class="tables no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <a href="<?= base_url('absensiGaji/admin/laporanGaji') ?>" class="text-danger"><i class="fas fa-arrow-alt-circle-left"></i>
          Back</a>
        <div class="card">
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?= $karyawan['nik'] ?></td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $karyawan['nama'] ?></td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $karyawan['alamat'] ?></td>
                  </tr>
                  <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?= $karyawan['jabatan'] ?></td>
                  </tr>
                  <tr>
                    <td>Gaji Pokok</td>
                    <td>:</td>
                    <td><?= number_format($karyawan['gaji'],0,',','.') ?></td>
                  </tr>
                  <tr>
                    <td>Jumlah Kehadiran</td>
                    <td>:</td>
                    <td><?= $gaji['durasi'] ?> Hari</td>
                  </tr>
                  <tr>
                    <td>Jumlah Gaji</td>
                    <td>:</td>
                    <td><?= number_format($gaji['jml_gaji'],0,',','.') ?></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                      <?php if ($gaji['status'] == "1") : ?>
                      <span class="badge badge-pill badge-success">Sudah Dibayar</span>
                      <?php else: ?>
                      <span class="badge badge-pill badge-danger">Pending</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <a href="<?= base_url('absensiGaji/admin/slipGaji/'. $gaji['id']) ?>" class="btn btn-sm btn-primary" target="_blank"><i
                class="fas fa-print"></i> Cetak Slip</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>