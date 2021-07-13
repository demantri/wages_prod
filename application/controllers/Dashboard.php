<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    cek_login();
    cek_user();
  }
  public function index()
  {
    $data = array(
      'title'      => 'Dashboard',
      'user'       => infoLogin(),
      'toko'       => $this->db->get('profil_perusahaan')->row(),
      'content'    => 'dashboard/index',
    );
    $this->load->view('templates/main', $data);
  }
}
