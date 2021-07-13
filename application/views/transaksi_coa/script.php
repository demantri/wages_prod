<script>
    function tambahitem() {
        $('#form')[0].reset();
        $('#inputDataBarang').modal('show');
    }

    function edititem(e){
        $.ajax({
            url: base_url + "transaksi_coa/getWhere/" + e,
            dataType: 'json',
            success: function(data){
                var val = data.data[0];
                $('#id').val(val.id);
                $('#transaksi').val(val.transaksi);
                $('#id_akun').val(val.id_akun);
                $('#posisi').val(val.posisi);
                $('#inputDataBarang').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                swal.fire({
                    title: xhr.status,
                    icon: 'warning',
                    text: 'GET '+ base_url +'transaksi_coa/LoadData '+ xhr.status +' '+ thrownError
                });
            }
        })
    }

    function hapusitem(e) {
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
                    url: base_url + "transaksi_coa/hapusitem/" + e,
                    type: "post",
                    success: function(data) {
                        window.location = base_url + "transaksi_coa"
                    }
                })
            }
        })
    }
</script>