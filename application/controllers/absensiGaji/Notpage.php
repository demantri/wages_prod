<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Notpage extends CI_Controller
{
    public function index()
    {
        $this->load->view('notpage');
    }
}