<!DOCTYPE html>
<html>

<head>

</head>

<body>

  <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Absen_Karyawan$tgl.xls");
    header("pragma: no-cache");
    header("expires: 0");

    ?>


  <div>
    <div style="text-align: center;">
      <h3>Laporan Absen <br><span><?= $tgl; ?></span></h3>
    </div>
    <table style="margin: 20px auto;border-collapse: collapse;border: 0.5px;">
      <tr style="border: 0.5px solid #000;padding: 5px 15px;height: 30px;margin: 20px auto;">
        <th style="border: 0.5px solid #000;">Tanggal</th>
        <th style="border: 0.5px solid #000;">Nik / ID</th>
        <th style="border: 0.5px solid #000;">Nama Karyawan</th>
        <th style="border: 0.5px solid #000;">Email</th>
        <th style="border: 0.5px solid #000;">Telp</th>
        <th style="border: 0.5px solid #000;">Absen Masuk</th>
        <th style="border: 0.5px solid #000;">Absen Pulang</th>
        <th style="border: 0.5px solid #000;">Terlambat Masuk</th>
        <th style="border: 0.5px solid #000;">Status</th>
      </tr>
      <?php foreach ($absen as $data) : ?>
      <?php
                    $userKar = $this->db->get_where('karyawan', ['nik' => $data['nik']])->row_array();
                    ?>
      <tr style="border: 0.5px solid #000;padding: 5px 15px;height: 30px;margin: 20px auto;">
        <td style="border: 0.5px solid #000;padding: 5px 15px;"><?= date('d-M-Y', $data['time']); ?></td>
        <td style="border: 0.5px solid #000;padding: 5px 15px;"><?= $userKar['nik']; ?></td>
        <td style="border: 0.5px solid #000;padding: 5px 15px;"><?= $userKar['nama']; ?></td>
        <td style="border: 0.5px solid #000;padding: 5px 15px;"><?= $userKar['email']; ?></td>
        <td style="border: 0.5px solid #000;padding: 5px 15px;"><?= $userKar['telp']; ?></td>
        <td style="border: 0.5px solid #000;padding: 5px 15px;"><?= date('d-m-Y (H:i:s)', strtotime($data['masuk'])); ?>
        </td>
        <?php if ($data['status'] == 3) : ?>
        <td style="border: 0.5px solid #000;padding: 5px 15px;background-color: red;">
          <span style="padding: 4px;border-radius: 0.35em;font-size: 11px;color: white;">Tidak Masuk Kerja</span>
        </td>
        <?php else : ?>
        <td style="border: 0.5px solid #000;padding: 5px 15px;">
          <?= date('d-m-Y (H:i:s)', strtotime($data['pulang'])); ?>
          <?php endif; ?>
        </td>
        <td style="border: 0.5px solid #000;padding: 5px 15px;"><?= $data['terlambat']; ?> Menit</td>
        <?php if ($data['status'] == 3) : ?>
        <td style="border: 0.5px solid #000;padding: 5px 15px;background-color: red;">
          <span style="padding: 4px;border-radius: 0.35em;font-size: 11px;color: white;">Bolos</span>
        </td>
        <?php elseif ($data['status'] == 2 & $data['terlambat'] > 0) : ?>
        <td style="border: 0.5px solid #000;padding: 5px 15px;background-color: #F6EE03;">
          <span style="padding: 4px;border-radius: 0.35em;font-size: 11px;color: black;">Masuk
            Terlambat</span></td>
        <?php elseif ($data['status'] == 2 & $data['terlambat'] <= 0) : ?>
        <td style="border: 0.5px solid #000;padding: 5px 15px;background-color: green;">
          <span style="padding: 4px;border-radius: 0.35em;font-size: 11px;color: white;">Success
            Absen</span></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>