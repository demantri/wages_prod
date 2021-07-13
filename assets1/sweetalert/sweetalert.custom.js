
// pesan berhasil
const pesan = $('.berhasil').data('flashdata');
if (pesan) {
    Swal.fire({
        title: 'Berhasil',
        text: pesan,
        type: 'success',

    });
}



// pesan gagal
const pesan1 = $('.gagal').data('flashdata');
if (pesan1) {
    Swal.fire({
        title: 'Oops....!',
        text: pesan1,
        type: 'error',

    });
}

// pesan Warning
const pesan3 = $('.warning').data('flashdata');
if (pesan3) {
    Swal.fire({
        title: 'Oops....!',
        text: pesan3,
        type: 'warning',

    });
}

// pesan berhasil Absen
const lolos = $('.lolos-absen').data('flashdata');
if (lolos) {
    const inptBrcode = $('#scanBarcode');
    inptBrcode.focus();
    Swal.fire({
        title: 'Berhasil',
        text: lolos,
        type: 'success',
        showConfirmButton: false,
        timer: 3500
    });
}

// pesan gagal Absen
const gagal = $('.gagal-absen').data('flashdata');
if (gagal) {
    const inptBrcode = $('#scanBarcode');
    inptBrcode.focus();
    Swal.fire({
        title: 'Oops....!',
        text: gagal,
        type: 'error',
        showConfirmButton: false,
        timer: 3500
    });
}

// pesan gagal Absen
const warning = $('.warning-absen').data('flashdata');
if (warning) {
    const inptBrcode = $('#scanBarcode');
    inptBrcode.focus();
    Swal.fire({
        title: 'Oops....!',
        text: warning,
        type: 'warning',
        showConfirmButton: false,
        timer: 3500
    });
}






// pesan ubah Thema
const pesan2 = $('.ok').data('flashdata');
if (pesan2) {
    Swal.fire({
        position: 'top',
        type: 'warning',
        title: 'Berhasil',
        text: pesan2,
        showConfirmButton: false,
        timer: 2000
    });
}


// tombol hapus

$('.t-hapus').on('click', function (e) {
    e.preventDefault();

    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah yakin?',
        text: "Akan Menghapus Data!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok Hapus Data'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

// tombol hapus

$('.t-logout').on('click', function (e) {
    e.preventDefault();

    const href = $(this).attr('href');

    Swal.fire({
        text: "Anda Akan LogOut..?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

// alert password gagal
const passWarning = $('.passWarning').data('flashdata');
if (passWarning) {
    Swal.fire({
        position: 'center',
        type: 'error',
        title: 'GAGAL.!',
        text: passWarning

    });
}


// pesan Logout
const logout = $('.logout').data('flashdata');
if (logout) {
    Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Berhasil',
        text: logout,
        showConfirmButton: false,
        timer: 1500
    });
}

// pesan Login
const login = $('.login').data('flashdata');
if (login) {
    Swal.fire({
        position: 'top',
        type: 'success',
        title: 'Berhasil',
        text: login,
        showConfirmButton: false,
        timer: 1500
    });
}

// ==========================================
// tambahn Buat export





