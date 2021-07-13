<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Setting Absensi</h2>
  </div>
</header>

<section class="forms no-padding-bottom">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-8">
                <div class="card mb-3 p-2 bg-primary" style="max-width: 540px;">
                  <div class="row no-gutters">
                    <div class="col-md-4 p-1 text-blue">
                      <span><i class="fas fa-6x fa-stopwatch"></i></span>
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h3>Jam Masuk</h3>
                        <h1 class="jam"><?= $waktu['masuk'] . ':' . $waktu['m_masuk'] ?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="card mb-3 p-2 bg-info" style="max-width: 540px;">
                  <div class="row no-gutters">
                    <div class="col-md-4 p-1 text-blue">
                      <span><i class="fas fa-6x fa-stopwatch"></i></span>
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h3>Jam Pulang</h3>
                        <h1 class="jam"><?= $waktu['pulang'] . ':' . $waktu['m_pulang'] ?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="card mb-2 bg-warning text-danger" style="max-width: 540px;">
                  <div class="card-body">
                    <h6>Toleransi Keterlambatan <span class="minit"><?= $waktu['toleransi']; ?> Menit</span></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <form action="<?= base_url('absensiGaji/admin/waktuAbsen') ?>" method="post">
              <div class="row mb-4">
                <div class="col">
                  <label for="jamaMasuk"><b>Jam Masuk</b></label>
                  <div class="form-row">
                    <div class="col-sm-4">
                      <select class="form-control" name="jamMasuk" required>
                        <?php if ($waktu['masuk'] == $waktu['masuk']) : ?>
                        <option value="<?= $waktu['masuk'] ?>"><?= $waktu['masuk'] ?></option>
                        <?php endif; ?>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                      </select>
                      <small>Jam</small>
                    </div>
                    <div class="col-sm-4">
                      <select class="form-control" name="menitMasuk" required>
                        <?php if ($waktu['m_masuk'] == $waktu['m_masuk']) : ?>
                        <option value="<?= $waktu['m_masuk'] ?>"><?= $waktu['m_masuk'] ?></option>
                        <?php endif; ?>
                        <option value="00">00</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                        <option value="35">35</option>
                        <option value="40">40</option>
                        <option value="45">45</option>
                        <option value="50">50</option>
                        <option value="55">55</option>
                      </select>
                      <small>Menit</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col">
                  <label for="jamaMasuk"><b>Jam Pulang</b></label>
                  <div class="form-row">
                    <div class="col-sm-4">
                      <select class="form-control" name="jamPulang" required>
                        <?php if ($waktu['pulang'] == $waktu['pulang']) : ?>
                        <option value="<?= $waktu['pulang'] ?>"><?= $waktu['pulang'] ?></option>
                        <?php endif; ?>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                      </select>
                      <small>Jam</small>
                    </div>
                    <div class="col-sm-4">
                      <select class="form-control" name="menitPulang" required>
                        <?php if ($waktu['m_pulang'] == $waktu['m_pulang']) : ?>
                        <option value="<?= $waktu['m_pulang'] ?>"><?= $waktu['m_pulang'] ?></option>
                        <?php endif; ?>
                        <option value="00">00</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                        <option value="35">35</option>
                        <option value="40">40</option>
                        <option value="45">45</option>
                        <option value="50">50</option>
                        <option value="55">55</option>
                      </select>
                      <small>Menit</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label for="jamaMasuk"><b>Toleransi Keterlambatan</b></label>
                  <div class="form-row">
                    <div class="col-sm-5">
                      <select class="form-control" name="toleransi" required>
                        <?php if ($waktu['toleransi'] == $waktu['toleransi']) : ?>
                        <option selected value="<?= $waktu['toleransi'] ?>"><?= $waktu['toleransi'] ?></option>
                        <option value="00">00</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60 (1 jam)</option>
                        <option value="75">75 (1 jam 15 menit)</option>
                        <option value="90">90 (1 jam 30 menit)</option>
                        <option value="105">105 (1 jam 45 menit)</option>
                        <option value="120">120 (2 jam)</option>
                        <?php endif; ?>
                      </select>
                      <small>Dalam menit</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col">
                  <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Simpan Pengaturan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div>
          <small>Jika absen lebih dari jam masuk dan kurang dari waktu toleransi, tetap masuk kerja, tapi tercatat waktu
            terlambat</small>
        </div>
        <div>
          <small>Jika absen lebih dari waktu toleransi, Dianggap Bolos / Tidak masuk kerja</small>
        </div>
      </div>
    </div>
  </div>

</section>