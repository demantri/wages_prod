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

			$tahun1 = date('Y', strtotime($periode));
			$bulan1 = date('m', strtotime($periode));
			$cek = date('m-d-Y', mktime(0,0,0,1, $bulan1-1, $tahun1));
			$bulan = substr($cek, 3,2);
			$tahun = substr($cek, 6,5);
			$query = "SELECT sum(nominal) as debit , 
			(
				SELECT sum(nominal) 
				FROM jurnal 
				WHERE no_coa = '$akun' 
				AND MONTH(tgl_jurnal) <= '$bulan' 
				AND YEAR(tgl_jurnal) <= '$tahun' 
				and posisi_dr_cr = 'k' 
			) AS kredit 
			FROM jurnal 
			WHERE no_coa = '$akun' 
			AND MONTH(tgl_jurnal) <= '$bulan' 
			AND YEAR(tgl_jurnal) <= '$tahun' 
			and posisi_dr_cr = 'd'
			";
			$saldo_awal = $this->db->query($query)->row();
			
			// print_r($saldo_awal);exit;
			$this->db->where('kode_akun =', $akun);
			$header_akun 	= $this->db->get('akun')->row()->nama_akun;

			$val_saldo 		= $this->lm->saldo($akun)->row()->saldo_awal;
			// print_r($val_saldo);exit;

         $data = array(
				'title'    => 'Laporan Buku Besar',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'content'  => 'buku_besar/laporan',
            'akun'     => $this->db->get('akun')->result(), 
            'list'     => $this->lm->getBB($akun, $periode)->result(),
            // 'saldo'    => $this->lm->getBB($akun, $periode)->row()->saldo_awal ?? 0, 
            'saldo'    => $val_saldo, 
            'where' => $where,
            'header_akun' => $header_akun, 
				'saldo_awal' => $saldo_awal
         );
         $this->load->view('templates/main', $data);
      } else {
         // code...
         $where = [
            'akun'   => $akun ? $akun : '-',
            'periode'=> $periode ? $akun : date('Y-m')
         ];
			$tahun1 = date('Y', strtotime($periode));
			$bulan1 = date('m', strtotime($periode));
			$cek = date('m-d-Y', mktime(0,0,0,1, $bulan1-1, $tahun1));
			$bulan = substr($cek, 3,2);
			$tahun = substr($cek, 6,5);
			$query = "SELECT sum(nominal) as debit , 
			(
				SELECT sum(nominal) 
				FROM jurnal 
				WHERE no_coa = '$akun' 
				AND MONTH(tgl_jurnal) <= '$bulan' 
				AND YEAR(tgl_jurnal) <= '$tahun' 
				and posisi_dr_cr = 'k' 
			) AS kredit 
			FROM jurnal 
			WHERE no_coa = '$akun' 
			AND MONTH(tgl_jurnal) <= '$bulan' 
			AND YEAR(tgl_jurnal) <= '$tahun' 
			and posisi_dr_cr = 'd'
			";
			$saldo_awal = $this->db->query($query)->row();

			// $this->db->where('kode_akun =', $akun);
			// $header_akun = $this->db->get('akun')->row()->nama_akun;
         $data = array(
            'title'    => 'Laporan Buku Besar',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'content'  => 'buku_besar/laporan',
            'akun'     => $this->db->get('akun')->result(), 
            'list'     => $this->lm->getBB($akun, $periode)->result(),
            'saldo'     => 0, 
            'where' => $where, 
            'header_akun' => '', 
				'saldo_awal' => $saldo_awal
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
			$periode = $where['awal'].' s/d '.$where['akhir'];
			// print_r($periode);exit;
         $data = array(
            'title'    => 'Jurnal Umum',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'list'     => $this->lm->getJurnal($awal, $akhir)->result(),
            'content'  => 'jurnal_umum/laporan', 
				'periode'  => $periode,
         );
         $this->load->view('templates/main', $data);
      } 
      else {
         $where = [
            'awal' => $awal ? $awal : '',
            'akhir' => $akhir ? $akhir : ''
         ];

         $data = array(
            'title'    => 'Jurnal Umum',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'list'     => $this->lm->getJurnal($awal, $akhir)->result(),
            'content'  => 'jurnal_umum/laporan',
				'periode'  => '-',
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
			$periode = date('F Y', strtotime($where['periode']));
         $data = array(
            'title'    => 'Kartu Stok',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'list'     => $this->lm->getStok($where)->result(),
            'barang'   => $this->db->get('barang')->result(),
				'periode'  => $periode,
            'content'  => 'kartu_stok/laporan'
         );
			// print_r($data);exit;
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
				'periode'  => '-',
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
