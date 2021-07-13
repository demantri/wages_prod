<?php
defined('BASEPATH') OR exit("No direct script access allowed");

class Akun_m extends CI_Model {

    protected $table = "akun";

    public function getAllData(){
        return $this->db->get($this->table)->result_array();
    }

    public function getWhere($id){
        return $this->db->get_where($this->table, ['id' => $id])->result_array();
    }

    public function save(){
        $this->db->from($this->table);
        $this->db->where('kode_akun', $this->input->post('kode_akun'));
        $check = $this->db->get();

        $data = [
            'kode_akun' => $this->input->post('kode_akun'),
            'nama_akun' => $this->input->post('nama_akun'),
            'c_d' => $this->input->post('c_d')
        ];

        if($check->num_rows() > 0){
            $this->db->where('kode_akun', $this->input->post('kode_akun'));
            return $this->db->update($this->table, $data);
        } else {
            return $this->db->insert($this->table, $data);
        }
    }

    public function Delete($id){
        return $this->db->delete($this->table, ['id' => $id]);
    }

}