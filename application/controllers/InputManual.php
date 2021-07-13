<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputManual extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_user();
        $this->load->model('InputManual_m');
    }

    public function pemodalan()
    {
        $data = array(
            'title'    => 'Input Pemodalan',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'content'  => 'input_manual/pemodalan',
            'akun'     => $this->InputManual_m->getPemodalan()
        );
        $this->load->view('templates/main', $data);
    }

    public function postPemodalan()
    {
        $this->InputManual_m->Save('pemodalan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Barang berhasil disimpan.</div>');
        redirect('inputManual/pemodalan');
    }

    public function pembebanan()
    {
        $data = array(
            'title'    => 'Input Pembebanan',
            'user'     => infoLogin(),
            'toko'     => $this->db->get('profil_perusahaan')->row(),
            'content'  => 'input_manual/pembebanan',
            'akun'     => $this->InputManual_m->getPembebanan()
        );
        $this->load->view('templates/main', $data);
    }

    public function postPembebanan()
    {
        $this->InputManual_m->Save('pembebanan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button><b>Success!</b> Data Barang berhasil disimpan.</div>');
        redirect('inputManual/pembebanan');
    }

}