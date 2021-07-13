<script>
    function pilihbarang(e) {
        $.ajax({
            url: base_url + "barang/detilbarang/" + e,
            type: "post",
            success: function(data) {
                var obj = JSON.parse(data);
                $('#namabarang').val(obj.nama_barang);
                $('#iditem').val(obj.id_barang);
                $('#kodebrg').val(obj.kode_barang);
                $('#generateBarcode').val(obj.barcode);
                $('#barcode_num').val(obj.barcode);

                var kode = $('#generateBarcode').val();
                var id = $('#iditem').val();
                var html = ' <img src="' + base_url + 'barcode/generate/' + kode + '" width="180">';
                $('.view-barcode').html('');
                $('.view-barcode').append(html);
            }
        })
    }

    function Generate() {
        var kode = $('#generateBarcode').val();
        var id = $('#iditem').val();
        var html = ' <img src="' + base_url + 'barcode/generate/' + kode + '" width="180">';
        $('.view-barcode').html('');
        $('.view-barcode').append(html);
    }

    function printBarcode() {
        $('#printBarcodeModal').modal('show');
    }
</script>