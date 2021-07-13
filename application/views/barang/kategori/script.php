<script>
    function tambahkategori() {
        $('#inputKategoriModal').modal('show');
    }

    function editkategori(e) {
        $.ajax({
            url: base_url + "kategori/detilkategori/" + e,
            type: "post",
            success: function(data) {
                var obj = JSON.parse(data);
                $('#idkategori').val(obj.id_kategori);
                $('#editkategori').val(obj.kategori);

            }
        })
        $('#editKategoriModal').modal('show');
    }

    function hapuskategori(e) {
        $.ajax({
            url: base_url + "kategori/cek_delete/" + e,
            type: "post",
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.num == 1) {
                    Swal.fire({
                        title: "Cannot Delete This Data!",
                        text: "Please check your data relation!",
                        icon: "error",
                    });
                } else {
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
                                url: base_url + "kategori/hapuskategori/" + e,
                                type: "post",
                                success: function(data) {
                                    window.location = base_url + "kategori"
                                }
                            })
                        }
                    })
                }
            }
        });
    }
</script>