<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

	public function getJurnal($awal, $akhir)
	{
		$sql = "SELECT a.*, nama_akun
		FROM jurnal a 
		INNER JOIN akun b ON a.no_coa = b.kode_akun
		WHERE tgl_jurnal between '$awal' AND '$akhir'
		AND LEFT(id_transaksi, 3) != 'sld' /* <-- kunci query nya*/
		ORDER BY id ASC";
		return $this->db->query($sql);
	}

	public function getJurnal2($awal = '', $akhir = '')
	{
		$sql = "SELECT a.*, nama_akun
		FROM jurnal a 
		INNER JOIN akun b ON a.no_coa = b.kode_akun
		WHERE tgl_jurnal between '$awal' AND '$akhir'
		ORDER BY id ASC";
		return $this->db->query($sql);
	}

	public function getBB($coa, $tgl)
	{
		$sql ="SELECT a.*, nama_akun, saldo_awal
		FROM jurnal a
		JOIN akun b ON a.no_coa = b.kode_akun
		WHERE no_coa = '$coa'
		AND LEFT(tgl_jurnal, 7) = '$tgl'
		";
		return $this->db->query($sql);
	}

	public function saldo($coa)
	{
		$sql = "SELECT saldo_awal 
		FROM akun
		WHERE kode_akun = '$coa'
		";
		return $this->db->query($sql);
	}

	public function getStok($condition = array())
	{
		if ($condition) {
			$where = "id_barang = '".$condition['id_barang']."' AND LEFT(tgl_trans, 7) = '".$condition['periode']."'";
		}

		// $sql ="SELECT * 
		// FROM transaksi
		// WHERE $where
		// ";
		$sql = "SELECT * 
		FROM table_stock_card
		WHERE $where
		";
		return $this->db->query($sql);
	}
}
