<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_m extends CI_Model
{

    protected $table = 'penjualan';
    protected $primary = 'id_jual';

    public function getAllData()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function getDetilJual()
    {
        $sql = "SELECT a.id_detil_jual, b.barcode, b.nama_barang, b.harga_jual, a.qty_jual, a.diskon, a.subtotal 
		FROM detil_penjualan a, barang b 
		WHERE b.id_barang = a.id_barang 
		AND a.id_jual IS NULL";
        return $this->db->query($sql)->result_array();
    }

	public function cobadetil()
	{
		$sql = "SELECT a.id_detil_jual, b.barcode, b.nama_barang, b.harga_jual, a.qty_jual, a.diskon, a.subtotal 
		FROM detil_penjualan a, barang b 
		WHERE b.id_barang = a.id_barang 
		AND a.id_jual IS NULL";
        return $this->db->query($sql)->result();
	}


    public function addItem($id, $qty, $subtotal, $harga)
    {
        $this->db->select("RIGHT (detil_penjualan.kode_detil_jual, 7) as kode_detil_jual", false);
        $this->db->order_by("kode_detil_jual", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('detil_penjualan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_detil_jual) + 1;
        } else {
            $kode = 1;
        }
        $kodedetil = str_pad($kode, 7, "0", STR_PAD_LEFT);
        $detiljual = "DJ-" . $kodedetil;

        $data = array(
            'id_barang'           => $id,
            'kode_detil_jual'     => $detiljual,
            'diskon'              => 0,
            'harga_item'          => $harga,
            'qty_jual'            => $qty,
            'subtotal'            => $subtotal,

        );
        $this->db->insert('detil_penjualan', $data);

        $sqlstok = "select stok from barang where id_barang = '$id'";
        $stok = implode($this->db->query($sqlstok)->row_array());
        $hasil = $stok - $qty;
        $update = "update barang set stok = '$hasil' where id_barang = '$id'";
        $this->db->query($update);

        $data_trans = [
            'id_barang' => $id,
            'jenis' => 'Stok Keluar',
            'jml' => $qty,
            'stok_akhir' => $hasil,
        ];
        $this->db->insert('transaksi', $data_trans);

        $sql = "SELECT sum(subtotal) as subtotal FROM detil_penjualan WHERE id_jual IS NULL";
        $data = $this->db->query($sql)->row_array();
        echo json_encode($data);
    }

    public function editDetailPenjualan($id, $diskon, $qty, $hakhir)
    {
        $data = array(
            'diskon'     => $diskon,
            'qty_jual'   => $qty,
            'subtotal'   => $hakhir,
        );
        return $this->db->set($data)->where('id_detil_jual', $id)->update('detil_penjualan');
    }

    public function hapusDetail($id)
    {
        $getDetil = $this->db->get_where('detil_penjualan', ['id_detil_jual' => $id])->row_array();
        $qty = $getDetil['qty_jual'];
        $idBrg = $getDetil['id_barang'];

        if ($idBrg != NULL) {

            $getBrg = $this->db->get_where('barang', ['id_barang' => $idBrg])->row_array();
            $stokBrg = $getBrg['stok'];
            $stok = $qty + $stokBrg;
            $updateStok = $this->db->set(array('stok' => $stok))->where('id_barang', $idBrg)->update('barang');
        }
        $sql = "delete from detil_penjualan where id_detil_jual = '$id'";
        $this->db->query($sql);

        $subtotal = "SELECT sum(subtotal) as subtotal FROM detil_penjualan WHERE id_jual IS NULL";
        $data = $this->db->query($subtotal)->row_array();
        echo json_encode($data);
    }

    public function simpanPenjualan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $kodeinvoice = "SPT" . date('YmdHis');

        $this->db->select("RIGHT (penjualan.kode_jual, 7) as kode_jual", false);
        $this->db->order_by("kode_jual", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('penjualan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_jual) + 1;
        } else {
            $kode = 1;
        }
        $kodejual = str_pad($kode, 7, "0", STR_PAD_LEFT);
        $kodepenjualan = "KJ-" . $kodejual;
        $kembalian = $this->input->post('kembali');
        $bayar = $this->input->post('bayar');
        $metode = $this->input->post('metode');

        if ($kembalian < 0) {
            $kembalian = 0;
        }

        $data = array(
            'id_user'     => $this->input->post('kasir'),
            'id_cs'       => $this->input->post('cus'),
            'kode_jual'   => $kodepenjualan,
            'invoice'     => $kodeinvoice,
            'method'      => $metode,
            'bayar'       => $bayar,
            'kembali'     => $kembalian,
            'tgl'         => date('Y-m-d H:i:s'),

        );
        $this->db->insert('penjualan', $data);
        $idjual = "select max(id_jual) as id_jual from penjualan";
        $id = implode($this->model->General($idjual)->row_array());
        $sql = "update detil_penjualan set id_jual = '$id' where id_jual is null";
        $this->db->query($sql);

        $this->db->select(['sum(a.subtotal) as total_jual']);
        $this->db->from('detil_penjualan a');
        $this->db->join('barang b', 'b.id_barang=a.id_barang', 'inner');
        $this->db->where(['a.id_jual' => $id]);
        $a = $this->db->get();
        $a = $a->row();
        
        $harga_jual = $a->total_jual;
        // print_r($harga_jual);exit;
        $j_d = [
            'id_transaksi' => $kodepenjualan,
            'tgl_jurnal' => date('Y-m-d'),
            'no_coa' => 111,
            'posisi_dr_cr' => 'd',
            'nominal' => $harga_jual,
        ];
        $this->db->insert('jurnal', $j_d);

        $j_k = [
            'id_transaksi' => $kodepenjualan,
            'tgl_jurnal' => date('Y-m-d'),
            'no_coa' => 411,
            'posisi_dr_cr' => 'k',
            'nominal' => $harga_jual,
        ];
        $this->db->insert('jurnal', $j_k);

        // $this->db->select(['a.id',]);
        // $this->db->from('transaksi_coa b');
        // $this->db->join('akun a', 'a.id=b.id_akun', 'inner');
        // $this->db->where(['b.transaksi' => 'penjualan']);
        // $akun = $this->db->get();

        // foreach($akun->result() as $i){
        //     if(strcmp($i->kelompok, 1) == 0){
        //         $nominal = $harga_jual;
        //     } else {
        //         $nominal = $harga_jual;
        //     }

        //     $this->db->insert('jurnal_umum', [
        //         'transaksi' => 'penjualan',
        //         'id_akun' => $i->id,
        //         'tgl' => date('Y-m-d'),
        //         'nominal' => $nominal
        //     ]);
        // }

		//stock card
        $this->db->where('id_jual', $id );
        $list_data = $this->db->get('detil_penjualan')->result_array();

        foreach ($list_data as $data) {

            $pengurang = $data['qty_jual'];
            $id_barang = $data['id_barang'];

            $query111 = "SELECT * FROM transaksi WHERE jenis = 'Stok Masuk' AND id_barang = '$id_barang' AND  stok_akhir > 0 ORDER by id ASC";
            $row = $this->db->query($query111)->result_array();

            foreach($row as $row) {

              $tgl  = $row['id'];
              $stok = $row['stok_akhir'];
                if($pengurang > 0) { 
                    $temp = $pengurang;
                    $pengurang = $pengurang - $stok;
                    if($pengurang > 0) {      
                        $stok_update = 0;
                    }else{
                        $stok_update = $stok - $temp;
                    }
                $this->db->set('stok_akhir', $stok_update);
                $this->db->where('id_barang', $id_barang);
                $this->db->where('jenis', "Stok Masuk");
                $this->db->where('id', $tgl);
                $this->db->update('transaksi');
                }
            }
        }

        //
        // $this->db->where('kode_detil_jual', $detiljual);
        // $val0 = $this->db->get('detil_penjualan')->result_array();
        $query1 = "SELECT id_barang, id_jual, sum(qty_jual) qty_jual, sum(subtotal) subtotal, harga_item
		FROM detil_penjualan
		WHERE id_jual = '$id'
		GROUP BY id_barang";
        $val0 = $this->db->query($query1)->result_array(); 
        foreach ($val0 as $data) {
            $this->db->where('id_barang', $data['id_barang']);
            $this->db->where('stok_akhir >', 0);
            $this->db->where('jenis', "Stok Masuk");
            $val1 = $this->db->get('transaksi');

            if($val1->num_rows() > 0){
                foreach ($val1->result_array() as $data1){
                $brg1 = $data1['id_barang'];
                $this->db->where('id_barang', $brg1);
                $harga = $this->db->get('barang')->row()->harga_sales;
                $d1 = array(
					'no_trans' => $kodepenjualan,
					'id_barang' => $brg1,
					'unit1' => '-',
					'harga1' => '-',
					'total1' => '-',
					'unit2' => '-',
					'harga2' => '-',
					'total2' => '-',
					'unit3' => $data1['stok_akhir'],
					'harga3' => $harga,
					'total3' => $data1['stok_akhir'] * $harga
				);
                $this->db->insert('table_stock_card', $d1);
                }
                //
                $this->db->where('no_trans', $kodepenjualan);
                $this->db->where('id_barang', $data['id_barang']);
                $this->db->order_by('no ASC');
                $cek_no = $this->db->get('table_stock_card')->row_array()['no'];
                //
               
                $this->db->where('no', $cek_no);
                $this->db->set('unit2', $data['qty_jual']);
                $this->db->set('harga2', $data['harga_item']);
                $this->db->set('total2', $data['subtotal']);
                $this->db->update('table_stock_card');
                   
                
                    
            }else{
                $d1 = array(
                    'no_trans' => $kodepenjualan,
                    'id_barang'   => $data['id_barang'],
                    'unit1'     => '-',
                    'harga1'    => '-',
                    'total1'    => '-',
                    'unit2'     => $data['qty_jual'],
                    'harga2'    => $data['harga_item'],
                    'total2'    => $data['subtotal'],
                    'unit3'     => $data['qty_jual'],
                    'harga3'    => $data['harga_item'],
                    'total3'    => $data['subtotal'], 
                );
                $this->db->insert('table_stock_card', $d1);
            }
        }


    }

    public function detilItemJual($id)
    {
        $sql = "SELECT a.id_detil_jual, b.barcode, b.id_barang, b.nama_barang, b.harga_jual, a.qty_jual, a.diskon, 
		a.subtotal FROM detil_penjualan a, barang b WHERE b.id_barang = a.id_barang AND a.id_detil_jual = '$id'";
        $data = $this->model->General($sql)->row_array();
        echo json_encode($data);
    }
    public function detilServisJual($id)
    {
        $sql = "SELECT a.id_detil_jual, b.kode, b.id_servis, b.nama_servis, a.harga_item, a.qty_jual, 
		a.subtotal FROM detil_penjualan a, servis b WHERE b.id_servis = a.id_servis AND a.id_detil_jual = '$id'";
        $data = $this->model->General($sql)->row_array();
        echo json_encode($data);
    }

    public function editServisJual($id, $harga, $subtotal)
    {
        $data = array(
            'harga_item' => $harga,
            'subtotal'   => $subtotal,
        );
        return $this->db->set($data)->where('id_detil_jual', $id)->update('detil_penjualan');
    }
}
