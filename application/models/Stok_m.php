<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_m extends CI_Model
{

    protected $table = 'stok';
    protected $primary = 'id_stok';

    public function all_data()
    {
        $sql = "SELECT d.id_stok, a.barcode, a.nama_barang, d.jenis, d.keterangan, d.tanggal, d.jml, c.satuan FROM  barang a, satuan c, stok d WHERE a.id_satuan = c.id_satuan AND d.id_barang = a.id_barang";
        return $this->db->query($sql)->result_array();
    }

	public function kd_stok()
	{
		date_default_timezone_set('Asia/Jakarta');
		$q = $this->db->query("SELECT MAX(RIGHT(id_stok,4)) AS kd_max FROM stok");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return "STK-".date('dmy').$kd;
	}

    public function Save()
    {
        $harga = $this->input->post('harga');
        $jml = $this->input->post('jml');
        $jenis = $this->input->post('jenis');
        $nilai = $jml * $harga;
        $id = $this->input->post('iditem');
		$harga_satuan = $this->input->post('harga_beli');
		$total = $this->input->post('total');
		$kode = $this->input->post('kode');
        $data = array(
			'kode_stok'		  => $kode,
            'id_barang'       => htmlspecialchars($id, true),
            'jml'             => htmlspecialchars($jml, true),
            'tanggal'         => date('Y-m-d H:i:s'),
            'jenis'           => $jenis,
            'keterangan'      => htmlspecialchars($this->input->post('keterangan'), true),
            'harga_satuan'    => $harga_satuan,
            'total'      	  => $total,
        );
        $this->db->insert($this->table, $data);

        $sqlstok = "select stok from barang where id_barang = '$id'";
        $stok = implode($this->db->query($sqlstok)->row_array());
        if ($jenis == "Stok Masuk") {

            $hasil = $stok + $jml;
        } else {

            $hasil = $stok - $jml;
        }
        $update = "update barang set stok = '$hasil' where id_barang = '$id'";
        $this->db->query($update);

        $trans_stok = [
            'id_barang' => htmlspecialchars($id, true),
            'jenis' => $jenis == 'Stok Masuk' ? 'Stok Masuk' : 'Stok Keluar',
            'jml' => $jml,
            'stok_akhir' => $hasil,
        ];
        $this->db->insert('transaksi', $trans_stok);

		// update jurnal 
		$pembelian = [
			'id_transaksi' => $kode,
			'tgl_jurnal' => date('Y-m-d'),
			'no_coa' => 500,
			'posisi_dr_cr' => 'd',
			'nominal' => $total,
		];
		$this->db->insert('jurnal', $pembelian);

		$kas = [
			'id_transaksi' => $kode,
			'tgl_jurnal' => date('Y-m-d'),
			'no_coa' => 111,
			'posisi_dr_cr' => 'k',
			'nominal' => $total,
		];
		$this->db->insert('jurnal', $kas);
    }

    public function Delete($id)
    {
        $getDetil = $this->db->get_where('stok', ['id_stok' => $id])->row_array();
        $qty = $getDetil['jml'];
        $idBrg = $getDetil['id_barang'];
        $jenis = $getDetil['jenis'];
        $getBrg = $this->db->get_where('barang', ['id_barang' => $idBrg])->row_array();
        $stokBrg = $getBrg['stok'];
        if ($jenis == "Stok Masuk") {

            $hasil = $stokBrg - $qty;
        } else {

            $hasil = $stokBrg + $qty;
        }

        $updateStok = $this->db->set(array('STOK' => $hasil))->where('id_barang', $idBrg)->update('barang');

        $sql = "delete from stok where id_stok = '$id'";
        $this->db->query($sql);
    }
}
