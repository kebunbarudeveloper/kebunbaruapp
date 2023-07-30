<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-id-card"></i> Data Kartu Mahram</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 600px;">
                                    <input onkeyup="loaddata()" type="text" class="form-control float-right" id="nama" autofocus autocomplete="off" placeholder="Cari nama">
                                    <select onchange="loaddata()" class="form-control" id="status">
                                        <option value="111">..:Pilih Status:..</option>
                                        <option value="0">Belum Diaktivasi</option>
                                        <option value="1">Aktif</option>
                                        <option value="2">Hilang</option>
                                    </select>
                                    <select class="form-control" onchange="loaddata()" id="print">
                                        <option value="111">..:Print:..</option>
                                        <option value="0">Belum Print Out</option>
                                        <option value="1">Sudah Print Out</option>

                                    </select>
                                    <div class="input-group-append">
                                        <?php
                                        if ($tipe == 2) {
                                        ?>
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                                                <i class="fas fa-plus-circle"></i> Tambah
                                            </button>
                                        <?php
                                        } else {
                                        ?>
                                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-print">
                                                <i class="fas fa-plus-circle"></i> Tambah Print
                                            </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12" id="tampildatamahram">

                </div>


            </div>

            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>




<div class="modal fade" id="modal-lg" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-1 px-3">
                <h6 class="modal-title">Form Tambah Kartu Mahram</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <form autocomplete="off" id="formtambahboyong">
                            <div class="alert alert-warning" role="alert" id="notiferror" style="display: none;"></div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="idsantri" autofocus maxlength="8" placeholder="ID P2K">
                                </div>
                                <div class="col-sm-6">
                                    <select name="opsifiroq" id="opsifiroq" class="form-control">
                                        <option value="111">.:Opsi Firoq:.</option>
                                        <option value="3">Non-Firoq</option>
                                        <option value="1">Firoq Pihak Suami</option>
                                        <option value="2">Firoq Pihak Istri</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <div class="col-6" style="display: none;" id="tampilFoto">
                        <form id="formupload" enctype="multipart/form-data">
                            <input type="hidden" name="idwali" id="idwali">
                            <input type="hidden" name="hasilfiroq" id="hasilfiroq">
                            <input type="hidden" name="cekFoto" id="cekFoto" value="0">
                            <input type="hidden" name="tipewali" id="tipewali" value="0">
                            <input type="hidden" name="idwalistatis" id="idwalistatis" value="0">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input filepond my-pond" name="filepond" id="customFile">
                                    <label class="custom-file-label" for="customFile" id="labelFoto">Pilih Foto Wali</label>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
                <div class="row" id="tampilSuksesData">
                    <div class="col-6">
                        <div class="callout callout-warning">
                            <h6>WARNING!</h6>
                            <ol>
                                <li>Pastikan Nomor HP Wali sudah valid</li>
                                <li>Setelah proses pengecekan sukses, pastikan foto diupload</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-1">
                <button type="button" id="tombolbatal" class="btn btn-danger btn-sm">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolCek">Lakukan Pengecekan</button>
                <button style="display: none;" class="btn btn-primary btn-sm" id="tombolSimpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1 px-3"">
                <h6 class=" modal-title">Edit Nomor HP Wali</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="" method="post">
                            <div class="form-group row mb-0">
                                <label for="nomorhpwali" class="col-sm-4 col-form-label">Nomor
                                    HP</label>
                                <div class="col-sm-8">
                                    <input type="text" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" class="form-control inputdatasantri" id="nomorhpwali" name="nomorhpwali" tabindex="27" value="" inputmode="text">
                                </div>
                            </div>
                            <input type="hidden" name="idwalinope" id="idwalinope">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolSimpanNomor">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-wakil" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-1 px-3"">
                <h6 class=" modal-title">Form Tambah Wakil Wali</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="formwalistatis" autocomplete="off">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="namawalistatis" name="namawalistatis">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nomor HP</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="nopewalistatis" name="nopewalistatis" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" class="form-control" id="inputEmail3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Desa</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="desawalistatis" name="desawalistatis" class="form-control" id="inputEmail3">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Kabupaten</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="kabwalistatis" name="kabwalistatis" class="form-control" id="inputEmail3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolsimpanwalistatis">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Edit Data Mahram</h6>
            </div>
            <form action="#" id="editdatamahram" autocomplete="off">
                <input type="hidden" name="idmahram" id="idmahramedit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="namamahram" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="namamahram" id="namamahram">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desamahram" class="col-sm-4 col-form-label">Desa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="desamahram" name="desamahram">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="nopemahram" class="col-sm-4 col-form-label">No. HP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nopemahram" name="nopemahram" data-inputmask="'mask' : '9999-9999-9999'" data-mask="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kabupatenmahram" class="col-sm-4 col-form-label">Kabupaten</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kabupatenmahram" name="kabupatenmahram">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <div class="modal-footer justify-content-between py-1">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="simpaneditmahram">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-pengajuan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Pengajuan Duplikat</h6>
            </div>
            <form action="#" id="formpengajuan" autocomplete="off">
                <input type="hidden" name="idpengajuan" id="idpengajuan">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="alasanpengajuan" class="col-sm-4 col-form-label">Alasan</label>
                                <div class="col-sm-8">
                                    <select name="alasanpengajuan" id="alasanpengajuan" class="form-control form-control-sm">
                                        <option value="000">.:Pilih Alasan:.</option>
                                        <option value="2">Hilang</option>
                                        <option value="3">Rusak/Salah Data</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="callout callout-warning">
                                <h6 class="badge badge-warning">WARNING!</h6>
                                <ol class="text-xs">
                                    <li><b class="text-danger"> Hilang</b> berarti kartu tidak ada sehingga data kartu perlu diblokir (otomatis) dan diganti dengan kartu baru (dibuat dari awal secara otomatis)</li>
                                    <li> <b class="text-danger"> Rusak/Salah Data </b>berarti kartu masih ada sehingga kartu tersebut perlu dilubangi bagian barcode oleh pengurus (untuk kemudian dibuang) sebagai tanda bahwa kartu tersebut tidak berlaku dan akan diganti dengan kartu baru (tanpa dibuat dari awal)</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer justify-content-between py-1">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="kirimpengajuan">Kirim Pengajuan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-aduan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Pengajuan Duplikat</h6>
            </div>
            <input type="hidden" name="idaduan" id="idaduan">
            <input type="hidden" name="isiaduan" id="isiaduan">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h6 class="badge badge-warning">STATUS PENGAJUAN DUPLIKASI!</h6>
                        <div class="card">
                            <div class="card-body">
                                <h5 id="teks-aduan" class="text-center text-danger">RUSAK</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="callout callout-warning">
                            <h6 class="badge badge-warning">WARNING!</h6>
                            <ol class="text-xs">
                                <li><b class="text-danger"> Hilang</b> berarti kartu tidak ada sehingga data kartu perlu diblokir dan diganti dengan kartu baru (dibuat dari awal secara otomatis)</li>
                                <li> <b class="text-danger"> Rusak/Salah Data </b>berarti kartu masih ada sehingga kartu tersebut perlu dilubangi bagian barcode oleh pengurus (untuk kemudian dibuang) sebagai tanda bahwa kartu tersebut tidak berlaku dan akan diganti dengan kartu baru (tanpa dibuat dari awal)</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between py-1">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="terimaaduan()">Terima Pengajuan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-print" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1 px-3">
                <h6 class=" modal-title">Tambah Kartu Sudah Print Out</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row mb-0">
                            <label for="nomorhpwali" class="col-sm-4 col-form-label">ID Kartu</label>
                            <div class="col-sm-8">
                                <input type="text" data-inputmask="'mask' : '9999999999'" autocomplete="off" data-mask="" class="form-control" id="idkartu" name="idkartu" onkeyup="filterid(this, event)">
                                <small class="text-danger">Tekan ENTER untuk submit</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-detail" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2 px-3">
                <h6 class=" modal-title">Detail Data Mahram</h6>
            </div>
            <div class="modal-body" id="tampildetail">

            </div>
            <div class="modal-footer p-0">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>