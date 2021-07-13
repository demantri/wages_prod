<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Input Gaji</h2>
  </div>
</header>


<section class="tables no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <form action="<?= base_url('absensiGaji/admin/addGajian') ?>" method="post">
              <div class="input-group">
                <select name="nama" class="select2 form-control form-control-sm" required>
                  <option value="">-=Cari Nama Pegawai=-</option>
                  <?php foreach($karyawan as $key) : ?>
                  <option value="<?= $key['nik'] ?>"><?= $key['nama'] ?></option>
                  <?php endforeach; ?>
                </select>

                <input type="text" name="tglDari" class="form-control-sm form-control tgl" required
                  placeholder="Dari Tanggal">
                <input type="text" name="tglSampai" class="form-control-sm form-control tgl" required
                  placeholder="Sampai Tanggal">
                <input type="text" name="tglBayar" class="form-control-sm form-control tgl" required
                  placeholder="Tanggal Gajian">

                <div class="input-group-append">
                  <button class="btn btn-sm btn-primary">Add Data</button>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="dataTable">
                <thead class="thead-light">
                  <tr>
                    <th>Tgl Bayar</th>
                    <th>NIK/ID</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th style="width: 150px;">Dari Tgl</th>
                    <th style="width: 150px;">Sampai Tgl</th>
                    <th>Kehadiran</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($gaji as $data) : ?>
                  <?php 
                      $kar = $this->db->get_where('karyawan', ['nik' => $data['nik']])->row_array();
                      ?>
                  <tr>
                    <td><?= date('d M Y', strtotime($data['tgl'])); ?></td>
                    <td><?= $data['nik']; ?> <a href="<?= base_url('absensiGaji/admin/delDataGaji/' . $data['id']) ?>"
                        class="text-danger float-right t-hapus"><i class="fas fa-trash-alt"></i></a></td>
                    <td><?= $kar['nama']; ?></td>
                    <td>
                      <?= $kar['jabatan'] ?>
                    </td>
                    <td style="width: 150px;">
                      <input type="date" name="dari" data-to="<?= $data['sampai'] ?>" data-id="<?= $data['id'] ?>"
                        value="<?= $data['dari'] ?>" class="border tglDari">
                    </td>
                    <td style="width: 150px;">
                      <input type="date" name="sampai" data-from="<?= $data['dari'] ?>" data-id="<?= $data['id'] ?>"
                        value="<?= $data['sampai'] ?>" class="border tglSampai">
                    </td>
                    <td><?= $data['durasi'] ?> Hari</td>
                    <td>
                      <?php if ($data['status'] == '1') : ?>
                      <span class="badge badge-success badge-pill">Sudah Digaji</span>
                      <?php else: ?>
                      <span class="badge badge-danger badge-pill">Pending</span>
                      <?php endif; ?>

                      <a href="<?= base_url('absensiGaji/admin/setStatusGaji/' . $data['id']) ?>" class="float-right"
                        data-toggle="tooltip" data-placement="left" title="Tandai Status"><i
                          class="fas fa-check-circle"></i></a>
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






<script>
$("input.tglSampai").change(function() {
  var isi = $(this).val();
  var id = $(this).data('id');
  var tgl = $(this).data('from');
  if (isi == "") {
    alert('set Tanggal');
    return false;
  }
  $.ajax({
    url: "<?= base_url('absensiGaji/admin/setRentangWaktu/')?>" + id,
    type: "POST",
    data: {
      to: isi,
      from: tgl
    },
    success: function(respon) {
      if (respon == "no") {
        alert('Set Tanggal dengan benar / Minimal kurang dari hari ini');
      }
      document.location.reload();
    }
  });
});

$('input.tglDari').change(function() {
  var isi = $(this).val();
  var id = $(this).data('id');
  var tgl = $(this).data('to');
  if (isi == "") {
    alert('set Tanggal');
    return false;
  }
  $.ajax({
    url: "<?= base_url('absensiGaji/admin/setRentangWaktu/')?>" + id,
    type: "POST",
    data: {
      from: isi,
      to: tgl
    },
    success: function(respon) {
      if (respon == "no") {
        alert('Set Tanggal dengan benar / Minimal kurang dari hari ini');
      }
      document.location.reload();
    }
  });
});


$('input.tgl').focusin(function() {
  $(this).attr('type', 'date');
});
$('input.tgl').focusout(function() {
  $(this).attr('type', 'text');
});
</script>