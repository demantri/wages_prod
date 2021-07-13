<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Satuan_m');
	}

	public function index()
	{
		$data = array(
			'title'    => 'Satuan',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'barang/satuan/index'
		);
		$this->load->view('templates/main', $data);
	}

	public function LoadData()
	{
		$json = array(
			"aaData"  => $this->Satuan_m->getAllData()
		);
		echo json_encode($json);
	}

	public function inputsatuan()
	{
		$this->Satuan_m->Save();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Satuan berhasil disimpan.</div>');
		redirect('satuan');
	}

	public function detilsatuan($id = '')
	{
		$data = $this->Satuan_m->Detail($id);
		echo json_encode($data);
	}

	public function editsatuan()
	{
		$this->Satuan_m->Edit();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Success!</b> Data Satuan berhasil diubah.</div>');
		redirect('satuan');
	}

	public function hapussatuan($id = '')
	{
		$this->Satuan_m->Delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><aria-hidden="true">×</span> </button><b>Success!</b> Data Satuan berhasil dihapus.</div>');
	}
	public function cek_delete($id = '')
	{
		$data = $this->Satuan_m->cekDelete($id);
		echo json_encode($data);
	}
}
