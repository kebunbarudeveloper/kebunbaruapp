<!-- jQuery -->
<script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/autoNumeric.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    $('[data-mask]').inputmask();

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }


    $('.rupiahFormat').autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aForm: true,
        vMax: '999999999',
        vMin: '-999999999'
    });

    $(function() {
        load()
    });

    const load = () => {
        let hijriah = $('#resulthijriah').val()
        let status = $('#resultstatus').val()
        let nama = $('#changenama').val()
        $.ajax({
            url: '<?= base_url() ?>payment/load',
            method: 'post',
            data: {
                status,
                hijriah,
                nama
            },
            success: function(data) {
                $('#tampil').html(data)
            }
        })
    }

    $('#changenama').on('keyup', function(e) {
        let key = e.which
        if (key != 13) {
            return false
        }

        load()
    })

    $('#changeStatus').on('change', function() {
        $('#resultstatus').val($(this).val())
        load()
    })

    $('#changeBulan').on('change', function() {
        $('#resulthijriah').val($(this).val())
        load()
    })

    $('#modal-tambah').on('shown.bs.modal', function() {
        $('#idsantri').val('').focus()
    })

    $('#modal-tambah').on('hidden.bs.modal', function() {
        $("#formtambahpembayaran input:hidden").val(0);
        $("#formtampilpengurangan input:checkbox").prop("checked", false);
        $('#idsantri').val('').prop('readOnly', false)
        $('#divdatasantri').hide()
        $('#divdiskon').hide()
        $('#tombolsimpan').prop('disabled', true)
        $('#tampilnominal').hide()
        $('#tampileditkelas').hide()
        $('#jumlahdiskon').html('Rp. 0')
        $('#setelahdiskon').html('Rp. 0')
        $('#jumlahpenambahan').html('Rp. 0')
    })

    $('#modal-edit-kelas').on('hidden.bs.modal', function() {
        $('#kelasedit').val('')
        $('#tingkatedit').val('')
    })

    $('#idsantri').on('keyup', function(e) {
        let id = $(this).val()
        let key = e.which
        if (key != 13) {
            return false
        }

        if (key == 13 && id == '') {
            return false
        }

        cekdata(id)
    })

    $('#idsantri').on('click', function() {
        $(this).prop('readOnly', false).focus().select()
        $('#tampilnominal').hide()
        $('#tampileditkelas').hide()
        $('#divdatasantri').hide()
        $('#divdiskon').hide()
        $('#nominal').val('')
        $('#jumlahdiskon').html('Rp. 0')
        $('#jumlahpenambahan').html('Rp. 0')
        $('#setelahdiskon').html('Rp. 0')
        $("#formtampilpengurangan input:checkbox").prop("checked", false);
    })

    const cekdata = id => {
        $.ajax({
            url: '<?= base_url() ?>payment/cekdata',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 500) {
                    $('.divopsi').hide()
                    $('#idsantri').focus().select()
                    $('#divdatasantri').hide()
                    toastr.error(`Oppss...! ${data.message}`)
                    return false
                }
                cekdetaildiskon(id)
                getdatasantri(id)
            }
        })
    }

    const cekdetaildiskon = id => {
        $.ajax({
            url: '<?= base_url() ?>payment/cekdetaildiskon',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                $('#idedit').val(id)

                let ubahDomisili = data.ubah_domisili
                let domisili = data.domisili
                let saudara = data.saudara
                let tipe_saudara = data.tipe_saudara
                let seragam = data.seragam
                let penambahan = data.penambahan
                let edit = data.edit

                if (domisili <= 0) {
                    $('#divminmutasidomisili').hide()
                } else {
                    $('#divminmutasidomisili').show()
                }

                if (saudara == 1) {
                    $('#divminsejenis').show()
                    $('#divminlainjenis').hide()
                } else if (saudara == 2) {
                    $('#divminsejenis').hide()
                    $('#divminlainjenis').show()
                } else {
                    $('#divminsejenis').hide()
                    $('#divminlainjenis').hide()
                }

                if (tipe_saudara <= 0) {
                    $('#tipe_saudara').val(0)
                } else {
                    $('#tipe_saudara').val(tipe_saudara)
                }

                if (seragam <= 0) {
                    $('#divminseragam').hide()
                } else {
                    $('#divminseragam').show()
                }

                if (penambahan <= 0) {
                    $('#divpenambahan').hide()
                } else {
                    $('#divpenambahan').show()
                }

                if (ubahDomisili <= 0) {
                    $('#divplusubahdomisili').hide()
                } else {
                    $('#divplusubahdomisili').show()
                }

                if (edit <= 0) {
                    $('#modaleditkelas').prop('disabled', true)
                } else {
                    $('#modaleditkelas').prop('disabled', false)
                }

                let sisa = data.sisa

                $('#tampilnominal').show()
                $('#tampileditkelas').show()
                $('#divdiskon').show()
                $('#nominal').val('').focus()
                $('#idfix').val(id)
                $('#nikfix').val(data.nik)
                $('#idsantri').prop('readOnly', true)
                $('#tahap').html(data.tahap)
                $('#tahappembayaran').val(data.tahap)
                $('#tipe_saudara').val(data.tipe_saudara)
                $('#tagihanawal').val(data.tagihan)
                $('#jumlahfix').val(data.tagihan)
                $('#tagihanfix').val(sisa)
                $('#tampiltagihan').html(formatRupiah(sisa, 'Rp. '))
                $('#setelahdiskon').html(formatRupiah(sisa, 'Rp. '))
                $('#tombolsimpan').prop('disabled', false)
            }
        })
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    const getdatasantri = id => {
        $.ajax({
            url: '<?= base_url() ?>payment/getdatasantri',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#divdatasantri').show()
                $('#tampildatasantri').html(data)
            }
        })
    }

    $('#simpaneditkelas').on('click', function() {
        let id = $('#idedit').val()
        let kelas = $('#kelasedit').val()
        let tingkat = $('#tingkatedit').val()
        if (kelas == '' || tingkat == '') {
            Swal.fire(
                'Oppss..',
                'Pastikan kelas dan tingkat sudah dipilih',
                'error'
            )
        } else {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Tindakan ini akan mempengaruhi tagihan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>payment/editkelas',
                        method: 'post',
                        data: {
                            id,
                            kelas,
                            tingkat
                        },
                        success: function(data) {
                            toastr.success('Yeayy..! Data kelas dan tingkat berhasil diubah')
                            $('#modal-edit-kelas').modal('hide')
                            cekdetaildiskon(id)
                            getdatasantri(id)
                        }
                    })
                }
            })
        }
    })

    $('#nominal').on('keyup', function(e) {
        let key = e.which
        if (key != 13) {
            return false
        }

        savepay()
    })

    $('#tombolsimpan').on('click', function() {
        savepay()
    })

    const savepay = () => {
        let nominal = $('#nominal').val()
        let tahap = $('#tahappembayaran').val()
        let tagihan = parseInt($('#tagihanfix').val())
        let nominalfixed = parseInt(nominal.replaceAll('.', ''))
        let limapuluh = tagihan / 2

        if (nominal == '') {
            toastr.error('Oppss..! Pastikan nominal sudah diisi')
            return false
        }

        if (nominalfixed > tagihan) {
            toastr.error('Oppss..! Pastikan nominal tidak lebih besar dari tagihan')
            return false
        }

        if (tahap == 'Pembayaran Pertama' && nominalfixed < limapuluh) {
            toastr.error('Oppss..! Pembayaran Pertama 100% atau 50%')
            return false
        }

        if (tahap == 'Pembayaran Pertama' && nominalfixed > limapuluh) {
            if (nominalfixed != tagihan) {
                toastr.error('Oppss..! Pembayaran Pertama 100% atau 50%')
                return false
            }
        }

        if (tahap == 'Pembayaran Kedua' && nominalfixed != tagihan) {
            toastr.error('Oppss..! Pembayaran kedua harus 100%')
            return false
        }

        $('#tagihanfix').val(tagihan)
        $('#nominalfix').val(nominalfixed)

        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Pastikan Anda memasukkan nominal dengan benar',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>payment/pay',
                    method: 'post',
                    dataType: 'json',
                    data: $('#formtambahpembayaran').serialize(),
                    success: function(data) {
                        let status = data.status
                        $('#modal-tambah').modal('hide')
                        if (status <= 0) {
                            toastr.error('Opss...! Kesalahan server nih')
                            return false
                        }

                        $('#invoiceprint').val(data.status)
                        load()

                        let hasilinvoice = $('#invoiceprint').val()
                        if (hasilinvoice != 0) {
                            Swal.fire({
                                title: 'Pembayaran Sukses....',
                                icon: 'success',
                                html: 'Otomatis print invoice dalam <strong>1</strong> detik.<br/><br/>',
                                timer: 1000,
                                timerProgressBar: true
                            })
                            setTimeout(function() {
                                $('#formprintafterpay').submit()
                            }, 1000)
                        }
                    }
                })
            }
        })
    }


    $('#minmutasidomisili').on('change', function() {
        if ($(this).is(':checked')) {
            let tipeSaudara = $('#tipe_saudara').val()
            let tipeDiskon = 3
            $('#mutasidomisili').val(1)
            getdiskon(tipeSaudara, tipeDiskon)
        } else {
            $('#nominalmutasidomisili').val(0)
            $('#tombolcekpengurangan').click()
            $('#mutasidomisili').val(0)
        }
    })

    $('#minsejenis').on('change', function() {
        if ($(this).is(':checked')) {
            let tipeSaudara = $('#tipe_saudara').val()
            let tipeDiskon = 2
            $('#saudara').val(1)
            getdiskon(tipeSaudara, tipeDiskon)
        } else {
            $('#nominalsejenis').val(0)
            $('#tombolcekpengurangan').click()
            $('#saudara').val(0)
        }
    })

    $('#minlainjenis').on('change', function() {
        if ($(this).is(':checked')) {
            let tipeSaudara = $('#tipe_saudara').val()
            let tipeDiskon = 1
            $('#lainjenis').val(1)
            getdiskon(tipeSaudara, tipeDiskon)
        } else {
            $('#nominallainjenis').val(0)
            $('#tombolcekpengurangan').click()
            $('#lainjenis').val(0)
        }
    })

    $('#minseragam').on('change', function() {
        if ($(this).is(':checked')) {
            let tipeSaudara = $('#tipe_saudara').val()
            let tipeDiskon = 4
            $('#seragam').val(1)
            getdiskon(tipeSaudara, tipeDiskon)
        } else {
            $('#nominalseragam').val(0)
            $('#tombolcekpengurangan').click()
            $('#seragam').val(0)
        }
    })

    $('#pluspenambahan').on('change', function() {
        if ($(this).is(':checked')) {
            $('#penambahan').val(1)
            getpenambahan(1)
        } else {
            $('#nominalpenambahan').val(0)
            $('#tombolcekpengurangan').click()
            $('#penambahan').val(0)
        }
    })

    $('#plusubahdomisili').on('change', function() {
        if ($(this).is(':checked')) {
            $('#ubah_domisili').val(1)
            getpenambahan(2)
        } else {
            $('#nominalubahdomisili').val(0)
            $('#tombolcekpengurangan').click()
            $('#ubah_domisili').val(0)
        }
    })

    const getdiskon = (domisili, tipe) => {
        $.ajax({
            url: '<?= base_url() ?>payment/getdiskon',
            method: 'post',
            data: {
                domisili,
                tipe
            },
            dataType: 'json',
            success: function(data) {
                if (tipe == 2) {
                    $('#nominalsejenis').val(data.hasil)
                } else if (tipe == 4) {
                    $('#nominalseragam').val(data.hasil)
                } else if (tipe == 1) {
                    $('#nominallainjenis').val(data.hasil)
                } else if (tipe == 3) {
                    $('#nominalmutasidomisili').val(data.hasil)
                }
                $('#tombolcekpengurangan').click()
            }
        })
    }

    const getpenambahan = (tipe) => {
        $.ajax({
            url: '<?= base_url() ?>payment/getpenambahan',
            method: 'post',
            data: {
                tipe
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status != 200) {
                    return false
                }

                if (tipe == 1) {
                    $('#nominalpenambahan').val(data.hasil)
                } else {
                    $('#nominalubahdomisili').val(data.hasil)
                }

                $('#tombolcekpengurangan').click()
            }
        })
    }

    $('#tombolcekpengurangan').on('click', function() {
        let domisili = parseInt($('#nominalmutasidomisili').val())
        let sejenis = parseInt($('#nominalsejenis').val())
        let lainjenis = parseInt($('#nominallainjenis').val())
        let seragam = parseInt($('#nominalseragam').val())
        let penambahan = parseInt($('#nominalpenambahan').val())
        let ubahdomisili = parseInt($('#nominalubahdomisili').val())
        let tagihanawal = parseInt($('#tagihanawal').val())

        let totalpenambahan = penambahan + ubahdomisili
        let total = sejenis + seragam + lainjenis + domisili

        let totalAkhir = (tagihanawal + penambahan + ubahdomisili) - total

        $('#jumlahdiskon').html(total.toLocaleString('id', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }))
        $('#setelahdiskon').html(totalAkhir.toLocaleString('id', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }))
        $('#jumlahpenambahan').html(totalpenambahan.toLocaleString('id', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }))

        $('#jumlahfix').val(totalAkhir)
        $('#tagihanfix').val(totalAkhir)
        $('#totaldiskon').val(total)
    })

    const loaddetail = id => {
        $.ajax({
            url: '<?= base_url() ?>payment/loaddetail',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#showdetail').html(data)
            }
        })
    }

    const deletepayment = id => {
        Swal.fire({
            title: 'Yakin nih?',
            text: 'Tindakan ini akan berpengaruh pada saldo',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yakin lah',
            cancelButtonText: 'Nggak jadi'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>payment/deletepayment',
                    method: 'post',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: function(data) {
                        let status = data.status
                        if (status <= 0) {
                            toastr.error('Oooppss..! Server sedang sibuk nih')
                            return false
                        }

                        toastr.success('Yeaahh..! Satu transaksi berhasil dihapus')
                        $('#modal-detail').modal('hide')
                        load()
                    }
                })
            }
        })
    }
</script>
</body>

</html>