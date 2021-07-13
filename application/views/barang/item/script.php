<script>
    function tambahitem() {
        $('#inputDataBarang').modal('show');
    }

    function hapusbarang(e) {
        Swal.fire({
            title: "Anda Yakin ?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + "barang/hapusbarang/" + e,
                    type: "post",
                    success: function(data) {
                        window.location = base_url + "barang/index"
                    }
                })
            }
        })
    }
</script>