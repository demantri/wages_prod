<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data["title"] = "User Login";
            $data["toko"] =  $this->db->get('profil_perusahaan')->row();
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $pswd = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {

            if (password_verify($pswd, $user['password'])) {
                $data = [
                    'username'     => $user['username'],
                    'tipe'         => $user['tipe']
                ];

                $this->session->set_userdata($data);
                if ($user['tipe'] == 'Administrator') {
                    redirect('dashboard');
                } else {
                    redirect('penjualan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <b>Error :</b> Password Salah. </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade in" role="alert"><b>Error :</b> Username belum terdaftar. </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
       
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade in" role="alert"><b>Success :</b> Berhasil Logout. </div>');
        redirect('auth');
    }
    public function blocked()
    {
        $data = array(
            'user'    => infoLogin(),
            'title'   => 'Access Denied!',
            'toko'    =>  $this->db->get('profil_perusahaan')->row()
        );
        $this->load->view('auth/blocked', $data);
    }
}
