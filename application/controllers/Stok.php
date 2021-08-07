<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Stok_m');
    }
    public function index()
    {
        $data = array(
            'title'    => 'Stok Masuk',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'content'  => 'stok/index',
            'stok'     => $this->Stok_m->all_data()
        );
        $this->load->view('templates/main', $data);
    }


    public function input()
    {
		$kd_stok = $this->Stok_m->kd_stok();
		// print_r($kd_stok);exit;
        $data = array(
            'title'    => 'Input Stok Masuk',
            'user'     => infoLogin(),
            'content'  => 'stok/input',
            'toko'     => $this->db->get('profil_perusahaan')->row(),
			'kode'	   => $kd_stok
        );
        $this->load->view('templates/main', $data);
    }

    public function create()
    {
        $this->Stok_m->Save();
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Stok berhasil disimpan.</div>');
        redirect('stok');
    }


    public function hapus($id = '')
    {
        $this->Stok_m->Delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Stok berhasil dihapus.</div>');
    }
}
