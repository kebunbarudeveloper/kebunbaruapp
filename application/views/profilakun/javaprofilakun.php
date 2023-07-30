<!-- jQuery -->
<script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/crop/dropzone.js"></script>
<script src="<?= base_url('assets') ?>/plugins/crop/cropper.js"></script>
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    $('#tampilpassword').on('click', function() {
        $(this).hide()
        $('#sembunyipassword').show()
        $('.inputanpassword').attr('type', 'text')
    })

    $('#sembunyipassword').on('click', function() {
        $(this).hide()
        $('#tampilpassword').show()
        $('.inputanpassword').attr('type', 'password')
    })

    $('#tampilpassword1').on('click', function() {
        $(this).hide()
        $('#sembunyipassword1').show()
        $('.inputanpassword1').attr('type', 'text')
    })

    $('#sembunyipassword1').on('click', function() {
        $(this).hide()
        $('#tampilpassword1').show()
        $('.inputanpassword1').attr('type', 'password')
    })


    $('#tombolcek').on('click', function() {
        let pilihan = /^[a-z]*$/
        let userbaru = $('#userbaru').val()
        let userlama = $('#userakun').val()
        let passwordsaatini = $('#passwordsaatini').val()

        let pesanuser = $('#pesanuser')

        if (userbaru == '' || passwordsaatini == '') {

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan semua inputan terisi',
            })
        } else {


            if (userbaru.match(pilihan)) {
                if (userbaru.toLowerCase() == userlama) {
                    pesanuser.show().text('Username baru tidak boleh sama dengan username lama')
                } else {
                    //Cek password
                    $.ajax({
                        url: '<?= base_url() ?>profilakun/cekpassword',
                        method: 'post',
                        data: {
                            user: userlama,
                            password: passwordsaatini,
                            userbaru: userbaru
                        },
                        dataType: 'json',
                        success: function(data) {
                            //password salah
                            if (data.hasil == 1) {
                                $('#passwordsalah').show()
                                $('#pesanuser').hide()
                            } else if (data.hasil == 2) {
                                $('#passwordsalah').hide()
                                $('#pesanuser').show().text(
                                    'Username yang Anda masukkan sudah tersedia')
                            } else {
                                Swal.fire({
                                    title: 'Anda Yakin?',
                                    text: 'Akan mengubah username',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Lanjut',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#formubahusername').submit()
                                    }
                                })

                            }
                        }
                    })

                    // alert(hasilcekpassword)

                }
            } else {
                pesanuser.show().text('Username harus berupa huruf kecil (bukan karakter, angka, dan spasi)')
            }
        }


    })


    $.strength = function(element, password, katanya) {
        let desc = [{
            'width': '0px'
        }, {
            'width': '25%'
        }, {
            'width': '50%'
        }, {
            'width': '75%'
        }, {
            'width': '100%'
        }, {
            'width': '100%'
        }];
        let descClass = ['', 'bg-danger', 'bg-warning', 'bg-info',
            'bg-success', 'bg-success'
        ];

        let kata = ['', 'lemah', 'sedang', 'kuat', 'sangat kuat', ''];
        let score = 0;

        if (password.length >= 2) {
            score++;
        }

        //Jika Password Terdapat Huruf Kecil dan Besar Tambah Skor
        if ((password.length > 5) && (password.match(/[a-z]/)) && (password.match(/[A-Z]/))) {
            score++;
        }

        //Jika Password Terdiri dari Angka
        if (password.match(/\d+/)) {
            score++;
        }

        //Jika Password Terdapat Simbol
        if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
            score++;
        }

        //Jika Password Lebih dari 10 Karakter  
        if (password.length >= 10) {
            score++;
        }

        element.removeClass(descClass[score - 1]).addClass(descClass[score]).css(desc[score]);
        katanya.text(kata[score])
    };

    $(function() {
        $("#passwordbaru1").keyup(function() {
            const password = $(this).val();
            $.strength($("#kelasbar"), password, $("#katanya"));

            if (password.length >= 1) {
                $('#progresbar').show()
            } else {
                $('#progresbar').hide()
            }
        });
    });


    $('#tombolcek1').on('click', function() {
        const passwordsaatini = $('#passwordsaatini1').val()
        const passwordbaru1 = $('#passwordbaru1').val()
        const passwordbaru2 = $('#passwordbaru2').val()
        const idUser = $('#userpassword').val()

        if (passwordsaatini == '' || passwordbaru1 == '' || passwordbaru2 == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan semua inputan terisi',
            })
        } else {
            if (passwordbaru1 != passwordbaru2) {
                $('#kombinasitidakvalid').show()
                $('#passwordsalah1').hide()
            } else {
                $.ajax({
                    url: '<?= base_url() ?>profilakun/cekpasswordlagi',
                    method: 'post',
                    data: {
                        user: idUser,
                        password: passwordsaatini
                    },
                    dataType: 'json',
                    success: function(data) {
                        //password salah
                        if (data.hasil == 1) {
                            $('#passwordsalah1').show()
                            $('#kombinasitidakvalid').hide()
                        } else {
                            Swal.fire({
                                title: 'Anda Yakin?',
                                text: 'Akan mengubah password',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Lanjut',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#formubahpassword').submit()
                                }
                            })

                        }
                    }
                })
            }
        }
    })


    const flashdata = $('.flashdata').data('flashdata');

    if (flashdata != '') {
        Swal.fire(
            'SIPPPP!!!',
            flashdata,
            'success'
        )
    }



    $(document).ready(function() {

        var $modal = $('#modal-lg');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#upload_image').change(function(event) {
            var files = event.target.files;

            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        url: '<?= base_url() ?>profilakun/uploadFoto',
                        method: 'POST',
                        data: {
                            image: base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');

                            $('#fotopengguna').attr('src', data);
                            $('#imageprofilnav').attr('src', data);
                        }
                    });
                };
            });
        });

    });


    $('#batalubahfoto').on('click', function() {
        $('#upload_image').val('')
    })
</script>
</body>

</html>