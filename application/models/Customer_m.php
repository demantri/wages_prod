<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_m extends CI_Model
{

    protected $table = 'customer';
    protected $primary = 'id_cs';

    public function getAllData()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function Save()
    {
        $this->db->select("RIGHT (customer.kode_cs, 6) as kode_cs", false);
        $this->db->order_by("kode_cs", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('customer');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_cs) + 1;
        } else {
            $kode = 1;
        }
        $kodecs = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodecustomer = "CS-" . $kodecs;
        $data = array(
            'kode_cs'         => $kodecustomer,
            'nama_cs'         => htmlspecialchars($this->input->post('namacs'), true),
            'jenis_kelamin'   => htmlspecialchars($this->input->post('kelamin'), true),
            'telp'            => htmlspecialchars($this->input->post('telp'), true),
            'email'           => htmlspecialchars($this->input->post('email'), true),
            'alamat'          => htmlspecialchars($this->input->post('alamat'), true),
            'jenis_cs'        => htmlspecialchars($this->input->post('jenis'), true),
        );
        return $this->db->insert($this->table, $data);
    }

    public function Edit()
    {
        $id = $this->input->post('idcustomer');
        $data = array(
            'nama_cs'         =>  htmlspecialchars($this->input->post('editnamacs'), true),
            'jenis_kelamin'   =>  htmlspecialchars($this->input->post('editkelamin'), true),
            'telp'              =>  htmlspecialchars($this->input->post('edittelpcs'), true),
            'email'              =>  htmlspecialchars($this->input->post('editemailcs'), true),
            'alamat'          =>  htmlspecialchars($this->input->post('editalamat'), true),
            'jenis_cs'        =>  htmlspecialchars($this->input->post('editjenis'), true),
        );
        return $this->db->set($data)->where($this->primary, $id)->update($this->table);
    }

    public function Delete($id)
    {
        return $this->db->where($this->primary, $id)->delete($this->table);
    }

    public function Detail($id)
    {
        return $this->db->get_where($this->table, [$this->primary => $id])->row_array();
    }
    public function cekDelete($id)
    {
        $sql = "SELECT a.id_cs, b.id_jual FROM customer a, penjualan b WHERE a.id_cs = b.id_cs AND a.id_cs = '$id' GROUP BY a.id_cs";
        $result = $this->db->query($sql)->row_array();
        if ($result['id_cs'] == NULL and $result['id_jual'] == NULL) {
            return array('num' => 0);
        } else {
            return array('num' => 1);
        }
    }

    public function getPoin()
    {
        $sql = "SELECT a.id_cs, a.nama_cs, a.alamat, a.email, a.kode_cs, a.telp, COUNT(b.id_cs) AS total FROM customer a, penjualan b WHERE a.id_cs = b.id_cs GROUP BY b.id_cs";
        return $this->db->query($sql)->result_array();
    }

    public function getRiwayat($kode)
    {
        $sql = "SELECT a.kode_cs, a.nama_cs, SUBSTRING(b.tgl, 1, 10) AS tanggal, COUNT(b.id_cs) AS jml_transaksi, COUNT(b.id_cs) AS total_poin FROM customer a, penjualan b WHERE a.id_cs = b.id_cs AND a.id_cs = '$kode' GROUP BY SUBSTRING(b.tgl, 1, 10) ";
        return $this->db->query($sql)->result_array();
    }
}
