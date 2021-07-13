<?php
$this->load->view('templates/pos_header');
$this->load->view('templates/pos_sidebar');
$this->load->view('templates/pos_topbar');
$this->load->view($content);
$this->load->view('templates/pos_footer');