<script>
    function tambahcustomer() {
        $('#inputCustomerModal').modal('show');
    }

    function editCustomer(e) {
        $.ajax({
            url: base_url + "customer/detilcustomer/" + e,
            type: "post",
            success: function(data) {
                var obj = JSON.parse(data);
                $('#idcustomer').val(obj.id_cs);
                $('#editnamacs').val(obj.nama_cs);
                $('#editkelamin').val(obj.jenis_kelamin);
                $('#editemailcs').val(obj.email);
                $('#edittelpcs').val(obj.telp);
                $('#editjenis').val(obj.jenis_cs);
                $('#editalamat').val(obj.alamat);
                $('#editCustomerModal').modal('show');
            }
        })
    }

    function hapusCustomer(e) {
        $.ajax({
            url: base_url + "customer/cek_delete/" + e,
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
                                url: base_url + "customer/hapuscustomer/" + e,
                                type: "post",
                                success: function(data) {
                                    window.location = base_url + "customer"
                                }
                            })
                        }
                    })
                }
            }
        });
    }

</script>