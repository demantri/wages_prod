<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller
{

  // function __construct()
  // {
  //   parent::__construct();
  //   $this->db = $this->load->database('second', TRUE);
  // }

  public function index()
  {
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

    $data['jamPulang'] = strtotime($jam_pulang);
    $data['jamMasuk'] = strtotime($jam_masuk);
    $data['user'] = $this->db->get_where('user2', ['role_id' => 1])->row_array();
    $data['judul'] = 'Absen';
    $this->load->view('template/auth_header', $data);
    $this->load->view('user/absen', $data);
    $this->load->view('template/auth_footer', $data);
  }


  public function absensi()
  {
    $hariIni = strtotime(date('Y-m-d', time()));
    $code = $this->input->post('barcode');
    $option = $this->input->post('option1');
    $user = $this->Absen_model->getAllKaryawanByCode($code);
    $jadwal = $this->db->get_where('waktu_absen_sekarang', ['active' => 1])->row_array();
    $dataAbsenFlash = $this->db->get_where('data_absen_flash', ['nik' => $code])->row_array();

    $user_absen = time();
    $masuk = strtotime($jadwal['masuk']);
    $pulang = strtotime($jadwal['pulang']);
    $toleransi = strtotime($jadwal['toleransi']);

    $jam_absen = date('H:i', $user_absen);
    $jam_masuk = date('H:i', $masuk);
    $jam_pulang = date('H:i', $pulang);
    $jam_toleransi = date('H:i', $toleransi);


    $masuk_terlambat = $user_absen - $masuk;
    $m_lambat =  $masuk_terlambat / (60);

    $time_sekarang = date('Y-m-d H:i:s', time());
    $time_pulang = date('Y-m-d H:i:s', $pulang);

    $jam23 = date('H:i:s', strtotime('23:00:00'));
    $tglSek = date('Y-m-d', time());
    $jam23Sek = $tglSek . ' ' . $jam23;
    $target_delete = strtotime($jam23Sek);


    if ($option == null) {
      // $this->session->set_flashdata('suara', 'ditolak.mp3');
      $this->session->set_flashdata('warning', 'Pilih Masuk / Pulang');
      redirect('absensiGaji/user');
    }


    if ($user) {
      if (!$dataAbsenFlash) {
        $dtAbsen = [
          'nik' => $user['nik'],
          'masuk' => '',
          'pulang' => '',
          'terlambat' => '',
          'status' => 0,
          'time' => $hariIni,
          'time_del' => $target_delete
        ];
        $this->db->insert('data_absen_flash', $dtAbsen);
      }
      $dataAbsenFlash1 = $this->db->get_where('data_absen_flash', ['nik' => $code, 'status' => 0])->row_array();
      if ($dataAbsenFlash1) {
        if ($option == 1) {
          if ($jam_absen <= $jam_masuk) {
            $this->db->set(['masuk' => $time_sekarang, 'pulang' => $time_pulang, 'status' => 1])->where('nik', $user['nik'])->update('data_absen_flash');
            $this->session->set_flashdata('suara', 'diterima.mp3');
            $this->session->set_flashdata('berhasil', 'Absen Diterima');
            redirect('absensiGaji/user');
          } else {
            if ($jam_absen > $jam_masuk & $jam_absen < $jam_toleransi) {
              $this->db->set(['masuk' => $time_sekarang, 'pulang' => $time_pulang, 'terlambat' => round($m_lambat), 'status' => 1])->where('nik', $user['nik'])->update('data_absen_flash');
              $this->session->set_flashdata('suara', 'terlambat.mp3');
              $this->session->set_flashdata('berhasil', 'Absen Diterima Tapi Anda Terlambat Jangan Diulang');
              redirect('absensiGaji/user');
            } else {
              if ($jam_absen > $jam_toleransi) {
                $this->db->set(['masuk' => $time_sekarang, 'pulang' => $time_pulang,  'terlambat' => round($m_lambat), 'status' => 3])->where('nik', $user['nik'])->update('data_absen_flash');
                $this->session->set_flashdata('suara', 'nonmasuk.mp3');
                $this->session->set_flashdata('gagal', 'Absen Sudah terlambat');
                redirect('absensiGaji/user');
              }
            }
          }
        } else {
          $this->session->set_flashdata('suara', 'belumabsen.mp3');
          $this->session->set_flashdata('gagal', 'Absen Ditolak, Anda Belum Absen Masuk');
          redirect('absensiGaji/user');
        }
      } else {
        $dataAbsenFlash2 = $this->db->get_where('data_absen_flash', ['nik' => $code, 'status' => 1])->row_array();
        if ($dataAbsenFlash2) {
          if ($option == 1) {
            $this->session->set_flashdata('suara', 'absen2.mp3');
            $this->session->set_flashdata('gagal', 'Absen ditolak, Tidak bisa absen 2 kali');
            redirect('absensiGaji/user');
          } else {
            if ($jam_absen < $jam_pulang) {
              $this->session->set_flashdata('suara', 'nopulang.mp3');
              $this->session->set_flashdata('gagal', 'Absen Ditolak, Belum waktunya Keluar');
              redirect('absensiGaji/user');
            } elseif ($jam_absen >= $jam_pulang) {
              $this->db->set(['pulang' => $time_sekarang, 'status' => 2])->where('nik', $user['nik'])->update('data_absen_flash');
              $this->session->set_flashdata('suara', 'pulang.mp3');
              $this->session->set_flashdata('berhasil', 'Absen Diterima');
              redirect('absensiGaji/user');
            }
          }
        } else {
          $dataAbsenFlash3 = $this->db->get_where('data_absen_flash', ['nik' => $code, 'status' => 2])->row_array();
          if ($dataAbsenFlash3) {
            // $this->session->set_flashdata('suara', 'nonmasuk.mp3');
            $this->session->set_flashdata('warning', 'Anda Sudah Absen Pulang Hari ini, Absen ditolak');
            redirect('absensiGaji/user');
          } else {
            $dataAbsenFlash4 = $this->db->get_where('data_absen_flash', ['nik' => $code, 'status' => 3])->row_array();
            if ($dataAbsenFlash4) {
              if ($option == 1) {
                $this->session->set_flashdata('suara', 'nonmasuk.mp3');
                $this->session->set_flashdata('gagal', 'Absen Ditolak, Anda Sudah terlambat kerja');
                redirect('absensiGaji/user');
              } else {
                $this->session->set_flashdata('suara', 'belumabsen.mp3');
                $this->session->set_flashdata('gagal', 'Absen Ditolak, Anda Belum Absen Masuk');
                redirect('absensiGaji/user');
              }
            }
          }
        }
      }
    } else {
      $this->session->set_flashdata('suara', 'ditolak.mp3');
      $this->session->set_flashdata('gagal', 'NIK / ID Tidak Dikenal');
      redirect('absensiGaji/user');
    }
  }

  public function barcode()
  {
    $this->load->view('admin/barcode');
  }
}