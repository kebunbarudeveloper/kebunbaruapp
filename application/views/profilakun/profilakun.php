<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->
    <div class="flashdata" data-flashdata="<?= $this->session->flashdata('sukses') ?>"></div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" id="fotopengguna"
                                    style="width: 150px;"
                                    src="<?= base_url() ?>assets/fotopengguna/<?= $this->session->userdata('gambar_user'); ?>"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center mt-3"><?= $this->session->userdata('nama_user') ?>
                            </h3>

                            <p class="text-muted text-center"><?= $this->session->userdata('namajabatan_user') ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right text-success">Aktif</a>
                                </li>
                                <li class="list-group-item">
                                    <?php $kataaa = [1 => 'Putra', 'Putri', 'Umum']  ?>
                                    <b>Tipe Akses</b> <a
                                        class="float-right"><?= $kataaa[$this->session->userdata('tipe_user')] ?></a>
                                </li>
                            </ul>

                            <form method="post">
                                <div class="form-group mb-0">
                                    <div class="btn btn-primary btn-file" style="width: 100%;">
                                        <i class="fa fa-camera"></i> Ubah Foto
                                        <input type="file" name="image" class="image" id="upload_image">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">BIODATA</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#timeline"
                                        data-toggle="tab">AKTIVITAS</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">ATUR
                                        USERNAME</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#ubahpassword" data-toggle="tab">ATUR
                                        PASSWORD</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body" style="height: 370px;">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    <!-- Post -->
                                    <h5>Fitur BIODATA masih dalam pengembangan</h5>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <h5>Fitur AKTIVITAS masih dalam pengembangan</h5>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <div class="row">
                                        <div class="col-8" style="margin: 0 auto;">
                                            <form class="form-horizontal" method="POST" id="formubahusername"
                                                action="<?= base_url() ?>profilakun/ubahusername" autocomplete="off">
                                                <div class="form-group row">
                                                    <label for="namaakun" class="col-sm-4 col-form-label">Nama |
                                                        Username</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" id="namaakun"
                                                            value="<?= $this->session->userdata('nama_user'); ?>"
                                                            readonly>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" name="userakun"
                                                            id="userakun"
                                                            value="<?= $this->session->userdata('username_user'); ?>"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="userbaru" class="col-sm-4 col-form-label">Username
                                                        Baru</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="userbaru"
                                                            id="userbaru">
                                                        <small class="text-danger" style="display: none;"
                                                            id="pesanuser"></small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="passwordsaatini"
                                                        class="col-sm-4 col-form-label">Password saat
                                                        ini</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control inputanpassword"
                                                            name="passwordsaatini" id="passwordsaatini">
                                                        <small class="text-danger" style="display: none;"
                                                            id="passwordsalah">Password yang Anda masukkan salah</small>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-4 col-sm-8 text-primary">

                                                        <span class="ml-1 font-weight-light" id="tampilpassword"
                                                            style="cursor:pointer">
                                                            <i class="fa fa-eye"></i> Tampilkan password
                                                        </span>
                                                        <span class="ml-1 font-weight-light" id="sembunyipassword"
                                                            style="cursor:pointer; display:none">
                                                            <i class="fa fa-eye-slash"></i> Sembunyikan password
                                                        </span>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="tombolcek"
                                                class="btn btn-success float-right ml-2">
                                                Simpan Perubahan</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="ubahpassword">
                                    <div class="row">
                                        <div class="col-8" style="margin: 0 auto;">
                                            <form class="form-horizontal" method="POST" id="formubahpassword"
                                                action="<?= base_url() ?>profilakun/ubahpassword" autocomplete="off">
                                                <input type="hidden" name="userpassword" id="userpassword"
                                                    value="<?= $this->session->userdata('id_user'); ?>">
                                                <div class="form-group row">
                                                    <label for="passwordsaatini"
                                                        class="col-sm-4 col-form-label">Password saat
                                                        ini</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control inputanpassword1"
                                                            name="passwordsaatini1" id="passwordsaatini1">
                                                        <small class="text-danger" style="display: none;"
                                                            id="passwordsalah1">Password saat ini salah</small>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label for="passwordbaru1" class="col-sm-4 col-form-label">Password
                                                        Baru</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control inputanpassword1"
                                                            name="passwordbaru1" id="passwordbaru1">
                                                        <div class="progress progress-xs mt-2" id="progresbar"
                                                            style="display: none;">
                                                            <div id="kelasbar" class="progress-bar progress-bar-striped"
                                                                role="progressbar" aria-valuemax="10" style="width: 0%">
                                                                <small id="katanya"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="passwordbaru2" class="col-sm-4 col-form-label">Ulangi
                                                        Password Baru</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control inputanpassword1"
                                                            name="passwordbaru2" id="passwordbaru2">
                                                        <small class="text-danger" style="display: none;"
                                                            id="kombinasitidakvalid">Kombinasi password tidak
                                                            valid</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-4 col-sm-8 text-primary">

                                                        <span class="ml-1 font-weight-light" id="tampilpassword1"
                                                            style="cursor:pointer">
                                                            <i class="fa fa-eye"></i> Tampilkan password
                                                        </span>
                                                        <span class="ml-1 font-weight-light" id="sembunyipassword1"
                                                            style="cursor:pointer; display:none">
                                                            <i class="fa fa-eye-slash"></i> Sembunyikan password
                                                        </span>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="tombolcek1"
                                                class="btn btn-success float-right ml-2">Simpan Perubahan</button>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>




<div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="false" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pt-0 pb-0">
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"
                                style="overflow: hidden; width: 170px; height: 170px; margin-left: 10px; border: 1px solid red;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="batalubahfoto" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="crop"> <i class="fa fa-crop-alt"></i> Crop dan
                    Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>