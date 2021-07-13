$(document).ready(function () {

    $('.print1').on('click', function () {

        var nik = $(this).data('nik');
        var filter = $(this).data('filter');
        var url = "./exExcel1.php";

        alert(url);


        $.ajax({
            url: url,
            type: 'POST',
            data: {
                filter: filter,
                nik: nik,
            },
            success: function () {
                document.location.href = url;
            }
        });
    });

});