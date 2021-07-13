<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_m extends CI_Model
{

   protected $table = 'kategori';
   protected $primary = 'id_kategori';

   public function getAllData()
   {
      return $this->db->get($this->table)->result_array();
   }

   public function Save()
   {
      $data = array(
         'kategori'   => htmlspecialchars($this->input->post('kategori'), true),
      );
      return $this->db->insert($this->table, $data);
   }

   public function Edit()
   {
      $id = $this->input->post('idkategori');
      $data = array(
         'kategori'   => htmlspecialchars($this->input->post('editkategori'), true),
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
      $sql = "SELECT b.id_kategori, a.id_barang FROM barang a, kategori b WHERE a.id_kategori = b.id_kategori AND b.id_kategori = '$id' GROUP BY b.id_kategori";
      $result = $this->db->query($sql)->row_array();
      if ($result['id_kategori'] == NULL and $result['id_barang'] == NULL) {
         return array('num' => 0);
      } else {
         return array('num' => 1);
      }
   }
}
