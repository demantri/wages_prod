setInterval(function () {

    const wkt = new Date();
    const namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu'];
    const namHaSekar = namaHari[wkt.getDay()];

    const tglSekar = wkt.getDate();

    const namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des'];
    const namB = namaBulan[wkt.getMonth()];

    const thn = wkt.getFullYear();

    const noJam = ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23']
    const jamSek = noJam[wkt.getHours()];

    const menSekr = wkt.getMinutes();
    const detSekr = wkt.getSeconds();

    const tampilJam = document.querySelector('.jam-sekarang');
    tampilJam.innerHTML = jamSek + ':' + menSekr + ':' + detSekr;

    const tampiltgl = document.querySelector('.tgl-sekarang');
    tampiltgl.innerHTML = namHaSekar + ', ' + tglSekar + ' ' + namB + ' ' + thn;
}, 1000);













