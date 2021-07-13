<script>
    function detilJual(e) {
        var produk = '';
        var servis = '';

        $.ajax({
            url: base_url + "dpenjualan/detilPenjualan/" + e,
            type: "post",
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.length < 1) {
                    $('.tabel-produk').hide();
                } else {
                    $('.tabel-produk').show();
                }
                for (var i = 0; i < obj.length; i++) {
                    produk += '<tr><td>' + obj[i].kode_detil_jual + '</td>' +
                        '<td>' + obj[i].barcode + '</td>' +
                        '<td>' + obj[i].nama_barang + '</td>' +
                        '<td>' + obj[i].harga_item + '</td>' +
                        '<td>' + obj[i].qty_jual + '</td>' +
                        '<td>' + obj[i].diskon + '</td>' +
                        '<td>' + obj[i].subtotal + '</td>'
                    '</tr>';
                }

                $('#detilpenjualan').html(produk);
                $('#detilPenjualanModal').modal('show');
            }
        })
    }

    function cetakResi(e) {
        window.location.href = base_url + "report/struk_penjualan/" + e;
    }
</script>