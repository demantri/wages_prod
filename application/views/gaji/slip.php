<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="<?= base_url('assets/images/logo/' . $user['logo']); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/page2.css') ?>">
  <title>Pint Struk</title>
</head>

<body>
  <div style="text-align: center;margin-top: 20px">
    <button class="btnPrint">Print</button>
    <span class="labelPage">Size A4</span>
  </div>
  <div class="page">
    <div class="row">
      <div class="col-12">
        <h5 style="text-align: center;">WAGES PRODUCTION</h5>
        <h6 style="text-align: center;margin-top: -20px;">JAKARTA</h6>
        <div>Slip Gaji</div>
        <table class="table">
          <tr>
            <td>NIK</td>
            <td><?= $karyawan['nik'] ?></td>
            <td>Alamat</td>
            <td><?= $karyawan['alamat'] ?></td>
            <td>Tanggal</td>
            <td><?= date('d/m/Y', strtotime($gaji['tgl'])) ?></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td><?= $karyawan['nama'] ?></td>
            <td>Jabatan</td>
            <td colspan="3"><?= $karyawan['jabatan'] ?></td>
          </tr>
        </table>
      </div>

      <div style="margin-top: 30px;" class="col-12">
        <table class="table">
          <tr>
            <th class="border">No</th>
            <th class="border">Keterangan</th>
            <th class="border">Jumlah</th>
          </tr>
          <tr>
            <td style="text-align: center;" class="border">1</td>
            <td class="border">Gaji Pokok</td>
            <td style="text-align: right;" class="border"><?= number_format($karyawan['gaji'],0,',','.') ?></td>
          </tr>
          <tr>
            <td style="text-align: center;" class="border">2</td>
            <td class="border">Jumlah Kehadiran</td>
            <td style="text-align: right;" class="border"><?= $gaji['durasi'] ?></td>
          </tr>
          <tr>
            <td style="text-align: center;" colspan="2" class="border">Total Diterima</td>
            <td style="text-align: right;" class="border"><?= number_format($karyawan['gaji'],0,',','.') ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>


  <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

  <script>
  $('.btnPrint').click(function() {
    window.print();
    window.close();
  });

  document.addEventListener("keydown", function(e) {
    e.preventDefault();
    if (e.shiftKey) {
      if (e.which == 17) {
        window.print();
        window.close();
      }
    }
  });
  </script>
</body>

</html>