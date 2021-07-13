
var tableCustomer = $('#datacustomer').DataTable({
	"bProcessing": true,
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sAjaxSource": base_url + 'customer/LoadData',
	"sAjaxDataProp": "aaData",
	"fnRender": function (oObj) {
		uss = oObj.aData["Username"];
	},
	"aoColumns": [{
			"mDataProp": "kode_cs",
			bSearchable: true
		},
		{
			"mDataProp": "nama_cs",
			bSearchable: true
		},
		{
			"mDataProp": "telp",
			bSearchable: true
		},
		{
			"mDataProp": "email",
			bSearchable: true
		},
		{
			"mDataProp": "alamat",
			bSearchable: true
		},
		{
			"mDataProp": "jenis_cs",
			bSearchable: true
		},
		{
			"mDataProp": function (data, type, val) {
				pKode = data.id_cs;
				var btn = '<a href="#" class="btn btn-primary btn-xs" title="Edit Data" onclick="editCustomer(' + pKode + ')"><i class="fa fa-edit"></i></a> \n\ <a href="#" class="btn btn-danger btn-xs" title="Hapus Data" onclick="hapusCustomer(' + pKode + ')"><i class="fa fa-trash "></i></a>';

				return (btn).toString();
			},
			bSortable: false,
			bSearchable: false
		}
	],
	"bDestroy": true,
});
var tableKategori = $('#datakategori').DataTable({
	"bProcessing": true,
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sAjaxSource": base_url + 'kategori/LoadData',
	"sAjaxDataProp": "aaData",
	"fnRender": function (oObj) {
		uss = oObj.aData["Username"];
	},
	"aoColumns": [{
			"mDataProp": "kategori",
			bSearchable: true
		},
		{
			"mDataProp": function (data, type, val) {
				pKode = data.id_kategori;
				var btn = '<a href="#" class="btn btn-primary btn-xs" title="Edit Data" onclick="editkategori(' + pKode + ')"><i class="fa fa-edit"></i></a> \n\ <a href="#" class="btn btn-danger btn-xs" title="Hapus Data" onclick="hapuskategori(' + pKode + ')"><i class="fa fa-trash "></i></a>';

				return (btn).toString();
			},
			bSortable: false,
			bSearchable: false
		}
	],
	"bDestroy": true,
});
var tableSatuan = $('#datasatuan').DataTable({
	"bProcessing": true,
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sAjaxSource": base_url + 'satuan/LoadData',
	"sAjaxDataProp": "aaData",
	"fnRender": function (oObj) {
		uss = oObj.aData["Username"];
	},
	"aoColumns": [{
			"mDataProp": "satuan",
			bSearchable: true
		},
		{
			"mDataProp": function (data, type, val) {
				pKode = data.id_satuan;
				var btn = '<a href="#" class="btn btn-primary btn-xs" title="Edit Data" onclick="editsatuan(' + pKode + ')"><i class="fa fa-edit"></i></a> \n\ <a href="#" class="btn btn-danger btn-xs" title="Hapus Data" onclick="hapussatuan(' + pKode + ')"><i class="fa fa-trash "></i></a>';

				return (btn).toString();
			},
			bSortable: false,
			bSearchable: false
		}
	],
	"bDestroy": true,
});
var tableUser = $('#datauser').DataTable({
	"bProcessing": true,
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sAjaxSource": base_url + 'user/LoadData',
	"sAjaxDataProp": "aaData",
	"fnRender": function (oObj) {
		uss = oObj.aData["Username"];
	},
	"aoColumns": [{
			"mDataProp": "username",
			bSearchable: true
		},
		{
			"mDataProp": "tipe",
			bSearchable: true
		},
		{
			"mDataProp": "nama_lengkap",
			bSearchable: true
		},
		{
			"mDataProp": "alamat_user",
			bSearchable: true
		},
		{
			"mDataProp": "telp_user",
			bSearchable: true
		},
		{
			"mDataProp": "email_user",
			bSearchable: true
		},
		{
			"mDataProp": function (data, type, val) {
				pKode = data.id_user;
				var btn = '<a href="#" class="btn btn-primary btn-xs" title="Edit Data" onclick="edituser(' + pKode + ')"><i class="fa fa-edit"></i></a> \n\ <a href="#" class="btn btn-danger btn-xs" title="Hapus Data" onclick="hapususer(' + pKode + ')"><i class="fa fa-trash "></i></a>';

				return (btn).toString();
			},
			bSortable: false,
			bSearchable: false
		}
	],
	"bDestroy": true,
});
var dPenjualan = $('#daftarjual').DataTable({
	"bProcessing": true,
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sAjaxSource": base_url + 'dpenjualan/LoadData',
	"sAjaxDataProp": "aaData",
	"fnRender": function (oObj) {
		uss = oObj.aData["Username"];
	},
	"aoColumns": [{
			"mDataProp": "invoice",
			bSearchable: true
		},

		{
			"mDataProp": "nama_lengkap",
			bSearchable: true
		},
		{
			"mDataProp": "nama_cs",
			bSearchable: true
		},
		{
			"mDataProp": "diskon",
			bSearchable: true
		},
		{
			"mDataProp": "total",
			bSearchable: true
		},
		{
			"mDataProp": "method",
			bSearchable: true
		},
		{
			"mDataProp": "qty",
			bSearchable: true
		},
		{
			"mDataProp": "tgl",
			bSearchable: true
		},
		{
			"mDataProp": function (data, type, val) {
				pKode = data.id_jual;
				var btn = '<a href="#" class="btn btn-primary btn-xs" title="Detail Data" onclick="detilJual(' + pKode + ')"><i class="fa fa-search-plus"></i></a> \n\ <a href="#" class="btn btn-success btn-xs" title="Print Resi" onclick="cetakResi(' + pKode + ')"><i class="fa fa-print"></i></a>';
				return (btn).toString();
			},
			bSortable: false,
			bSearchable: false
		}
	],
	"bDestroy": true,
});;

var TableAkun = $('#AkunDataTable').DataTable({
	"bProcessing": true,
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sAjaxSource": base_url + 'Akun/LoadData',
	"sAjaxDataProp": "aaData",
	"fnRender": function (oObj) {
		uss = oObj.aData["Username"];
	},
	"aoColumns": [
		{
			"mDataProp": null,
			bSearchable: false,
			orderable: false,
			width: '1%',
			sClass: 'text-center',
			render: function(data, type, row, meta){
				return meta.row + meta.settings._iDisplayStart + 1;
			}
		},
		{
			"mDataProp": "kode_akun",
			bSearchable: true
		},
		{
			"mDataProp": "nama_akun",
			bSearchable: true
		},
		{
			"mDataProp": "c_d",
			bSearchable: false,
			mRender: function(data){
				if(data == 'c'){
					return "Credit";
				} else {
					return "Debit";
				}
			}
		},
		{
			"mDataProp": function (data, type, val) {
				var pKode = data.id;
				var btn = '<a href="#" class="btn btn-warning btn-xs" title="Edit Item" onclick="edititem(' + pKode + ')"><i class="fa fa-pencil"></i></a> \n\ <a href="#" class="btn btn-danger btn-xs" title="Hapus Akun" onclick="hapusitem(' + pKode + ')"><i class="fa fa-trash"></i></a>';
				return (btn).toString();
			},
			bSortable: false,
			bSearchable: false
		}
	],
	"bDestroy": true,
});

var TableTransaksiCoa = $('#TCoaDataTable').DataTable({
	"bProcessing": true,
	"bJQueryUI": true,
	"sPaginationType": "full_numbers",
	"sAjaxSource": base_url + 'transaksi_coa/LoadData',
	"sAjaxDataProp": "aaData",
	"fnRender": function (oObj) {
		uss = oObj.aData["Username"];
	},
	"aoColumns": [
		{
			"mDataProp": null,
			bSearchable: false,
			orderable: false,
			width: '1%',
			sClass: 'text-center',
			render: function(data, type, row, meta){
				return meta.row + meta.settings._iDisplayStart + 1;
			}
		},
		{
			"mDataProp": "transaksi",
			bSearchable: true
		},
		{
			"mDataProp": "nama_akun",
			bSearchable: true
		},
		{
			"mDataProp": "kode_akun",
			bSearchable: false,
		},
		{
			"mDataProp": "posisi",
			bSearchable: false,
			render: function(data){
				if(data == 'c'){
					return "Credit";
				} else {
					return "Debit";
				}
			}
		},
		{
			"mDataProp": function (data, type, val) {
				var pKode = data.id;
				var btn = '<a href="#" class="btn btn-warning btn-xs" title="Edit Item" onclick="edititem(' + pKode + ')"><i class="fa fa-pencil"></i></a> \n\ <a href="#" class="btn btn-danger btn-xs" title="Hapus Akun" onclick="hapusitem(' + pKode + ')"><i class="fa fa-trash"></i></a>';
				return (btn).toString();
			},
			bSortable: false,
			bSearchable: false
		}
	],
	"bDestroy": true,
});