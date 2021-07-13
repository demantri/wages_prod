        <?php cek_user() ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $title ?></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-7 col-sm-12 col-xs-12">
              <?php echo $this->session->flashdata('message'); ?>
              <div class="x_panel">
                <div class="x_title">
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table width="100%" class="table table-striped table-bordered datatable">
                    <thead>
                      <tr>
                        <th>Kode Item</th>
                        <th>Barcode</th>
                        <th>Nama Item</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($item as $item) { ?>
                        <tr>
                          <td><?php echo $item['kode_barang'] ?></td>
                          <td><?php echo $item['barcode'] ?></td>
                          <td><?php echo $item['nama_barang'] ?></td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs" title="Pilih Data" onclick="pilihbarang('<?php echo $item['id_barang'] ?>')"><i class="fa fa-check"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal" method="post" action="<?php echo base_url('barcode/index') ?>">
                      <div class="form-group">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="kodebrg" id="kodebrg" readonly>
                            <input type="hidden" class="form-control" name="iditem" id="iditem" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">BarcodeID (EAN13)</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="barcode" id="generateBarcode" autocomplete="off">
                            <?php echo form_error('barcode', '<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Item</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="namabarang" id="namabarang" readonly>
                          </div>
                        </div>
                        <div style="float: right">
                          <button type="button" onclick="printBarcode()" class="btn btn-primary"><i class="fa fa-print m-right-xs"></i> Cetak</button>
                          <button type="button" onclick="Generate()" class="btn btn-primary"><i class="fa fa-barcode m-right-xs"></i> view barcode</button>
                          <button type="submit" class="btn btn-warning"><i class="fa fa-barcode m-right-xs"></i> Update Barcode</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>View Barcode EAN13</h4>
                  <div class="view-barcode">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <?php include 'print.php' ?>
        <?php include 'script.php' ?>