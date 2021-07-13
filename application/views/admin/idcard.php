<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Download Barcode</h2>
  </div>
</header>

<div class="berhasil" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
<div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>

<section class="forms no-padding-bottom no-print">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group mt-4">
                  <div class="row">
                    <label class="col-sm-3 form-inline">Pegawai</label>
                    <select class="col-sm-6 form-inline form-control form-control-sm pilih-nama" name="kelamin" id=""
                      required>
                      <option value="">-Pilih Nama-</option>
                      <?php foreach ($karyawan as $row) : ?>
                      <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group mt-3">
                    <p class="ketTampil mb-4">**Pilih Nama Untuk Menampilkan Data</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mt-4 qr-poto2 text-center">
                <h6 class="nama-kar">Nama XXXXXXXXXX</h6>
                <h6 class="idQr">ID : xxxxxxxxxxxxx</h6>
              </div>

              <div class="col-md-6 qr-poto2 text-center">
                <img style="max-width: 200px" class="img-thumbnail potoQr"
                  src="<?= base_url('assets1/images/qr/RM.png') ?>" alt="qr">
                <div>
                  <a href="" class="btn btn-sm btn-success mt-2 tblQr" download="">
                    <i class="fas fa-download"></i> Download qrCode</a>
                </div>
              </div>

              <div class="col-md-6  qr-poto2 text-center">
                <img class="img-thumbnail potoBarcode"
                  src="<?= base_url('absensiGaji/admin/barcode/?name=ID&codetype=Code128&size=50&print=true&text=1234567891011') ?>"
                  alt="barcode">
                <div>
                  <a href="" class="btn btn-sm btn-success mt-2 tblBarcode" download="">
                    <i class="fas fa-download"></i> Download Barcode</a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>



      <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card card-login p-1 shadow-lg id-card">
          <div class="text-center">
            <img width="60px;" src="<?= base_url('assets1/images/logo/bolong.png') ?>" alt="logo">
          </div>

          <div class="card-body">

            <img class="logo-card" src="<?= base_url('assets1/images/logo/' . $user['logo']) ?>" alt="logo">
            <h6>company</h6>



            <div class="text-center mt-1">
              <div class="poto">
                <img class="potKar" src="<?= base_url('assets1/images/user/user.jpg') ?>" alt="">
                <p class="mt-2 nama-kar">Nama XXXXX</p>
                <h4 class="telpKar">08xxxxxxxxx</h4>
              </div>

            </div>
            <div class="id-number text-center">
              <img class="potoQr" src="<?= base_url('assets1/images/qr/RM.png') ?>" alt="qr">
              <img class="potoBarcode"
                src="<?= base_url('absensiGaji/admin/barcode/?name=ID&codetype=Code128&size=50&print=true&text=1234567891011') ?>"
                alt="barcode">
            </div>
          </div>
          <div class="card-footer bg-info text-center">
            <!-- <p class="idQr">ID : xxxxxxxxxxxxx</p> -->
            <p class="card-mail emailKar">Email : alamatxx@email.com</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>






<script>
$('.pilih-nama').change(function() {
  var hasil = $(this).val();
  var url = "<?= base_url('absensiGaji/admin/tampilIdCard'); ?>";
  var dwlQr = "<?= base_url('absensiGaji/admin/downloadQrcode/') ?>" + hasil;
  var urlQr = "<?= base_url('assets1/images/qr/') ?>";
  var dwlBar = "<?= base_url('absensiGaji/admin/downloadBarcode/') ?>" + hasil;
  var urlBar = "<?= base_url('absensiGaji/admin/barcode/?name=ID&codetype=Code128&size=50&print=true&text=') ?>";
  var urlPot = "<?= base_url('assets1/images/user/') ?>";
  if (hasil == '') {
    document.location.href = "<?= base_url('absensiGaji/admin/downBarcode') ?>";
    return false;
  }

  $.ajax({
    url: url,
    type: 'post',
    data: {
      namaId: hasil
    },
    success: function(data) {
      var data_user = $.parseJSON(data);
      $('.idQr').html('ID : ' + data_user.nik);
      $('.nama-kar').html(data_user.nama);
      $('.potoQr').attr('src', urlQr + data_user.qr);
      $('.potoBarcode').attr('src', urlBar + data_user.nik);
      $('.tblQr').attr('href', dwlQr);
      $('.tblBarcode').attr('href', dwlBar);
      $('.potKar').attr('src', urlPot + data_user.poto);
      $('.telpKar').html(data_user.telp);
      $('.emailKar').html('Email : ' + data_user.email);
      $('.tblQr').show();
      $('.tblBarcode').show();
      $('.tblQr2').show();
    }
  });
});
</script>