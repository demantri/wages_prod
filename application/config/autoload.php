<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database', 'email', 'session', 'datatables', 'fpdf', 'form_validation');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'file', 'security', 'pos', 'download', 'soerawung_helper');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('model', 'Absen_model', 'Waktu_model');
