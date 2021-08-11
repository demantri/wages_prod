<?php 

	function format_rp($a){
		if(!is_numeric($a)) return NULL;
		$jumlah_desimal="0";
		$pemisah_desimal="";
		$pemisah_ribuan=".";
		$angka="Rp ".number_format($a, $jumlah_desimal, $pemisah_desimal,$pemisah_ribuan);
		return $angka;
	}

	function format_rp_js($a){
		if(!is_numeric($a)) return NULL;
		$jumlah_desimal="0";
		$pemisah_desimal="";
		$pemisah_ribuan=".";
		$angka= number_format($a, $jumlah_desimal, $pemisah_desimal,$pemisah_ribuan);
		return $angka;
	}

	function format_angka($a){
	 	$angka = preg_replace("/[^0-9]/", "", $a);
		return $angka*1;
	}

	if (!function_exists('format_date')) {
  		function format_date($date)
 		 {
		    // array hari dan bulan
		    // $Hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		    $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		    // pemisahan tahun, bulan, hari, dan waktu
		    $tahun = substr($date, 0, 4);
		    $bulan = substr($date, 5, 2);
		    $tgl = substr($date, 8, 2);
		    $waktu = substr($date, 11, 5);
		    $hari = date("w", strtotime($date));
		    $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun;

		    return $result;
		  }
		}

?>
