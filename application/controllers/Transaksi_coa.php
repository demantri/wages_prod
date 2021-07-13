<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_coa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
        $this->load->model('TransaksiCoa_m');
	}
	public function index()
	{
		$data = array(
			'title'    => 'Transaksi Coa',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'transaksi_coa/index',
			'item'	   => $this->TransaksiCoa_m->getAllData(),
			'akun'     => $this->db->get('akun')
		);
		$this->load->view('templates/main', $data);
	}

	public function LoadData()
	{
		$json = array(
			"aaData"  => $this->TransaksiCoa_m->getAllData()
		);
		echo json_encode($json);
    }
    
    public function getWhere($id){
        $json = [
            'data' => $this->TransaksiCoa_m->getWhere($id)
        ];

        echo json_encode($json);
    }

	public function inputakun()
	{
		$this->TransaksiCoa_m->Save();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Barang berhasil disimpan.</div>');
		redirect('transaksi_coa');
	}
	
	public function hapusitem($id = '')
	{
		$this->TransaksiCoa_m->Delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Barang berhasil dihapus.</div>');
	}

}