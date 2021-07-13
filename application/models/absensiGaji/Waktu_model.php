<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Waktu_model extends CI_Model
{
    public function hari($hari)
    {
        $nama_hari = $hari;
        switch ($nama_hari) {
            case 'Sun':
                $n_hari = 'Minggu';
                break;
            case 'Mon':
                $n_hari = 'Senin';
                break;
            case 'Tue':
                $n_hari = 'Selasa';
                break;
            case 'Wed':
                $n_hari = 'Rabu';
                break;
            case 'Thu':
                $n_hari = 'Kamis';
                break;
            case 'Fri':
                $n_hari = 'Jumat';
                break;
            case 'Sat':
                $n_hari = 'Sabtu';
                break;
            default:
                $n_hari = 'Tidak diketahui';
                break;
        }

        return $n_hari;
    }

    public function bulan($bulan)
    {
        $nama_bulan = $bulan;
        switch ($nama_bulan) {
            case 'Jan':
                $n_bulan = 'Januari';
                break;
            case 'Feb':
                $n_bulan = 'Pebruari';
                break;
            case 'Mar':
                $n_bulan = 'Maret';
                break;
            case 'Apr':
                $n_bulan = 'April';
                break;
            case 'May':
                $n_bulan = 'Mei';
                break;
            case 'Jun':
                $n_bulan = 'Juni';
                break;
            case 'Jul':
                $n_bulan = 'Juli';
                break;
            case 'Aug':
                $n_bulan = 'Agustus';
                break;
            case 'Sep':
                $n_bulan = 'September';
                break;
            case 'Oct':
                $n_bulan = 'Oktober';
                break;
            case 'Nov':
                $n_bulan = 'Nopember';
                break;
            case 'Dec':
                $n_bulan = 'Desember';
                break;
            default:
                $n_bulan = 'Tidak diketahui';
                break;
        }
        return $n_bulan;
    }
}