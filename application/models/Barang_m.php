<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_m extends CI_Model
{

    protected $table = 'barang';
    protected $primary = 'id_barang';

    public function getAllData()
    {
        $sql = "SELECT a.id_barang, a.kode_barang, a.barcode ,a.nama_barang, b.satuan, c.kategori, 
        a.harga_jual,a.harga_sales, a.stok FROM barang a LEFT JOIN satuan b ON b.id_satuan = a.id_satuan LEFT JOIN kategori c ON c.id_kategori = a.id_kategori WHERE a.is_active = 1";
        return $this->db->query($sql)->result_array();
    }

    public function Save()
    {
        $this->db->select("RIGHT (barang.kode_barang, 5) as kode_barang", false);
        $this->db->order_by("kode_barang", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('barang');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1;
        } else {
            $kode = 1;
        }
        $kodebrg = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodebarang = "BRG-" . $kodebrg;
        $data = array(
            'kode_barang'      => $kodebarang,
            'barcode'          => htmlspecialchars($this->input->post('barcode'), true),
            'nama_barang'      => htmlspecialchars($this->input->post('namabarang'), true),
            'id_kategori'      => htmlspecialchars($this->input->post('kategori'), true),
            'id_satuan'        => htmlspecialchars($this->input->post('satuan'), true),
            'harga_jual'       => htmlspecialchars($this->input->post('jual'), true),
            'harga_sales'      => htmlspecialchars($this->input->post('sales'), true),
            'stok'             => 0,
            'is_active'        => 1,

        );
        return $this->db->insert($this->table, $data);
    }

    public function Edit()
    {
        $id = $this->input->post('iditem');
        $data = array(
            'barcode'          => htmlspecialchars($this->input->post('barcode'), true),
            'nama_barang'      => htmlspecialchars($this->input->post('namabarang'), true),
            'id_kategori'      => htmlspecialchars($this->input->post('kategori'), true),
            'id_satuan'        => htmlspecialchars($this->input->post('satuan'), true),
            'harga_jual'       => htmlspecialchars($this->input->post('jual'), true),
            'harga_sales'      => htmlspecialchars($this->input->post('sales'), true),
        );
        return $this->db->set($data)->where($this->primary, $id)->update($this->table);
    }

    public function Delete($id)
    {
        return $this->db->set(array('is_active' => 0))->where($this->primary, $id)->update($this->table);
    }

    public function Detail($id)
    {
        return $this->db->get_where($this->table, [$this->primary => $id])->row_array();
    }

    public function Search($key)
    {
        return $this->db->get_where($this->table, ['barcode' => $key])->row_array();
    }

    public function getStokHabis()
    {
        $sql = "SELECT a.id_barang, a.kode_barang, a.barcode ,a.nama_barang, b.satuan, c.kategori,
        a.stok FROM barang a LEFT JOIN satuan b ON b.id_satuan = a.id_satuan LEFT JOIN kategori c ON c.id_kategori = a.id_kategori WHERE a.is_active = 1 AND a.stok < 5 ORDER BY a.stok ASC";
        return $this->db->query($sql)->result_array();
    }
}
