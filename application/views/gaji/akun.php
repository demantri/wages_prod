<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Data Akun</h2>
  </div>
</header>


<section class="tables no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <form action="<?= base_url('admin/saveAkun') ?>" method="post" class="formDtaAkun">
              <div class="input-group">
                <input type="text" name="kode" class="form-control-sm form-control" placeholder="Kode Akun" required
                  autocomplete="off">
                <input type="text" name="nama" class="form-control-sm form-control" placeholder="Nama Akun" required
                  autocomplete="off">
                <input type="text" name="head" class="form-control-sm form-control" placeholder="Header Akun" required
                  autocomplete="off">
                <select name="dc" class="form-control form-control-sm" required>
                  <option value="Debit">Debit</option>
                  <option value="Kredit">Kredit</option>
                </select>
                <div class="input-group-append">
                  <button class="btn btn-sm btn-danger submit">Save</button>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="dataTable">
                <thead class="thead-light">
                  <tr>
                    <th>Kode Akun</th>
                    <th>Nama Akun</th>
                    <th>Header</th>
                    <th>Debit/Kredit</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($akun as $data) : ?>
                  <tr>
                    <td><?= $data['kode']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td>
                      <?= $data['header'] ?>
                    </td>
                    <td><?= $data['dc'] ?></td>
                    <td>
                      <!-- <div class="btn-group"> -->
                      <a href="<?= base_url('admin/editAkun/' . $data['id']) ?>" data-kode="<?= $data['kode']; ?>"
                        data-nama="<?= $data['nama']; ?>" data-head="<?= $data['header']; ?>"
                        data-dc="<?= $data['dc']; ?>" class="btnEditAkun"><i class="fas fa-edit fa-fw"></i>Edit</a>
                      <a href="<?= base_url('admin/delAkun/' . $data['id']) ?>" class="t-hapus text-danger"><i
                          class="fas fa-trash-alt fa-fw"></i>Delete</a>
                      <!-- </div> -->
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