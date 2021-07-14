<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

	public function getJurnal($awal, $akhir)
	{
		// if ($condition) {
		// 	// code...
		// 	$where = "tgl_jurnal BETWEEN '".$condition['awal']."' AND '".$condition['akhir']."' ";
		// }
		// $sql = "SELECT a.*, nama_akun
		// FROM jurnal a 
		// INNER JOIN akun b ON a.no_coa = b.kode_akun
		// WHERE $where 
		// ORDER BY id ASC
		// ";
		$sql = "SELECT a.*, nama_akun
		FROM jurnal a 
		INNER JOIN akun b ON a.no_coa = b.kode_akun
		WHERE tgl_jurnal between '$awal' AND '$akhir'
		ORDER BY id ASC";
		return $this->db->query($sql);
	}

	public function getBB($condition = array())
	{
		if ($condition) {
			$where = "no_coa = '".$condition['akun']."' AND LEFT(tgl_jurnal, 7) = '".$condition['periode']."'";
		}
		$sql ="SELECT a.*, nama_akun, saldo_awal
		FROM jurnal a
		JOIN akun b ON a.no_coa = b.kode_akun
		WHERE $where
		";
		return $this->db->query($sql);
	}

	public function getStok($condition = array())
	{
		if ($condition) {
			$where = "id_barang = '".$condition['id_barang']."' AND LEFT(tgl_input, 7) = '".$condition['periode']."'";
		}

		$sql ="SELECT * 
		FROM transaksi
		WHERE $where
		";
		return $this->db->query($sql);
	}
}
