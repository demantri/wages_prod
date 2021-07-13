<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Data Gaji</h2>
  </div>
</header>


<section class="tables no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <!-- <div class="card-header">
            <form action="" method="post">
              <div class="input-group">

                <input type="text" name="tglDari" class="form-control-sm form-control">
              </div>
            </form>
          </div> -->
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="dataTable">
                <thead class="thead-light">
                  <tr>
                    <th>Tgl Bayar</th>
                    <th>NIK/ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Kehadiran</th>
                    <th>Jml Gaji</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($gaji as $data) : ?>
                  <?php 
                      $kar = $this->db->get_where('karyawan', ['nik' => $data['nik']])->row_array();
                      ?>
                  <tr>
                    <td><?= date('d M Y', strtotime($data['tgl'])); ?></td>
                    <td><?= $data['nik']; ?></td>
                    <td><?= $kar['nama']; ?></td>
                    <td>
                      <?= $kar['jabatan'] ?>
                    </td>
                    <td><?= number_format($kar['gaji'],0,',','.') ?></td>
                    <td><?= $data['durasi'] ?> Hari</td>
                    <td><?= number_format($data['jml_gaji'],0,',','.') ?></td>
                    <td>
                      <?php if ($data['status'] == '1') : ?>
                      <span class="badge badge-success badge-pill">Sudah Digaji</span>
                      <?php else: ?>
                      <span class="badge badge-danger badge-pill">Pending</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?= base_url('absensiGaji/admin/detailGaji/'. $data['id']) ?>" class="text-info"><i
                          class="fas fa-eye"></i> Detail</a>
                      <a href="<?= base_url('absensiGaji/admin/slipGaji/'. $data['id']) ?>" target="_blank" class="text-dark"><i
                          class="fas fa-print"></i> Slip</a>
                    </td>
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