<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Customer_m');
	}

	public function index()
	{
		$data = array(
			'title'    => 'Customer',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'customer/index'

		);
		$this->load->view('templates/main', $data);
	}

	public function LoadData()
	{
		$json = array(
			"aaData"  => $this->Customer_m->getAllData()
		);
		echo json_encode($json);
	}

	public function inputcustomer()
	{
		$this->Customer_m->Save();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Customer berhasil disimpan.</div>');
		redirect('customer/index');
	}

	public function detilcustomer($id = '')
	{
		$data = $this->Customer_m->Detail($id);
		echo json_encode($data);
	}

	public function editcustomer()
	{
		$this->Customer_m->Edit();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Customer berhasil diubah.</div>');
		redirect('customer/index');
	}

	public function hapuscustomer($id = '')
	{
		$this->Customer_m->Delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Customer berhasil dihapus.</div>');
	}

	public function cek_delete($id = '')
	{
		$data = $this->Customer_m->cekDelete($id);
		echo json_encode($data);
	}

	public function poin()
	{
		$data = array(
			'title'    => 'Customer Poin',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'customer/poin',
			'poin'	   => $this->Customer_m->getPoin()

		);
		$this->load->view('templates/main', $data);
	}

	public function riwayat_poin($kode)
	{
		$data = array(
			'title'    => 'Riwayat Poin',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'customer/riwayat',
			'poin'	   => $this->Customer_m->getRiwayat($kode)

		);
		$this->load->view('templates/main', $data);
	}
}
