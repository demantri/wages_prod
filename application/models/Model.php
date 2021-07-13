<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{

	public function General($sql)
	{
		return $this->db->query($sql);
	}
	public function Simpan($table, $data)
	{
		return $this->db->insert($table, $data);
	}
	public function Edit($primary, $id, $data, $table)
	{
		$this->db->set($data);
		$this->db->where($primary, $id);
		return $this->db->update($table);
	}
}
