        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"> <span>Wages Production</span></a>
            </div>
            <div class="clearfix"></div>
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url('assets/production/') ?>images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $user['nama_lengkap'] ?></h2>
              </div>
            </div>
            <br />
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <?php if ($user['tipe'] == "Administrator") { ?>
                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
                      </ul>
                    </li>
                  <?php } ?>
                  <li><a><i class="fa fa-shopping-cart"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('penjualan') ?>">Entry Penjualan</a></li>
                      <li><a href="<?php echo base_url('dpenjualan') ?>">Daftar Penjualan</a></li>

                      <li><a href="<?php echo base_url('stok') ?>">Stok Masuk</a></li>
                    </ul>
                  </li>
                  <?php if ($user['tipe'] == "Administrator") { ?>
                    <li><a><i class="fa fa-desktop"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('akun') ?>">Data Akun</a></li>
                        <li><a href="<?php echo base_url('barang') ?>">Data Barang</a></li>
                        <li><a href="<?php echo base_url('kategori') ?>">Data Kategori</a></li>
                        <li><a href="<?php echo base_url('satuan') ?>">Data Satuan</a></li>
                        <li><a href="<?php echo base_url('customer') ?>">Data Customer</a></li>
                        <li><a href="<?php echo base_url('user') ?>">Data User</a></li>
                        
                      </ul>
                    </li>
                    
                    <li><a><i class="fa fa-file-text-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('laporan/bukuBesar') ?>">Buku Besar</a></li>
                        <li><a href="<?php echo base_url('laporan/jurnalUmum') ?>">Jurnal Umum</a></li>
                        <li><a href="<?php echo base_url('laporan/kartuStok') ?>">Kartu Stok</a></li>
                        <li><a href="<?php echo base_url('laporan/barang') ?>">Laporan Barang</a></li>
                        <li><a href="<?php echo base_url('laporan/penjualan') ?>">Laporan Penjualan</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-magic"></i> Tools <span class="fa fa-chevron-down"></span></a>

                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('barcode') ?>">Generate Barcode</a></li>
                      </ul>
                    </li>
                    <li><a><i class="fa fa-gears"></i> Setting <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('profil') ?>">Profil Toko</a></li>
                      </ul>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>