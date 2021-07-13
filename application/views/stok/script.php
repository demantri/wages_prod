<script>
	function tampildata_brg() {
		$('#barang_operasional').DataTable({
			"bProcessing": true,
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sAjaxSource": base_url + 'barang/LoadData',
			"sAjaxDataProp": "aaData",
			"fnRender": function(oObj) {
				uss = oObj.aData["Username"];
			},
			"aoColumns": [{
					"mDataProp": "barcode",
					bSearchable: true
				},
				{
					"mDataProp": "nama_barang",
					bSearchable: true
				},
				{
					"mDataProp": "satuan",
					bSearchable: true
				},
				{
					"mDataProp": "harga_jual",
					bSearchable: true
				},
				{
					"mDataProp": function(data, type, val) {
						pKode = data.id_barang;
						var btn = '<a href="#" class="btn btn-primary btn-xs" data-dismiss="modal" title="Pilih Data" onclick="pilihbarang(' + pKode + ')"><i class="fa fa-check-square-o"></i> Select</a>';

						return (btn).toString();
					},
					bSortable: false,
					bSearchable: false
				}
			],
			"bDestroy": true,
		});
		$('#dialogBrg').modal('show');
	}

	function pilihbarang(e) {
		$.ajax({
			url: base_url + "barang/detilbarang/" + e,
			type: "post",
			success: function(data) {
				var obj = JSON.parse(data);
				$('#namabarang').val(obj.nama_barang);
				$('#iditem').val(obj.id_barang);
				$('#harga').val(obj.harga_beli);
				$('#stok').val(obj.stok);
			}
		})
	}

	function scanBarcode() {
		var key = $('#barcode');
		$.ajax({
			url: base_url + "barang/caribarang/" + key.val(),
			type: "post",
			success: function(data) {
				var obj = JSON.parse(data);
				$('#namabarang').val(obj.nama_barang);
				$('#stok').val(obj.stok);
				$('#iditem').val(obj.id_barang);
				$('#harga').val(obj.harga_beli);
			}
		})
	}

	function hapusStok(e) {
		Swal.fire({
			title: "Are you sure ?",
			text: "Deleted data can not be restored!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!"
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: base_url + "stok/hapus/" + e,
					type: "post",
					success: function(data) {
						window.location.href = base_url + "stok";
					}
				})
			}
		})
	}
</script>