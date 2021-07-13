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
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="dataTable">
                <thead class="thead-light">
                  <tr>
                    <th>NIK/ID</th>
                    <th>Nama</th>
                    <th style="width: 150px;">Jabatan</th>
                    <th style="width: 150px;">Gaji/Hari</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($karyawan as $data) : ?>
                  <tr>
                    <td><?= $data['nik']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td style="width: 150px;">
                      <input type="text" name="jabatan" data-id="<?= $data['id'] ?>" value="<?= $data['jabatan'] ?>"
                        class="border input-jabatan">
                    </td>
                    <td style="width: 150px;">
                      <input type="text" name="gaji" data-id="<?= $data['id'] ?>" value="<?= $data['gaji'] ?>"
                        class="border input-rupiah">
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
$(".input-rupiah").change(function() {
  var isi = $(this).val();
  var isi = isi.replace(/[.-]/g, "");
  var isi = Number(isi);
  var id = $(this).data('id');
  if (isi <= 0) {
    isi = 0;
  }
  $.ajax({
    url: "<?= base_url('absensiGaji/admin/setGaji/')?>" + id,
    type: "POST",
    data: {
      isi: isi
    },
    success: function(respon) {
      $(this).val(isi);
    }
  });
});
$(".input-jabatan").change(function() {
  var isi = $(this).val();
  var id = $(this).data('id');
  if (isi == "") {
    isi = "Karyawan";
  }
  $.ajax({
    url: "<?= base_url('absensiGaji/admin/setJabat/')?>" + id,
    type: "POST",
    data: {
      isi: isi
    },
    success: function(respon) {
      $(this).val(isi);
    }
  });
});
$(".table tr td input").keydown(function(e) {
  if (e.keyCode == 13) {
    alert("Tekan Tab pada keyboard");
  }
});
</script>