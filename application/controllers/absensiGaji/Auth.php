<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller
{
    // function __construct()
    // {
    //     parent::__construct();
    //     $this->db = $this->load->database('second', TRUE);
    // } 

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('absensiGaji/admin');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', [
            'required' => '%s harus di input',
            'valid_email' => '%s tidak valid'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => '%s harus di input'
        ]);

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('user2', ['role_id' => 1])->row_array();
            $data['judul'] = 'Login';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('template/auth_footer', $data);
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user2', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('login', 'LogIn');
                    redirect('absensiGaji/admin');
                } else {
                    $this->session->set_flashdata('gagal', 'Password / Email Salah');
                    redirect('absensiGaji/auth');
                }
            } else {
                $this->session->set_flashdata('gagal', 'Akun belum di aktivasi!');
                redirect('absensiGaji/auth');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Password / Email Salah!');
            redirect('absensiGaji/auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        redirect('absensiGaji/auth');
    }
}