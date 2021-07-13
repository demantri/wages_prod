<script>
    function tambahitem() {
        $('#form')[0].reset();
        $('#inputDataBarang').modal('show');
    }

    function edititem(e){
        $.ajax({
            url: base_url + "akun/getWhere/" + e,
            dataType: 'json',
            success: function(data){
                var val = data.data[0];
                $('#id').val(val.id);
                $('#kodeAkun').val(val.kode_akun);
                $('#namaAkun').val(val.nama_akun);
                $('#c_d').val(val.c_d);
                $('#kelompok').val(val.kelompok);
                $('#inputDataBarang').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                swal.fire({
                    title: xhr.status,
                    icon: 'warning',
                    text: 'GET '+ base_url +'akun/LoadData '+ xhr.status +' '+ thrownError
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
                    url: base_url + "akun/hapusitem/" + e,
                    type: "post",
                    success: function(data) {
                        window.location = base_url + "akun"
                    }
                })
            }
        })
    }
</script>