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

    public function Save()
    {
        $harga = $this->input->post('harga');
        $jml = $this->input->post('jml');
        $jenis = $this->input->post('jenis');
        $nilai = $jml * $harga;
        $id = $this->input->post('iditem');
        $data = array(
            'id_barang'       => htmlspecialchars($id, true),
            'jml'             => htmlspecialchars($jml, true),
            'tanggal'         => date('Y-m-d H:i:s'),
            'jenis'           => $jenis,
            'keterangan'      => htmlspecialchars($this->input->post('keterangan'), true),
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
