		<?php cek_user() ?>
		<div class="right_col" role="main">
			<div class="">
				<div class="page-title">
					<div class="title_left">
						<h3><?php echo $title ?></h3>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
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
								<form class="form-horizontal" method="post" action="<?php echo base_url('barang/editbarang') ?>">
									<div class="form-group">
										<input type="hidden" class="form-control" id="iditem" name="iditem" value="<?php echo $item['id_barang'] ?>">
										<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
											<label for="">BarcodeID :</label>
											<input type="text" class="form-control" name="barcode" value="<?php echo $item['barcode'] ?>" autocomplete="off" required />
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
											<label for="">Nama Item :</label>
											<input type="text" id="namabarang" class="form-control" name="namabarang" value="<?php echo $item['nama_barang'] ?>" autocomplete="off" required />
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-3 col-sm-6 col-xs-12">
											<label for="">Harga Jual (Umum) :</label>
											<input type="number" id="jual" class="form-control" name="jual" value="<?php echo $item['harga_jual'] ?>" autocomplete="off" required />
										</div>
										<div class="col-md-3 col-sm-6 col-xs-12">
											<label for="">Harga Sales :</label>
											<input type="number" id="sales" class="form-control" name="sales" value="<?php echo $item['harga_sales'] ?>" autocomplete="off" required />
										</div>
										<div class="col-md-3 col-sm-6 col-xs-12">
										<label for="">Kategori :</label>
											<select id="kategori" name="kategori" class="form-control select2" required>
												<option value="">- Pilih -</option>
												<?php foreach ($kategori as $kategori) : ?>
													<?php if ($kategori['id_kategori'] == $item['id_kategori']) : ?>
														<option value="<?php echo $kategori['id_kategori'] ?>" selected><?php echo $kategori['kategori'] ?></option>
													<?php else : ?>
														<option value="<?php echo $kategori['id_kategori'] ?>"><?php echo $kategori['kategori'] ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-3 col-sm-6 col-xs-12">
										<label for="">Satuan :</label>
											<select id="satuan" name="satuan" class="form-control select2" required>
												<?php foreach ($satuan as $satuan) : ?>
													<?php if ($satuan['id_satuan'] == $item['id_satuan']) : ?>
														<option value="<?php echo $satuan['id_satuan'] ?>" selected><?php echo $satuan['satuan'] ?></option>
													<?php else : ?>
														<option value="<?php echo $satuan['id_satuan'] ?>"><?php echo $satuan['satuan'] ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Edit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include 'script.php' ?>