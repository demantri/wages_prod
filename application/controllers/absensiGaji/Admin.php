<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    // $this->db = $this->load->database('second', TRUE);
  }



  public function index()
  {
    // Atur jam Absen
    $jadwal = $this->db->get_where('waktu_absen', ['active' => 1])->row_array();
    $detik = '00';
    $jam_masuk = $jadwal['masuk'] . $jadwal['m_masuk'] . $detik;
    $toler = $jadwal['toleransi'];
    $jam_pulang = $jadwal['pulang'] . $jadwal['m_pulang'] . $detik;
    $jam_masuk_t = strtotime($jam_masuk) + ($toler * 60);


    $tahun = date('Y', time());
    $bulan = date('m', time());
    $hari = date('d', time());
    $jam_m = date('H:i:s', strtotime($jam_masuk));
    $jam_p = date('H:i:s', strtotime($jam_pulang));
    $jam_t = date('H:i:s', $jam_masuk_t);

    $time_m = $tahun . '-' . $bulan . '-' . $hari . ' ' . $jam_m;
    $time_p = $tahun . '-' . $bulan . '-' . $hari . ' ' . $jam_p;
    $time_t = $tahun . '-' . $bulan . '-' . $hari . ' ' . $jam_t;

    $this->db->set([
      'masuk' => $time_m,
      'pulang' => $time_p,
      'toleransi' => $time_t
    ]);
    $this->db->where('active', 1);
    $this->db->update('waktu_absen_sekarang');

    $hariIni = strtotime(date('Y-m-d', time()));
    $jadwal_absen = $this->db->get_where('jadwal_absen', ['tanggal' => $hariIni])->row_array();
    if (!$jadwal_absen) {
      $dtJadwal = [
        'tanggal' => $hariIni,
        'masuk' => strtotime($time_m),
        'toleransi' => strtotime($time_t)
      ];
      $this->db->insert('jadwal_absen', $dtJadwal);
    }
    $this->db->set(['masuk' => strtotime($time_m), 'toleransi' => strtotime($time_t)])->where('tanggal', $hariIni)->update('jadwal_absen');



    $absen_flash1 = $this->db->where('time <', $hariIni)->get('data_absen_flash')->result_array();
    if ($absen_flash1) {
      foreach ($absen_flash1 as $key) {
        $dataAbsen = [
          'nik' => $key['nik'],
          'masuk' => $key['masuk'],
          'pulang' => $key['pulang'],
          'terlambat' => $key['terlambat'],
          'status' => $key['status'],
          'time' => $key['time']
        ];
        $this->db->insert('data_absen', $dataAbsen);
        $this->db->where('time_del <', $hariIni)->delete('data_absen_flash');
        $this->db->set('status', 2)->where(['time <' => $hariIni, 'status' => 1])->update('data_absen');
      }
    }

    // =============




    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['judul'] = 'Admin';
    $this->load->view('template/header', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('template/footer', $data);
  }

  public function karyawan()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['no_nik'] = date('ymdHis');
    $data['karyawan'] = $this->Absen_model->getAllKaryawan();

    $data['judul'] = 'Data Karyawan';
    $this->load->view('template/header', $data);
    $this->load->view('admin/karyawan', $data);
    $this->load->view('template/footer', $data);
  }

  public function addKaryawan()
  {
    $nik = $this->input->post('nik', true);
    $nama = $this->input->post('nama', true);
    $email = $this->input->post('email', true);
    $telp = $this->input->post('telp', true);
    $alamat = $this->input->post('alamat', true);
    $kelamin = $this->input->post('kelamin');
    $time = date('Y-m-d H:i:s');

    $user = $this->db->get_where('user2', ['email' => $email])->row_array();
    if ($user) {
      $this->session->set_flashdata('gagal', 'Email ditolak, Gunakan Email Lain');
      redirect('absensiGaji/admin/karyawan');
    }
    $karya = $this->db->get_where('karyawan', ['email' => $email])->row_array();
    if ($karya) {
      $this->session->set_flashdata('gagal', 'Email ditolak, Gunakan Email Lain');
      redirect('absensiGaji/admin/karyawan');
    }

    $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']     = './assets1/images/'; //string, the default is application/cache/
    $config['errorlog']     = './assets1/images/'; //string, the default is application/logs/
    $config['imagedir']     = './assets1/images/qr/'; //direktori penyimpanan qr code
    $config['quality']      = true; //boolean, the default is true
    $config['size']         = '1024'; //interger, the default is 1024
    $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
    $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

    $qrName = $nik . '.png'; //buat name dari qr code sesuai dengan nik

    $params['data'] = $nik; //data yang akan di jadikan QR CODE
    $params['level'] = 'H'; //H=High
    $params['size'] = 10;
    $params['savename'] = FCPATH . $config['imagedir'] . $qrName; //simpan image QR CODE ke folder assets/images/
    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

    $this->Absen_model->addKaryawan($nik, $nama, $email, $telp, $alamat, $kelamin, $time, $qrName);
    $this->session->set_flashdata('berhasil', 'Tambah Data');
    redirect('absensiGaji/admin/karyawan');
  }

  public function edKaryawan($id)
  {
    $nama = $this->input->post('nama', true);
    $email = $this->input->post('email', true);
    $telp = $this->input->post('telp');
    $alamat = $this->input->post('alamat', true);
    $kelamin = $this->input->post('kelamin');

    $user = $this->db->get_where('user2', ['email' => $email])->row_array();
    if ($user) {
      $this->session->set_flashdata('gagal', 'Email ditolak, Gunakan Email Lain');
      redirect('absensiGaji/admin/karyawan');
    }
    $karya = $this->db->get_where('karyawan', ['email' => $email])->row_array();
    $iDkarya = $this->db->get_where('karyawan', ['id' => $id])->row_array();
    if ($karya) {
      if ($karya['email'] !== $iDkarya['email']) {
        $this->session->set_flashdata('gagal', 'Email ditolak, Gunakan Email Lain');
        redirect('absensiGaji/admin/karyawan');
      } else {
        $this->Absen_model->editKaryawan($nama, $email, $telp, $alamat, $kelamin, $id);
        $this->session->set_flashdata('berhasil', 'Edit Data');
        redirect('absensiGaji/admin/karyawan');
      }
    } else {
      $this->Absen_model->editKaryawan($nama, $email, $telp, $alamat, $kelamin, $id);
      $this->session->set_flashdata('berhasil', 'Edit Data');
      redirect('absensiGaji/admin/karyawan');
    }
  }

  public function delKaryawan($id)
  {
    $poto = $this->db->get_where('karyawan', ['id' => $id])->row_array();
    $qr = $poto['qr'];
    unlink('./assets1/images/qr/' . $qr);
    $old_poto = $poto['poto'];
    if ($old_poto != 'default.png') {
      unlink('./assets1/images/user/' . $old_poto);
    }
    $this->db->delete('karyawan', ['id' => $id]);
    $this->db->delete('data_absen_flash', ['nik' => $poto['nik']]);
    $this->db->delete('data_absen', ['nik' => $poto['nik']]);
    $this->session->set_flashdata('berhasil', 'Hapus Data');
    redirect('admin/karyawan');
  }

  public function edpoto($id)
  {
    $poto = $this->db->get_where('karyawan', ['id' => $id])->row_array();
    $old_poto = $poto['poto'];
    $upload_photo = $_FILES['poto']['name'];
    if ($upload_photo) {
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']     = '2000';
      $config['upload_path'] = './assets1/images/user/';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('poto')) {
        if ($old_poto != 'default.png') {
          unlink(FCPATH . 'assets1/images/user/' . $old_poto);
        }
        $new_image = $this->upload->data('file_name');
        $this->db->set('poto', $new_image);
        $this->db->where('id', $id);
        $this->db->update('karyawan');
        $this->session->set_flashdata('berhasil', 'update image');
        redirect('admin/karyawan');
      } else {
        echo $this->upload->display_errors();
        $this->session->set_flashdata('gagal', 'Gambar bukan format gambar / size max 2 MB, Silahkan Ulangi!');
        redirect('admin/karyawan');
      }
    }
    redirect('admin/karyawan');
  }


  public function cekDataKaryaWan()
  {
    $id = $this->input->post('id');
    $user = $this->db->get_where('karyawan', ['id' => $id])->row_array();
    $data = [
      'nik' => $user['nik'],
      'nama' => $user['nama'],
      'email' => $user['email'],
      'telp' => $user['telp'],
      'kelamin' => $user['kelamin'],
      'alamat' => $user['alamat']
    ];
    echo json_encode($data);
  }






  public function absen()
  {
    // Atur jam Absen
    $jadwal = $this->db->get_where('waktu_absen', ['active' => 1])->row_array();
    $detik = '00';
    $jam_masuk = $jadwal['masuk'] . $jadwal['m_masuk'] . $detik;
    $toler = $jadwal['toleransi'];
    $jam_pulang = $jadwal['pulang'] . $jadwal['m_pulang'] . $detik;
    $jam_masuk_t = strtotime($jam_masuk) + ($toler * 60);


    $tahun = date('Y', time());
    $bulan = date('m', time());
    $hari = date('d', time());
    $jam_m = date('H:i:s', strtotime($jam_masuk));
    $jam_p = date('H:i:s', strtotime($jam_pulang));
    $jam_t = date('H:i:s', $jam_masuk_t);

    $time_m = $tahun . '-' . $bulan . '-' . $hari . ' ' . $jam_m;
    $time_p = $tahun . '-' . $bulan . '-' . $hari . ' ' . $jam_p;
    $time_t = $tahun . '-' . $bulan . '-' . $hari . ' ' . $jam_t;

    $this->db->set([
      'masuk' => $time_m,
      'pulang' => $time_p,
      'toleransi' => $time_t
    ]);
    $this->db->where('active', 1);
    $this->db->update('waktu_absen_sekarang');

    $hariIni = strtotime(date('Y-m-d', time()));
    $jadwal_absen = $this->db->get_where('jadwal_absen', ['tanggal' => $hariIni])->row_array();
    if (!$jadwal_absen) {
      $dtJadwal = [
        'tanggal' => $hariIni,
        'masuk' => strtotime($time_m),
        'toleransi' => strtotime($time_t)
      ];
      $this->db->insert('jadwal_absen', $dtJadwal);
    }
    $this->db->set(['masuk' => strtotime($time_m), 'toleransi' => strtotime($time_t)])->where('tanggal', $hariIni)->update('jadwal_absen');



    $absen_flash1 = $this->db->where('time <', $hariIni)->get('data_absen_flash')->result_array();
    if ($absen_flash1) {
      foreach ($absen_flash1 as $key) {
        $dataAbsen = [
          'nik' => $key['nik'],
          'masuk' => $key['masuk'],
          'pulang' => $key['pulang'],
          'terlambat' => $key['terlambat'],
          'status' => $key['status'],
          'time' => $key['time']
        ];
        $this->db->insert('data_absen', $dataAbsen);
        $this->db->where('time_del <', $hariIni)->delete('data_absen_flash');
        $this->db->set('status', 2)->where(['time <' => $hariIni, 'status' => 1])->update('data_absen');
      }
    }

    // =============


    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['waktu'] = $this->db->get_where('waktu_absen', ['active' => 1])->row_array();

    $data['judul'] = 'Setting Absensi';
    $this->load->view('template/header', $data);
    $this->load->view('admin/absen', $data);
    $this->load->view('template/footer', $data);
  }
  public function waktuAbsen()
  {
    $jamMasuk = $this->input->post('jamMasuk');
    $menitMasuk = $this->input->post('menitMasuk');
    $jamPulang = $this->input->post('jamPulang');
    $menitPulang = $this->input->post('menitPulang');
    $toleransi = $this->input->post('toleransi');

    $this->db->set([
      'masuk' => $jamMasuk,
      'm_masuk' => $menitMasuk,
      'pulang' => $jamPulang,
      'm_pulang' => $menitPulang,
      'toleransi' => $toleransi
    ]);
    $this->db->where('active', 1);
    $this->db->update('waktu_absen');
    $this->session->set_flashdata('berhasil', 'Jadwal Di setting');
    redirect('absensiGaji/admin/absen');
  }

  public function laporan()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['karyawan'] = $this->Absen_model->getAllKaryawan();
    $data['absen'] = $this->Absen_model->getDataAbsen();
    $data['tombol'] = '1';

    $data['tgl'] = 'Bulan: ' . date('m') . ' Tahun: ' . date('Y');
    $data['judul'] = 'Laporan';
    $this->load->view('template/header', $data);
    $this->load->view('admin/laporan', $data);
    $this->load->view('template/footer', $data);
  }

  public function absenPerOrg()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $filter = $this->input->post('filter');
    $nik = $this->input->post('nik');

    $data['tombol'] = '2';
    $data['nik'] = $nik;
    $data['filter'] = $filter;
    $data['tgl'] = 'NIK: ' . $nik . ' (Bulan: ' . date('m-Y', strtotime($filter)) . ')';


    $data['absen'] = $this->Absen_model->getDataAbsenByorg($filter, $nik);
    $data['karyawan'] = $this->Absen_model->getAllKaryawan();
    $data['judul'] = 'Laporan';
    $this->load->view('template/header', $data);
    $this->load->view('admin/laporan', $data);
    $this->load->view('template/footer', $data);
  }
  public function absenPerAll()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $option = $this->input->post('option1');
    $filter = $this->input->post('filter');

    if ($option == 1) {
      $data['tgl'] = ' (Bulan: ' . date('m-Y', strtotime($filter)) . ')';
    } else {
      $data['tgl'] = ' (Tanggal: ' . date('d-m-Y', strtotime($filter)) . ')';
    }
    $data['tombol'] = '3';
    $data['filter'] = $filter;
    $data['option'] = $option;
    $data['absen'] = $this->Absen_model->getDataAbsenByAll($option, $filter);
    $data['karyawan'] = $this->Absen_model->getAllKaryawan();
    $data['judul'] = 'Laporan';
    $this->load->view('template/header', $data);
    $this->load->view('admin/laporan', $data);
    $this->load->view('template/footer', $data);
  }

  public function exExcel()
  {
    $data['tgl'] = 'Bulan: ' . date('m') . ' Tahun: ' . date('Y');
    $data['absen'] = $this->Absen_model->getDataAbsen();
    $this->load->view('export/index', $data);
  }

  public function exExcel1()
  {
    $filter = $this->input->get('filter');
    $nik = $this->input->get('nik');

    $data['tgl'] = 'NIK: ' . $nik . ' (Bulan: ' . date('m-Y', strtotime($filter)) . ')';
    $data['absen'] = $this->Absen_model->getDataAbsenByOrg($filter, $nik);
    $this->load->view('export/index', $data);
  }

  public function exExcel2()
  {
    $option = $this->input->get('option');
    $filter = $this->input->get('filter');

    if ($option == 1) {
      $data['tgl'] = ' (Bulan: ' . date('m-Y', strtotime($filter)) . ')';
    } else {
      $data['tgl'] = ' (Tanggal: ' . date('d-m-Y', strtotime($filter)) . ')';
    }

    $data['absen'] = $this->Absen_model->getDataAbsenByAll($option, $filter);
    $this->load->view('export/index', $data);
  }

  // public function delLap($id)
  // {
  //     $this->db->where('id', $id);
  //     $this->db->delete('data_absen');
  //     $this->session->set_flashdata('berhasil', 'Dihapus Data');
  //     redirect('admin/laporan');
  // }




  public function profile()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();

    $data['judul'] = 'Profile';
    $this->load->view('template/header', $data);
    $this->load->view('admin/profile', $data);
    $this->load->view('template/footer', $data);
  }

  public function edProfil()
  {
    $pass = $this->input->post('pass');
    $id = $this->input->post('id');
    $usaha = $this->input->post('usaha', true);
    $nama = $this->input->post('nama', true);
    $email  = $this->input->post('email', true);

    $userPass = $this->db->get_where('user2', ['id' => $id])->row_array();
    if (password_verify($pass, $userPass['password'])) {
      $karyawan = $this->db->get_where('karyawan', ['email' => $email])->row_array();
      if ($karyawan) {
        $this->session->set_flashdata('gagal', 'Gunakan Email Lain');
        redirect('absensiGaji/admin/profile');
      }

      $user = $this->db->get_where('user2', ['email' => $email])->row_array();
      if ($user) {
        $this->db->set(['nama' => $nama, 'perusahaan' => $usaha])->where('id', $id)->update('user2');
        $this->session->set_flashdata('berhasil', 'Update Data');
        redirect('absensiGaji/admin/profile');
      } else {
        $this->db->set(['nama' => $nama, 'email' => $email, 'perusahaan' => $usaha])->where('id', $id)->update('user2');
        $this->session->set_userdata('email', $email);
        $this->session->set_flashdata('berhasil', 'Update Data');
        redirect('absensiGaji/admin/profile');
      }
    } else {
      $this->session->set_flashdata('gagal', 'Password Salah');
      redirect('absensiGaji/admin/profile');
    }
  }

  public function edPotProf($id)
  {
    $poto = $this->db->get_where('user2', ['id' => $id])->row_array();
    $old_poto = $poto['poto'];
    $upload_photo = $_FILES['poto']['name'];
    if ($upload_photo) {
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']     = '2000';
      $config['upload_path'] = './assets1/images/user/';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('poto')) {
        if ($old_poto != 'user.jpg') {
          unlink(FCPATH . 'assets1/images/user/' . $old_poto);
        }
        $new_image = $this->upload->data('file_name');
        $this->db->set('poto', $new_image);
        $this->db->where('id', $id);
        $this->db->update('user2');
        $this->session->set_flashdata('berhasil', 'update image');
        redirect('absensiGaji/admin/profile');
      } else {
        echo $this->upload->display_errors();
        $this->session->set_flashdata('gagal', 'Gambar bukan format gambar / ukuran terlalu besar, Silahkan Ulangi!');
        redirect('absensiGaji/admin/profile');
      }
    }
    redirect('absensiGaji/admin/profile');
  }

  public function edLogProf($id)
  {
    $poto = $this->db->get_where('user2', ['id' => $id])->row_array();
    $old_poto = $poto['logo'];
    $upload_photo = $_FILES['poto']['name'];
    if ($upload_photo) {
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']     = '2000';
      $config['upload_path'] = './assets1/images/logo/';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('poto')) {
        if ($old_poto != 'logo.png') {
          unlink(FCPATH . 'assets1/images/logo/' . $old_poto);
        }
        $new_image = $this->upload->data('file_name');
        $this->db->set('logo', $new_image);
        $this->db->where('id', $id);
        $this->db->update('user2');
        $this->session->set_flashdata('berhasil', 'update image');
        redirect('absensiGaji/admin/profile');
      } else {
        echo $this->upload->display_errors();
        $this->session->set_flashdata('gagal', 'Gambar bukan format gambar / ukuran terlalu besar, Silahkan Ulangi!');
        redirect('absensiGaji/admin/profile');
      }
    }
    redirect('absensiGaji/admin/profile');
  }

  public function editPass()
  {
    $user = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $pass1 = $this->input->post('password1');
    $pass2 = $this->input->post('password2');
    $pass3 = $this->input->post('password3');
    $password2 = password_hash($pass2, PASSWORD_DEFAULT);
    if (password_verify($pass1, $user['password'])) {
      if ($pass2 == $pass3) {
        $this->db->set('password', $password2);
        $this->db->where('email', $user['email']);
        $this->db->update('user2');
        $this->session->set_flashdata('berhasil', 'ok');
        redirect('absensiGaji/admin/profile');
      } else {
        $this->session->set_flashdata('gagal', 'Password baru Harus Sama, Ulangi Password Baru');
        redirect('absensiGaji/admin/profile');
      }
    } else {
      $this->session->set_flashdata('gagal', 'Password Lama Salah.! Silahkan Diulang');
      redirect('absensiGaji/admin/profile');
    }
  }

  public function downBarcode()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['karyawan'] = $this->Absen_model->getAllKaryawan2();

    $data['judul'] = 'Cetak ID';
    $this->load->view('template/header', $data);
    $this->load->view('admin/idcard', $data);
    $this->load->view('template/footer', $data);
  }

  public function tampilIdCard()
  {
    $id = $this->input->post('namaId');
    $hasil = $this->Absen_model->getAllKaryawanById($id);
    $data['nik'] = $hasil['nik'];
    $data['nama'] = $hasil['nama'];
    $data['email'] = $hasil['email'];
    $data['telp'] = $hasil['telp'];
    $data['poto'] = $hasil['poto'];
    $data['qr'] = $hasil['qr'];
    echo json_encode($data);
  }

  public function barcode()
  {
    $this->load->view('admin/barcode');
  }


  public function downloadBarcode($id)
  {
    $user = $this->db->get_where('karyawan', ['id' => $id])->row_array();
    if ($user) {
      redirect('absensiGaji/admin/barcode/?name=ID&size=60&print=true&text=' . $user['nik']);
    }
  }

  public function downloadQrcode($id)
  {
    $user = $this->db->get_where('karyawan', ['id' => $id])->row_array();
    if ($user) {
      $nama = $user['nama'] . $user['nik'] . '.png';
      $data = 'assets1/images/qr/' . $user['qr'];
      force_download($nama, file_get_contents($data));
    }
  }


  // GAJIH 
  public function gajikaryawan()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['karyawan'] = $this->Absen_model->getAllKaryawan();

    $data['judul'] = 'Gaji Karyawan';
    $this->load->view('template/header', $data);
    $this->load->view('gaji/gaji', $data);
    $this->load->view('template/footer', $data);
  }

  public function setGaji($id)
  {
    $gaji = $this->input->post('isi', true);
    $dtKar = $this->Absen_model->getAllKaryawanById($id);
    if ($dtKar) {
      $this->db->set('gaji', $gaji)->where('id', $id);
      $this->db->update('karyawan');
    }
  }
  public function setJabat($id)
  {
    $jabatan = $this->input->post('isi', true);
    $jabatan = trim($jabatan);
    $dtKar = $this->Absen_model->getAllKaryawanById($id);
    if ($dtKar) {
      $this->db->set('jabatan', $jabatan)->where('id', $id);
      $this->db->update('karyawan');
    }
  }

  public function laporanGaji()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['gaji'] = $this->Absen_model->getGaji();
    $data['karyawan'] = $this->Absen_model->getAllKaryawan();

    $data['judul'] = 'Laporan Gaji';
    $this->load->view('template/header', $data);
    $this->load->view('gaji/laporan', $data);
    $this->load->view('template/footer', $data);
  }

  public function inputGaji()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['gaji'] = $this->Absen_model->getGaji();
    $data['karyawan'] = $this->Absen_model->getAllKaryawan();

    $data['judul'] = 'Input Gaji';
    $this->load->view('template/header', $data);
    $this->load->view('gaji/gajian', $data);
    $this->load->view('template/footer', $data);
  }

  public function addGajian()
  {
    $nama = $this->input->post('nama', true);
    $tglDari = $this->input->post('tglDari', true);
    $tglSampai = $this->input->post('tglSampai', true);
    $tglBayar = $this->input->post('tglBayar', true);
    $now = date('Y-m-d');
    if ($tglSampai >= $now) {
      $this->session->set_flashdata('gagal', 'Minimal Rentang waktu kurang dari hari ini');
      redirect('absensiGaji/admin/inputGaji');
    }
    if ($tglDari >= $tglSampai) {
      $this->session->set_flashdata('gagal', '(Dari Tanggal) minimal kurang dari (Sampai tanggal)');
      redirect('absensiGaji/admin/inputGaji');
    }
    $dtAbsen = $this->Absen_model->dataAbsen($tglDari, $tglSampai, $nama);
    $dtPg = $this->Absen_model->getAllKaryawanByCode($nama);
    $dataGj = [
      'nik' => $nama,
      'durasi' => $dtAbsen,
      'jml_gaji' => $dtAbsen * $dtPg['gaji'],
      'status' => 0,
      'tgl' => $tglBayar,
      'dari' => $tglDari,
      'sampai' => $tglSampai
    ];
    $this->db->insert('gaji', $dataGj);
    $this->session->set_flashdata('berhasil', 'Success');
    redirect('absensiGaji/admin/inputGaji');
  }

  public function setStatusGaji($id)
  {
    $gaji = $this->Absen_model->getGajiId($id);

    if ($gaji['status'] == '1') {
      $this->db->set('status', 0);
    } else {
      $this->db->set([
				'tgl' => date('Y-m-d'), 
				'status' => '1']
			);
    }
    $this->db->where('id', $id)->update('gaji');

		// ngejurnal
		if ($gaji['status'] == 0) {
			$beban = [
				'id_transaksi' => $id,
				'tgl_jurnal' => date('Y-m-d'),
				'no_coa' => 512,
				'posisi_dr_cr' => 'd',
				'nominal' => $gaji['jml_gaji'],
			];
			$this->db->insert('jurnal', $beban);

			$kas = [
				'id_transaksi' => $id,
				'tgl_jurnal' => date('Y-m-d'),
				'no_coa' => 111,
				'posisi_dr_cr' => 'k',
				'nominal' => $gaji['jml_gaji'],
			];
			$this->db->insert('jurnal', $kas);
		}
		// print_r($gaji);exit;
    redirect('absensiGaji/admin/inputGaji');
  }
  public function delDataGaji($id)
  {
    $this->db->where('id', $id)->delete('gaji');
    redirect('absensiGaji/admin/inputGaji');
  }

  public function setRentangWaktu($id)
  {
    $gaji = $this->Absen_model->getGajiId($id);
    $tglDari = $this->input->post('from', true);
    $tglSampai = $this->input->post('to', true);
    $now = date('Y-m-d');
    if ($tglSampai >= $now || $tglDari >= $tglSampai) {
      echo "no";
    } else {
      $dtAbsen = $this->Absen_model->dataAbsen($tglDari, $tglSampai, $gaji['nik']);
      $dtPg = $this->Absen_model->getAllKaryawanByCode($gaji['nik']);
      $this->db->set([
        'durasi' => $dtAbsen,
        'jml_gaji' => $dtAbsen * $dtPg['gaji'],
        'dari' => $tglDari,
        'sampai' => $tglSampai
      ]);
      $this->db->where('id', $id)->update('gaji');
    }
  }

  public function detailGaji($id = "xxxxx")
  {
    $gaji = $this->Absen_model->getGajiId($id);
    if (!$gaji) {
      redirect('absensiGaji/admin/laporanGaji');
    }
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['gaji'] = $gaji;
    $data['karyawan'] = $this->Absen_model->getAllKaryawanByCode($gaji['nik']);

    $data['judul'] = 'Laporan Gaji';
    $this->load->view('template/header', $data);
    $this->load->view('gaji/detail', $data);
    $this->load->view('template/footer', $data);
  }

  public function slipGaji($id = "xxxxxxx")
  {
    $gaji = $this->Absen_model->getGajiId($id);
    if (!$gaji) {
      redirect('absensiGaji/admin/laporanGaji');
    }
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    $data['gaji'] = $gaji;
    $data['karyawan'] = $this->Absen_model->getAllKaryawanByCode($gaji['nik']);

    $data['judul'] = 'Slip Gaji';
    $this->load->view('gaji/slip', $data);
  }


  public function dataAkun()
  {
    $data['user'] = $this->db->get_where('user2', ['email' => $this->session->userdata('email')])->row_array();
    // $data['akun'] = $this->Absen_model->akun();
    $data['akun'] = $this->db->get('akun2')->result_array();
    // print_r($data['akun']);exit;

    $data['judul'] = 'Data Akun';
    $this->load->view('template/header', $data);
    $this->load->view('gaji/akun', $data);
    $this->load->view('template/footer', $data);
  }
  public function saveAkun()
  {
    $kode = trim($this->input->post('kode', true));
    $nama = trim($this->input->post('nama', true));
    $head = trim($this->input->post('head', true));
    $dc = trim($this->input->post('dc', true));
    $data = [
      'kode'=>$kode,
      'nama' => $nama,
      'header' => $head,
      'dc'=>$dc
    ];
    $this->db->insert('akun2', $data);
    $this->session->set_flashdata('berhasil', 'Success');
    redirect('absensiGaji/admin/dataAkun');
  }
  public function editAkun($id)
  {
    $kode = trim($this->input->post('kode', true));
    $nama = trim($this->input->post('nama', true));
    $head = trim($this->input->post('head', true));
    $dc = trim($this->input->post('dc', true));
    $this->db->set([
      'kode'=>$kode,
      'nama' => $nama,
      'header' => $head,
      'dc'=>$dc
    ]);
    $this->db->where('id', $id)->update('akun');
    $this->session->set_flashdata('berhasil', 'Success');
    redirect('absensiGaji/admin/dataAkun');
  }
  public function delAkun($id)
  {
    $this->db->where('id', $id)->delete('akun');
    redirect('absensiGaji/admin/dataAkun');
  }
}
