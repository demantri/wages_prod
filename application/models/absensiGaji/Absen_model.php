<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Absen_model extends CI_Model
{
    public function getAllKaryawan()
    {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('karyawan')->result_array();
    }

    public function getAllKaryawan2()
    {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('karyawan')->result_array();
    }

    public function getStatusAbsen()
    {
        $this->db->where('status', 1);
        return $this->db->get('status_absen')->result_array();
    }

    public function getAllKaryawanById($id)
    {
        return $this->db->get_where('karyawan', ['id' => $id])->row_array();
    }

    public function getAllKaryawanByCode($code)
    {
        return $this->db->get_where('karyawan', ['nik' => $code])->row_array();
    }

    public function addKaryawan($nik, $nama, $email, $telp, $alamat, $kelamin, $time, $qrName)
    {
        $data = [
            'nik' => $nik,
            'nama' => $nama,
            'email' => $email,
            'telp' => $telp,
            'kelamin' => $kelamin,
            'alamat' => $alamat,
            'time' => $time,
            'poto' => 'default.png',
            'qr' => $qrName
        ];
        return $this->db->insert('karyawan', $data);
    }

    public function editKaryawan($nama, $email, $telp, $alamat, $kelamin, $id)
    {
        $this->db->set([
            'nama' => $nama,
            'email' => $email,
            'telp' => $telp,
            'kelamin' => $kelamin,
            'alamat' => $alamat
        ]);
        $this->db->where('id', $id);
        return $this->db->update('karyawan');
    }


    public function getDataAbsen()
    {
        // Bulan sekarang
        $bulan = date('m');
        $this->db->where('month(masuk)', $bulan);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('data_absen')->result_array();
    }

    public function getDataAbsenByOrg($filter, $nik)
    {
        $bulan = date('m', strtotime($filter));
        $this->db->where('month(masuk)', $bulan);
        $this->db->where('nik', $nik);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('data_absen')->result_array();
    }

    public function getDataAbsenByAll($option, $filter)
    {
        if ($option == 1) {
            $bulan = date('m', strtotime($filter));
            $this->db->where('month(masuk)', $bulan);
            $this->db->order_by('id', 'DESC');
            return $this->db->get('data_absen')->result_array();
        } else {
            $hari = date('d', strtotime($filter));
            $this->db->where('day(masuk)', $hari);
            $this->db->order_by('id', 'DESC');
            return $this->db->get('data_absen')->result_array();
        }
    }

    public function jmlKaryawanMasuk()
    {
        $jam = time();
        $jadwal = $this->db->get_where('waktu_absen_sekarang', ['active' => 1])->row_array();
        $toleransi = strtotime($jadwal['toleransi']);
        $pulang = strtotime($jadwal['pulang']);
        if ($toleransi < $jam & $pulang > $jam) {
            $this->db->where('status', 1);
            $query = $this->db->get('data_absen_flash')->num_rows();
            return $query;
        } elseif ($pulang < $jam) {
            $masuk = $this->db->where('status', 1)->get('data_absen_flash')->num_rows();
            $masuk2 = $this->db->where('status', 2)->get('data_absen_flash')->num_rows();
            $hasil = (int) $masuk + (int) $masuk2;
            return $hasil;
        } else {
            return 0;
        }
    }

    public function dataAbsen($fr,$to,$nk)
    {
        $this->db->where('substr(masuk,1,10) >=', $fr);
        $this->db->where('substr(masuk,1,10) <=', $to);
        $this->db->where('nik', $nk);
        $this->db->where('status', 2);
        return $this->db->get('data_absen')->num_rows();
    }

    public function jmlKaryawanBolos()
    {
        $jam = time();
        $jadwal = $this->db->get_where('waktu_absen_sekarang', ['active' => 1])->row_array();
        $toleransi = strtotime($jadwal['toleransi']);
        $pulang = strtotime($jadwal['pulang']);
        if ($toleransi < $jam & $pulang > $jam) {
            $jmlAbsen = $this->db->where('status', 1)->get('data_absen_flash')->num_rows();
            $jmlKar = $this->db->get('karyawan')->num_rows();
            $hasil = (int) $jmlKar - (int) $jmlAbsen;
            return $hasil;
        } elseif ($pulang < $jam) {
            $masuk = $this->db->where('status', 1)->get('data_absen_flash')->num_rows();
            $masuk2 = $this->db->where('status', 2)->get('data_absen_flash')->num_rows();
            $dtMasuk = (int) $masuk + (int) $masuk2;
            $jmlKar1 = $this->db->get('karyawan')->num_rows();
            $dtHasil = (int) $jmlKar1 - (int) $dtMasuk;
            return $dtHasil;
        } else {
            return 0;
        }
    }
    public function getGajiId($dt)
    {
        $query = $this->db->get_where("\x67\x61\x6a\x69", array("\151\144" => $dt))->row_array();
        return $query;
    }
    public function getGaji()
    {
        $query =$this->db->get("\147\141\152\x69")->result_array();
        return $query;
    }
    public function getGajiByNk($dt)
    {
        $query = $this->db->get_where("\147\141\x6a\x69", array("\156\x69\x6b" => $dt))->result_array();
        return $query;
    }
    public function getGajiByDt($dt)
    {
        $query = $this->db->get_where("\x67\141\x6a\x69", array("\x74\x67\x6c" => $dt))->result_array();
        return $query;
    }


    public function akun()
    {
        $query = $this->db->get("\x61\153\165\156")->result_array();
        return $query;
    }
    public function akunId($dt)
    {
        $query = $this->db->get_where("\141\x6b\165\156", array("\151\x64" => $dt))->row_array();
        return $query;
    }
}
