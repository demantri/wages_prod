function diskon() {
	var qty = $('#detilqty');
	var diskon = $('#detildiskonitem');
	var subtotal = $('#detiltotalitem');
	var peritem = $('#hargadetilitem');
	qty.keyup(function () {
		var jum = document.getElementById('detilqty').value;
		if (jum == null) {
			subtotal.val(subtotal.val());
		} else {
			var total = peritem.val() * qty.val();
			subtotal.val(total);
		}
	});
	diskon.keyup(function () {
		var disk = document.getElementById('detildiskonitem').value;
		if (disk == null) {
			subtotal.val(subtotal.val());
		} else {
			var total = peritem.val() * qty.val();
			var hargaakhir = total - diskon.val();
			subtotal.val(hargaakhir);
		}
	})
}
function invoice() {
	$.ajax({
		url: base_url + "penjualan/kodeinvoice",
		type: "post",
		success: function (data) {
			var obj = JSON.parse(data);
			$('#invoice').text(obj);
		}
	})
}

function totalbayar() {
	var grand = $('#grandtotal');
	var bayar = $('#bayar');
	bayar.keyup(function () {
		var byr = document.getElementById('bayar').value;
		if (byr == null) {
			var nilai = 0;
			byr = nilai;
		} else {
			var hasil = bayar.val() - grand.val();
			$('#kembali').val(hasil);
		}
	})
}

$('.loading').hide();

$('#form-data').submit(function(e){
	var tgl_awal = $('#awal').val(), tgl_akhir = $('#akhir').val();
	e.preventDefault();
	$('.loading').show();
	laporanPenjualan(tgl_awal, tgl_akhir);
})

function laporanPenjualan(tgl_awal, tgl_akhir){
	$.ajax({
		url: base_url + 'laporan/dataPenjualan',
		data: {tgl_awal: tgl_awal, tgl_akhir: tgl_akhir},
		dataType: 'html',
		success: function(data){
			$('.loading').hide();
			$('#viewData-laporan').html(data);
			$('#laporan-dataTable').DataTable();
			
			$('.action').click(function(){
				let id = $(this).data('id');
				$.ajax({
					url: base_url + 'laporan/detail_penjualan',
					data: {id: id},
					dataType: 'html',
					success: function(data){
						$('#viewData').html(data);
					}
				})
			});
		},
		error: function(xhr, ajaxOptions, thrownError){
			swal.fire({
				title: xhr.status,
				icon: 'warning',
				text: thrownError
			});
		}
	})
}

$('#laporan-dataTable').DataTable();