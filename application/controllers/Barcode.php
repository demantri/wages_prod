<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barcode extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->library('Zend');
		$this->load->model('Barang_m');
	}

	public function index()
	{
		$this->form_validation->set_rules('barcode', 'BarcodeID', 'required|trim|is_unique[barang.barcode]');
		if ($this->form_validation->run() == false) {
			$data = array(
				'title'    => 'Generate Barcode',
				'user'     => infoLogin(),
				'kategori' => $this->db->get('kategori')->result_array(),
				'satuan'   => $this->db->get('satuan')->result_array(),
				'toko'     => $this->db->get('profil_perusahaan')->row(),
				'content'  => 'barcode/index',
				'item'	   => $this->Barang_m->getAllData()
			);
			$this->load->view('templates/main', $data);
		} else {
			$this->updateBarcode();
		}
	}

	public function generate($kode = '')
	{
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('ean13', 'image', array('text' => $kode));
	}

	private function updateBarcode()
	{
		$id = $this->input->post('iditem');
		$kode = htmlspecialchars($this->input->post('barcode'), true);
		$data = array('barcode' => $kode);
		$this->model->Edit('id_barang', $id, $data, 'barang');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Barcode berhasil diupdate.</div>');
		redirect('barcode/index');
	}
}
