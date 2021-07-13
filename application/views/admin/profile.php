<!-- Page Header-->
<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Setting Profile</h2>
  </div>
</header>

<div class="passWarning" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
<section class="forms no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="row text-center">
                  <div class="col-sm-12">
                    <img class="img-thumbnail poto-profile" data-toggle="modal" data-target="#modalGbr1"
                      title="Ubah-Poto" src="<?= base_url('assets1/images/logo/' . $user['logo']); ?>" alt="logo"
                      width="90px">
                  </div>
                  <div class="col-sm-12 mt-4 text-primary">
                    <h2><?= $user['perusahaan']; ?></h2>
                  </div>
                </div>

                <hr style="border: 2px solid #eaeaea">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-3">
                        <img class="img-thumbnail poto-profile" data-toggle="modal" data-target="#modalGbr"
                          title="Ubah-Poto" src="<?= base_url('assets1/images/user/' . $user['poto']); ?>" alt="image"
                          width="80px">
                      </div>
                      <div class="col-sm-9 mt-2 text-dark">
                        <h2><?= $user['nama']; ?></h2>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-sm-3">
                        <h6>Email : </h6>
                      </div>
                      <div class="col-sm-9">
                        <h6><?= $user['email']; ?></h6>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-sm-3">
                        <h6>Password : </h6>
                      </div>
                      <div class="col-sm-9">
                        <h3>****************</h3>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-sm-3">
                        <p>Level : </p>
                      </div>
                      <div class="col-sm-9">
                        <p>Administrator</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <button data-toggle="modal" data-target="#exampleModalScrollable" class="btn btn-info"><i
                        class="fas fa-user-edit"></i> Edit Profile</button>
                    <p class="mt-5 text-success">**Klik Gambar, Untuk Edit Gambar</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>










<!-- modal gambar1 -->

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
                <img style="max-width: 250px;" class="img-thumbnail imagepreview"
                  src="<?= base_url('assets1/images/user/' . $user['poto']) ?>" id="output" alt="">
              </div>
            </div>
            <?php echo form_open_multipart('absensiGaji/admin/edPotProf/' . $user['id']); ?>
            <div class="form-group">
              <div class="row text-center">
                <input hidden type="file" name="poto" class="col-sm-12 form-control-file btnUploadImage2"
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
        <a href="" class="btn btn-secondary"> Cancel</a>
      </div>
    </div>
  </div>
</div>


<!-- modal gambar2 -->

<div class="modal fade" id="modalGbr1" tabindex="-1" role="dialog" aria-labelledby="modalGbr1Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGbr1Title">Upload Photo</h5>
      </div>
      <section class="forms no-padding-top no-padding-bottom">
        <div class="container-fluid">
          <div class="modal-body">
            <div class="row mb-3 text-center">
              <div class="col-sm-12">
                <img style="max-width: 250px;" class="img-thumbnail imagepreview"
                  src="<?= base_url('assets1/images/logo/' . $user['logo']) ?>" id="output" alt="">
              </div>
            </div>
            <?php echo form_open_multipart('absensiGaji/admin/edLogProf/' . $user['id']); ?>
            <div class="form-group">
              <div class="row text-center">
                <input hidden type="file" name="poto" class="col-sm-12 form-control-file btnUploadImage3"
                  accept="image/*" onchange="readURL(this)">
                <div class="col-sm-12 align-content-center">
                  <button style="max-width: 240px;" type="button"
                    class="btn btn-primary btn-block btnUploadImage1 m-auto"><i class="fas fa-upload"></i>
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
        <a href="" class="btn btn-secondary"> Cancel</a>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"><i class="fas fa-user-edit"></i> Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('absensiGaji/admin/edProfil') ?>" method="post">
          <div class="row px-5">
            <div class="col">
              <div class="form-group">
                <label for="usaha"> Nama Lembaga</label>
                <input class="form-control" type="text" name="usaha" id="usaha" value="<?= $user['perusahaan']; ?>"
                  required>
              </div>
              <div class="form-group">
                <label for="nama"> Nama User</label>
                <input class="form-control" type="text" name="nama" id="nama" value="<?= $user['nama']; ?>" required>
              </div>
              <div class="form-group">
                <label for="email"> Email</label>
                <input class="form-control" type="text" required name="email" id="email" value="<?= $user['email']; ?>">
              </div>
              <div class="form-group">
                <label for="pass"> Password</label>
                <div class="row">
                  <div class="col-sm-8">
                    <input class="form-control" required type="password" name="pass" id="pass"
                      placeholder="Masukan Password Administrator">
                  </div>
                  <div class="col-sm-4">
                    <button type="button" data-toggle="modal" data-target="#edPass"
                      class="btn btn-sm btn-outline-info float-right"> Edit Password</button>
                  </div>
                </div>
              </div>
              <input type="text" name="id" hidden value="<?= $user['id'] ?>">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i> Update</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="edPass" tabindex="-1" role="dialog" aria-labelledby="edPassTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edPassTitle"><i class="fas fa-key"></i> Edit Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('absensiGaji/admin/editPass') ?>" method="post">
          <div class="row px-5">
            <div class="col">
              <div class="form-group">
                <label for="password1"> Password Sekarang</label>
                <input class="form-control" type="password" name="password1" id="password1" required>
              </div>
              <div class="form-group">
                <label for="password2"> Password Baru</label>
                <input class="form-control" type="password" minlength="8" name="password2" id="password2" required>
              </div>
              <div class="form-group">
                <label for="password3"> Ulangi Password Baru</label>
                <input class="form-control" type="password" name="password3" id="password3" required>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-sm">Ubah Password</button>
      </div>
      </form>
    </div>
  </div>
</div>