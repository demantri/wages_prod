<script>
    function tambahsatuan() {
        $('#inputSatuanModal').modal('show');
    }

    function editsatuan(e) {
        $.ajax({
            url: base_url + "satuan/detilsatuan/" + e,
            type: "post",
            success: function(data) {
                var obj = JSON.parse(data);
                $('#idsatuan').val(obj.id_satuan);
                $('#editsatuan').val(obj.satuan);
            }
        })
        $('#editSatuanModal').modal('show');
    }

    function hapussatuan(e) {
        $.ajax({
            url: base_url + "satuan/cek_delete/" + e,
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
                                url: base_url + "satuan/hapussatuan/" + e,
                                type: "post",
                                success: function(data) {
                                    window.location = base_url + "satuan"
                                }
                            })
                        }
                    })
                }
            }
        });
    }
</script>