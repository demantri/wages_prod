<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InputManual_m extends CI_Model {

    public function getPembebanan(){
        $this->db->select(['b.*']);
        $this->db->from('transaksi_coa a');
        $this->db->join('akun b', 'b.id=a.id_akun', 'inner');
        $this->db->where('transaksi', 'pembebanan');
        return $this->db->get();
    }

    public function getPemodalan(){
        $this->db->select(['b.*']);
        $this->db->from('transaksi_coa a');
        $this->db->join('akun b', 'b.id=a.id_akun', 'inner');
        $this->db->where('transaksi', 'pemodalan');
        return $this->db->get();
    }

    public function save($transaksi){
        $data = [
            'transaksi' => $transaksi,
            'id_akun'   => $this->input->post('id_akun'),
            'tgl'       => $this->input->post('tgl'),
            'nominal'   => $this->input->post('nominal')
        ];

        $this->db->insert('jurnal_umum', $data);
    }

}