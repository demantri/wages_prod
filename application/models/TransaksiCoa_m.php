<?php
defined('BASEPATH') OR exit("No direct script access allowed");

class TransaksiCoa_m extends CI_Model {

    protected $table = "transaksi_coa";

    public function getAllData(){
        $this->db->select(['a.*', 'b.nama_akun', 'b.kode_akun']);
        $this->db->from('transaksi_coa a');
        $this->db->join('akun b', 'b.id=a.id_akun', 'inner');
        return $this->db->get()->result_array();
    }

    public function getWhere($id){
        return $this->db->get_where($this->table, ['id' => $id])->result_array();
    }

    public function save(){
        $this->db->from($this->table);
        $this->db->where('id', $this->input->post('id'));
        $check = $this->db->get();

        $data = [
            'transaksi' => $this->input->post('transaksi'),
            'id_akun' => $this->input->post('id_akun'),
            'posisi' => $this->input->post('posisi')
        ];

        if($check->num_rows() > 0){
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update($this->table, $data);
        } else {
            return $this->db->insert($this->table, $data);
        }
    }

    public function Delete($id){
        return $this->db->delete($this->table, ['id' => $id]);
    }

}