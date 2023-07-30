// $(function() {
//     //The passed argument has to be at least a empty object or a object with your desired options
//     $('body').overlayScrollbars({});
// });

$('.tombollogout').on('click', function(e) {
    e.preventDefault()

    const tujuan = $(this).attr('href')

    Swal.fire({
        title: 'Yakin?',
        text: "Anda akan kelur dari Kebunbaru Aplikasi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = tujuan
        }
    })
})



function tanggalIndoM(string) {
    bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
        'November', 'Desember'
    ];

    tanggal = string.split("-")[2];
    bulan = string.split("-")[1];
    tahun = string.split("-")[0];

    return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
}


function tanggalIndoH(string) {
    bulanIndo = ['', 'Muharram', 'Shafar', 'Rabi\'ul Awal', 'Rabi\'ul Tsani', 'Jumadal Ula', 'Jumadal Akhir', 'Rajab',
        'Sya\'ban', 'Ramadhan', 'Syawal', 'Dzul Qo\'dah', 'Dzul Hijjah'
    ];

    tanggal = string.split("-")[2];
    bulan = string.split("-")[1];
    tahun = string.split("-")[0];

    return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
}