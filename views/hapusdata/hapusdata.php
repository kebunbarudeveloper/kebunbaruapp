<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Check Data Santri</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- <form class="form-horizontal" autocomplete="off"> -->
                        <div class="card-body">
                            <h6>Perhatikan sebelum memulai:</h6>
                            <ol class="mb-0 text-success mb-3">
                                <li>Hapus data bila ada duplikat data atau data siluman</li>
                                <li>Data akan dihapus secara permanen</li>
                                <li>Bila tidak termasuk poin satu, maka harus melalui prosedur
                                    <a href="<?= base_url() ?>santriboyong"><b class="text-success">Santri Boyong</b></a>
                                </li>
                            </ol>
                            <hr>
                            <div class="form-group row mb-0">
                                <label for="idSantri" class="col-sm-3 col-form-label">ID P2K</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" autofocus type="text" maxlength="8" class="form-control" id="idSantri" placeholder="ID P2K" data-inputmask="'mask' : '99999999'" data-mask="">
                                    <small class="text-info mt-2">Tekan F2 untuk autofocus</small>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <small class="text-success">Tekan ENTER atau klik button</small>
                            <button type="button" class="float-right btn btn-info btn-sm" id="tombolCek">Cek Data</button>
                        </div>
                        <!-- /.card-footer -->
                        <!-- </form> -->
                    </div>
                </div>

                <div class="col-7" id="tampil" style="display: none;">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Data Santri</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="" id="gambardetail" alt="Foto santri" style="width: 100%;">
                                </div>
                                <div class="col-8">
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 35%;">ID P2K</th>
                                                <th style="width: 5%;">:</th>
                                                <th style="width: 60%;" id="hasilid"></th>
                                            </tr>
                                            <tr>
                                                <td>Nomor Induk</td>
                                                <td>:</td>
                                                <td id="induk"></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td><b id="nama"></b></td>
                                            </tr>
                                            <tr>
                                                <td>Domisili</td>
                                                <td>:</td>
                                                <td>P2K, <span id="domisili"></span> - <span id="kamar"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan Diniyah</td>
                                                <td>:</td>
                                                <td><span id="kelas"></span> - <span id="tingkat"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Pendidikan Formal</td>
                                                <td>:</td>
                                                <td><span id="kelasf"></span> - <span id="tingkatf"></span></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="4" class="align-top">Alamat</td>
                                                <td>:</td>
                                                <td>Dusun <span id="dusun"></span> RT <span id="rt"></span>/RW <span id="rw"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td id="desa">Larangan Slampar</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><span id="kec"></span> <span id="kab"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><span id="provinsi"></span>, <span id="pos"></span></td>
                                            </tr>
                                            <tr>
                                                <td>Ayah</td>
                                                <td>:</td>
                                                <td><b id="ayah"></b></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-danger float-left" id="batal">Batalkan</button>
                            <button class="btn btn-success float-right" id="simpan" data-id="">Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>