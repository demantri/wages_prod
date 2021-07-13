<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('Akun_m');
	}
	public function index()
	{
		$data = array(
			'title'    => 'Akun',
			'user'     => infoLogin(),
			'toko'     => $this->db->get('profil_perusahaan')->row(),
			'content'  => 'akun/index',
			'item'	   => $this->Akun_m->getAllData()
		);
		$this->load->view('templates/main', $data);
	}

	public function LoadData()
	{
		$json = array(
			"aaData"  => $this->Akun_m->getAllData()
		);
		echo json_encode($json);
    }
    
    public function getWhere($id){
        $json = [
            'data' => $this->Akun_m->getWhere($id)
        ];

        echo json_encode($json);
    }

	public function inputakun()
	{
		$this->Akun_m->Save();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Akun berhasil disimpan.</div>');
		redirect('akun/index');
	}
	
	public function hapusitem($id = '')
	{
		$this->Akun_m->Delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Akun berhasil dihapus.</div>');
	}

}