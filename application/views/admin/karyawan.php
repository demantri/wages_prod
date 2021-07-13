<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Data Karyawan</h2>
  </div>
</header>


<section class="tables no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah"><i
                class="fas fa-user-plus"></i> Tambah Data</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable">
                <thead class="thead-light">
                  <tr>
                    <th>Image</th>
                    <th>NIK/ID</th>
                    <th>Nama</th>
                    <th>J.Kelamin</th>
                    <th style="max-width: 150px;">Alamat</th>
                    <th>Email</th>
                    <th>Telp/Hp</th>
                    <th style="width: 70px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($karyawan as $data) : ?>
                  <tr>
                    <td><img class="poto-profile btnImgEditPotoProfile" data-poto="<?= $data['poto']; ?>"
                        data-id="<?= $data['id']; ?>" data-toggle1="tooltip" data-placement="top" title="Ubah Poto"
                        src="<?= base_url('assets1/images/user/' . $data['poto']) ?>" alt="poto" width="40px;">
                    </td>
                    <td><?= $data['nik']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['kelamin']; ?></td>
                    <td><?= $data['alamat']; ?></td>
                    <td><?= $data['email']; ?></td>
                    <td><?= $data['telp']; ?></td>
                    <td>
                      <div class="btn-group">

                        <button class="btn btn-primary btn-sm btnEditDataKaryawan" data-id="<?= $data['id']; ?>"
                          data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>
                        <a href="<?= base_url('absensiGaji/admin/delKaryawan/' . $data['id']); ?>"
                          class="btn btn-danger btn-sm t-hapus" data-toggle1="tooltip" data-placement="top"
                          title="Hapus"><i class="fas fa-trash-alt"></i></a>

                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <small class="text-muted pl-4">Klik Image untuk ubah poto</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- modal -->

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahTitle">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
      </div>
      <section class="forms no-padding-top no-padding-bottom">
        <div class="container-fluid">
          <div class="modal-body">
            <?php echo form_open_multipart('absensiGaji/admin/addKaryawan'); ?>
            <div class="form-group">
              <div class="row">
                <label class="label col-sm-3 form-inline" for="nik">NIK / ID</label>
                <input class="col-sm-9 form-inline form-control form-control-sm" type="text" name="nik" id="nik"
                  value="<?= $no_nik; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 form-inline" for="nama">Nama</label>
                <input class="col-sm-9 form-inline form-control form-control-sm" type="text" name="nama" id="nama"
                  required>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 form-inline" for="email">Email</label>
                <input class="col-sm-9 form-inline form-control form-control-sm" type="email" name="email" id="email"
                  required>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 form-inline" for="telp">Telp/Hp</label>
                <input class="col-sm-9 form-inline form-control form-control-sm input-telp" type="text" name="telp"
                  id="telp" required>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3 form-inline" for="kelamin">J.Kelamin</label>
                <select class="col-sm-9 form-inline form-control form-control-sm" name="kelamin" id="kelamin" required>
                  <option value="">-Pilih J.Kelamin-</option>
                  <option value="Pria">Pria</option>
                  <option value="Wanita">Wanita</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-sm-3" for="alamat">Alamat</label>
                <textarea class="col-sm-9 form-inline form-control form-control-sm" name="alamat" id="alamat" rows="3"
                  required></textarea>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- modal Upload Gbr -->
<div class="modal fade" id="modalGbr" tabindex="-1" role="dialog" aria-labelledby="modalGbrTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGbrTitle">Upload Photo</h5>
      </div>
      <section class="forms no-padding-top no-padding-bottom">
        <div class="container-fluid">
          <div class="modal-body">
            <div class="row mb-3 text-center">
              <div class="col-sm-12">
                <img style="max-width: 250px;" class="img-thumbnail imagepreview" src="" id="output" alt="">
              </div>
            </div>
            <form class="hrefEditPoto" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <div class="row text-center">
                  <input type="file" hidden name="poto" required class="form-control-file btnUploadImage2"
                    accept="image/*" onchange="readURL(this)">
                  <div class="col-sm-12 align-content-center">
                    <button style="max-width: 240px;" type="button"
                      class="btn btn-primary btn-block btnUploadImage m-auto"><i class="fas fa-upload"></i>
                      Upload
                      Gambar</button>
                    <button type="submit" class="btn btn-outline-primary mt-3"><i class="fas fa-save"></i>
                      Simpan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary"> Cancel</button>
      </div>
    </div>
  </div>
</div>




<!-- modal edit -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaleditTitle">Ubah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
      </div>
      <section class="forms no-padding-top no-padding-bottom">
        <div class="container-fluid">
          <div class="modal-body">
            <form class="linkHrefEditData" action="" method="post">
              <div class="form-group">
                <div class="row">
                  <label class="label col-sm-3 form-inline" for="nik">NIK/ID</label>
                  <input class="col-sm-9 form-inline form-control form-control-sm" type="text" name="nik" id="nik"
                    value="" readonly>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 form-inline" for="nama">Nama</label>
                  <input class="col-sm-9 form-inline form-control form-control-sm" type="text" name="nama" id="nama"
                    value="" required>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 form-inline" for="email">Email</label>
                  <input class="col-sm-9 form-inline form-control form-control-sm" type="email" name="email" id="email"
                    value="" required>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 form-inline" for="telp">Telp/Hp</label>
                  <input class="col-sm-9 form-inline form-control form-control-sm input-telp" type="text" name="telp"
                    id="telp" value="" required>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3 form-inline" for="kelamin">J.Kelamin</label>
                  <select class="col-sm-9 form-inline form-control form-control-sm" name="kelamin" id="kelamin"
                    required>
                    <option value="Wanita">Wanita</option>
                    <option value="Pria">Pria</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-3" for="alamat">Alamat/Hp</label>
                  <textarea class="col-sm-9 form-inline form-control form-control-sm" name="alamat" id="alamat" rows="4"
                    required></textarea>
                </div>
              </div>
          </div>
        </div>
      </section>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>






<script type="text/javascript">
$('.btnImgEditPotoProfile').click(function() {
  var id = $(this).data('id');
  var poto = $(this).data('poto');
  var src = "<?= base_url('assets1/images/user/') ?>" + poto;
  var href = "<?= base_url('absensiGaji/admin/edpoto/') ?>" + id;
  var linkHref = $('.hrefEditPoto');
  var mdl = $('#modalGbr');
  mdl.modal('show');
  $('.imagepreview').attr('src', src);
  linkHref.attr('action', href);
});

$('.btnEditDataKaryawan').click(function() {
  var id = $(this).data('id');
  var href = "<?= base_url('absensiGaji/admin/edKaryawan/') ?>" + id;
  var mdl = $('#modaledit');
  mdl.modal('show');
  $('.linkHrefEditData').attr('action', href);
  $.ajax({
    type: "post",
    url: "<?= base_url('absensiGaji/admin/cekDataKaryaWan') ?>",
    dataType: "json",
    data: {
      id: id
    },
    cache: false,
    success: function(response) {
      $('[name="nik"]').val(response.nik);
      $('[name="nama"]').val(response.nama);
      $('[name="email"]').val(response.email);
      $('[name="telp"]').val(response.telp);
      if (response.kelamin == 'Wanita') {
        $('option[value="Wanita"]').attr('selected', 'selected');
      } else {
        if (response.kelamin == 'Pria') {
          $('option[value="Pria"]').attr('selected', 'selected');
        }
      }
      $('[name="alamat"]').html(response.alamat);
    }
  });
});
</script>