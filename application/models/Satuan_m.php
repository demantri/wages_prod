<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan_m extends CI_Model
{

   protected $table = 'satuan';
   protected $primary = 'id_satuan';

   public function getAllData()
   {
      return $this->db->get($this->table)->result_array();
   }

   public function Save()
   {
      $data = array(
         'satuan'   => htmlspecialchars($this->input->post('satuan'), true),
      );
      return $this->db->insert($this->table, $data);
   }

   public function Edit()
   {
      $id = $this->input->post('idsatuan');
      $data = array(
         'satuan'   => htmlspecialchars($this->input->post('editsatuan'), true),
      );
      return $this->db->set($data)->where($this->primary, $id)->update($this->table);
   }

   public function Delete($id)
   {
      return $this->db->where($this->primary, $id)
         ->delete($this->table);
   }

   public function Detail($id)
   {
      return $this->db->get_where($this->table, [$this->primary => $id])->row_array();
   }

   public function cekDelete($id)
   {
      $sql = "SELECT b.id_satuan, a.id_barang FROM barang a, satuan b WHERE a.id_satuan = b.id_satuan AND b.id_satuan = '$id' GROUP BY b.id_satuan";
      $result = $this->db->query($sql)->row_array();
      if ($result['id_satuan'] == NULL and $result['id_barang'] == NULL) {
         return array('num' => 0);
      } else {
         return array('num' => 1);
      }
   }
}
