<?php $page = $judul; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Bootstrap CSS-->
  <link href="<?= base_url('assets1/css/bootstrap.min.css') ?>" rel="stylesheet">
  <!-- Font Awesome CSS-->
  <link href="<?= base_url('assets1/font-awesome/css/all.min.css') ?>" rel="stylesheet">
  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="<?= base_url('assets1/css/fontastic.css') ?>">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="<?= base_url('assets1/css/style.sea.css') ?>" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?= base_url('assets1/css/custom.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets1/select2/css/select2.min.css') ?>">
  <!-- Favicon-->
  <link rel="shortcut icon" href="<?= base_url('assets1/images/logo/' . $user['logo']); ?>">
  <script type="text/javascript" src="<?= base_url('assets1/js/jquery.min.js'); ?> "></script>


</head>
<?php
$jmlAbsenKarMasuk = $this->Absen_model->jmlKaryawanMasuk();
$jmlAbsenKarBolos = $this->Absen_model->jmlKaryawanBolos();
?>

<body>
  <div class="page">
    <!-- Main Navbar-->
    <header class="header">
      <nav class="navbar bg-info">

        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Navbar Header-->
            <div class="navbar-header">
              <!-- Navbar Brand -->
              <a href="" class="navbar-brand d-none d-sm-inline-block">
                <div class="brand-text d-none d-lg-inline-block"><span>SINFO</span><strong>Absensi</strong></div>
              </a>
              <!-- Toggle Button-->
              <a id="toggle-btn" href="#"><span><i class="fas fa-bars"></i></span><span> <span> </span></span> </a>
              <h3 class="brand-text d-none d-lg-inline-block text-right pl-5 text-dark"><?= $user['perusahaan']; ?></h3>
              <h3 class="brand-text d-none d-lg-inline-block text-right pl-5 text-dark jam-sekarang"></h3>
              <span class="brand-text d-none d-lg-inline-block text-right tgl-sekarang"></span>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Notifications-->
              <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i
                    class="fas fa-bell"></i>
                  <?php if ($jmlAbsenKarBolos <= 0) : ?>
                  <span class="badge bg-red badge-corner"></span>
                  <?php else : ?>
                  <span class="badge bg-red badge-corner"><?= $jmlAbsenKarBolos ?></span>
                  <?php endif; ?>
                </a>
                <ul aria-labelledby="notifications" class="dropdown-menu">

                  <?php if ($jmlAbsenKarMasuk <= 0) : ?>
                  <?php else : ?>
                  <li><a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification">
                        <div class="notification-content"><i class="fa fa-user-plus bg-green"></i>
                          <?= $jmlAbsenKarMasuk ?> Pegawai Masuk
                        </div>
                      </div>
                    </a></li>
                  <?php endif; ?>

                  <?php if ($jmlAbsenKarBolos <= 0) : ?>
                  <?php else : ?>
                  <li><a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification">
                        <div class="notification-content"><i class="fa fa-user-slash bg-danger"></i>
                          <?= $jmlAbsenKarBolos ?> Pegawai Bolos
                        </div>
                      </div>
                    </a></li>
                  <?php endif; ?>

                  <!-- <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all
                        notifications </strong></a></li> -->
                </ul>
              </li>

              <!-- Logout    -->
              <li class="nav-item"><a href="<?= base_url('absensiGaji/auth/logout') ?>" class="nav-link logout t-logout"> <span
                    class="d-none d-sm-inline">Logout</span><i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
      <!-- Side Navbar -->
      <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="<?= base_url('assets1/images/user/' . $user['poto']) ?>" alt="profile"
              class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h4"><?= $user['nama']; ?></h1>
            <p>Administrator</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <span class="heading">Main</span>
        <ul class="list-unstyled">
          <li class="<?php if ($page == 'Admin') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin'); ?>"><i class="fas fa-home"></i>Home</a></li>
          <li class="<?php if ($page == 'Data Karyawan') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/karyawan'); ?>"><i class="fas fa-users"></i></i>Data
              Pegawai</a></li>
          <li class="<?php if ($page == 'Gaji Karyawan') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/gajikaryawan'); ?>"><i class="fas fa-money-check"></i></i>Gaji
              Pegawai</a></li>
          <li class="<?php if ($page == 'Input Gaji') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/inputGaji'); ?>"><i
                class="fas fa-file-invoice-dollar"></i></i>Input Gaji</a></li>
          <!-- <li class="<?php if ($page == 'Data Akun') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/dataAkun'); ?>"><i class="fas fa-calculator"></i></i>Data
              Akun</a></li> -->
					<li class="<?php if ($page == 'Data Akun') {
										echo 'active';
									} ?>"><a href="<?= base_url('absensiGaji/admin/akun'); ?>"><i class="fas fa-calculator"></i></i>Data
					Akun</a></li>
          <li class="<?php if ($page == 'Setting Absensi') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/absen'); ?>"><i class="fas fa-cogs"></i></i>Setting
              Absensi</a></li>
          <li class="<?php if ($page == 'Laporan') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/laporan'); ?>"><i
                class="fas fa-file-signature"></i></i>Laporan Absensi</a></li>
          <li class="<?php if ($page == 'Laporan Gaji') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/laporanGaji'); ?>"><i
                class="fas fa-file-signature"></i></i>Laporan Gaji</a></li>
          <li class="<?php if ($page == 'Profile') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/profile'); ?>"><i class="fas fa-user-cog"></i></i>Setting
              Profile</a></li>
					<li class="<?php if ($page == 'Jurnal Umum') {
										echo 'active';
									} ?>"><a href="<?= base_url('absensiGaji/admin/jurnalUmum'); ?>"><i class="fas fa-file-signature"></i></i>Jurnal Umum</a></li>
					<li class="<?php if ($page == 'Buku Besar') {
										echo 'active';
									} ?>"><a href="<?= base_url('absensiGaji/admin/bukubesar'); ?>"><i class="fas fa-file-signature"></i></i>Buku Besar</a></li>
          <li class="<?php if ($page == 'Cetak ID') {
                        echo 'active';
                      } ?>"><a href="<?= base_url('absensiGaji/admin/downBarcode'); ?>"><i class="fas fa-qrcode"></i></i>Download
              Barcode</a></li>
        </ul>
      </nav>
      <!-- conten -->
      <div class="content-inner">

        <div class="berhasil" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
        <div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
