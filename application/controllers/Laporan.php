<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
   public function __construct()
   {

      parent::__construct();
      cek_login();
      cek_user();
      $this->load->model('Laporan_model', 'lm');
   }
   public function barang()
   {
      $data = array(
         'title'    => 'Laporan Data Barang',
         'user'     => infoLogin(),
         'toko'     => $this->db->get('profil_perusahaan')->row(),
         'content'  => 'barang/item/laporan'
      );
      $this->load->view('templates/main', $data);
   }

   public function penjualan()
   {
      $data = array(
         'title'    => 'Laporan Penjualan',
         'user'     => infoLogin(),
         'toko'     => $this->db->get('profil_perusahaan')->row(),
         'content'  => 'penjualan/laporan'
      );
      $this->load->view('templates/main', $data);
   }

   public function dataPenjualan()
   {
      $data = [
         'awal' => $this->input->get('tgl_awal'),
         'akhir' => $this->input->get('tgl_akhir')
      ];
      $this->load->view('penjualan/data-laporan', $data);
   }

   public function detail_penjualan(){
      $this->load->view('penjualan/detail_laporan');
   }

   public function bukuBesar(){
      $akun = $this->input->post('id_akun');
      $periode = $this->input->post('periode');

      if (isset($akun, $periode)) {
         $where = [
            'akun'   => $akun, 
            'periode'=> $periode
         ];
         $data = array(
            'title'    => 'Laporan Buku Besar',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'content'  => 'buku_besar/laporan',
            'akun'     => $this->db->get('akun')->result(), 
            'list'     => $this->lm->getBB($where)->result(),
            'saldo_awal'     => $this->lm->getBB($where)->row()->saldo_awal, 
            'where' => $where,
            $this->db->where('kode_akun =', $where['akun']),
            'header_akun' => $this->db->get('akun')->row()->nama_akun
         );
         // print_r($data);exit;
         $this->load->view('templates/main', $data);
      } else {
         // code...
         $where = [
            'akun'   => $akun ? $akun : 0,
            'periode'=> $periode ? $akun : date('Y-m')
         ];

         $data = array(
            'title'    => 'Laporan Buku Besar',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'content'  => 'buku_besar/laporan',
            'akun'     => $this->db->get('akun')->result(), 
            'list'     => $this->lm->getBB($where)->result(),
            'saldo_awal'     => '', 
            'where' => $where, 
            'header_akun' => ''
         );
         $this->load->view('templates/main', $data);
      }
   }

   public function jurnalUmum(){
      $awal = $this->input->post('awal');
      $akhir = $this->input->post('akhir');

      if (isset($awal, $akhir)) {
         $where = [
            'awal' => $awal, 
            'akhir' => $akhir
         ];

         $data = array(
            'title'    => 'Jurnal Umum',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'list'     => $this->lm->getJurnal($where)->result(),
            'content'  => 'jurnal_umum/laporan'
         );
         $this->load->view('templates/main', $data);
      } 
      else {
         $where = [
            'awal' => $awal ? $awal : date('Y-m-d'), 
            'akhir' => $akhir ? $akhir : date('Y-m-d')
         ];

         $data = array(
            'title'    => 'Jurnal Umum',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'list'     => $this->lm->getJurnal($where)->result(),
            'content'  => 'jurnal_umum/laporan'
         );
         $this->load->view('templates/main', $data);
      }
   }

   public function kartuStok(){
      $id_barang = $this->input->post('id_barang');
      $periode = $this->input->post('periode');

      if (isset($id_barang, $periode)) {
         $where = [
            'id_barang' => $id_barang, 
            'periode' => $periode
         ];

         $data = array(
            'title'    => 'Kartu Stok',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'list'     => $this->lm->getStok($where)->result(),
            'barang'   => $this->db->get('barang')->result(),
            'content'  => 'kartu_stok/laporan'
         );
         $this->load->view('templates/main', $data);
      } 
      else {
         $where = [
            'id_barang' => $id_barang ? $id_barang : 0, 
            'periode' => $periode ? date('Y-m') : ''
         ];

         $data = array(
            'title'    => 'Kartu Stok',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'list'     => $this->lm->getStok($where)->result(),
            'barang'   => $this->db->get('barang')->result(),
            'content'  => 'kartu_stok/laporan'
         );
         $this->load->view('templates/main', $data);
      }
      // $data = array(
      //       'title'    => 'Kartu Stok',
      //       'user'     => infoLogin(),
      //       'toko'     => $this->db->get('profil_perusahaan')->row(),
      //       'list'     => $this->lm->getStok()->result(),
      //       'content'  => 'kartu_stok/laporan'
      //    );
      // $this->load->view('templates/main', $data);
   }

   public function laba_rugi()
   {
      $data = array(
         'title'    => 'Laporan Laba Rugi',
         'user'     => infoLogin(),
         'toko'     => $this->db->get('profil_perusahaan')->row(),
         'content'  => 'penjualan/laba_rugi'
      );
      $this->load->view('templates/main', $data);
   }

   public function stok()
   {
      $data = array(
         'title'    => 'Laporan Stok In/Out',
         'user'     => infoLogin(),
         'toko'     => $this->db->get('profil_perusahaan')->row(),
         'content'  => 'stok/laporan'
      );
      $this->load->view('templates/main', $data);
   }
}
