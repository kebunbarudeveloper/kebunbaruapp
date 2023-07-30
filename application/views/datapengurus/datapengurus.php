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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fas fa-server mr-1"></i> Data Pengurus</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 450px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Cari Nama..." autofocus>
                                    <select id="pilihstatus" class="form-control">
                                        <option value="">..::Status::..</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button data-toggle="modal" data-target="#modal-xl" class="btn btn-primary"
                                            id="tomboltambah">
                                            <i class="fas fa-plus-circle"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-9" id="tampildata">

                    <!-- /.card -->
                </div>
                <div class="col-md-3 tampildetailpengurus" style="display: none;">

                    <!-- Profile Image -->
                    <div class="card" style="height: 70vh;">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid" id="gambardetail"
                                    style="height: 100px; width: 80px;"
                                    src="<?= base_url('assets/fotopengurus/coba.png') ?>" alt="User profile picture">
                            </div>
                            <p class="text-muted text-center mt-2 mb-0">Status : <span class="text-success"
                                    id="statusdetail"> </span>
                            </p>
                            <hr class="mt-2 mb-2">
                            <table style="width: 100%;">
                                <thead>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <th>Nama</th>
                                        <th>:</th>
                                        <th id="namadetail"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tetala</td>
                                        <td>:</td>
                                        <td id="tempatdetail"></td>
                                    </tr>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td></td>
                                        <td></td>
                                        <td id="ttldetail"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td id="dusundetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="desadetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="kecamatandetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="kabupatendetail"></td>
                                    </tr>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td></td>
                                        <td></td>
                                        <td id="prodetail"></td>
                                    </tr>
                                    <tr>
                                        <td>Masuk</td>
                                        <td> : </td>
                                        <td id="masukdetail"></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <div class="btn-group" style="width: 100%;">
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <span>Pilih Aksi</span>
                                </button>
                                <input type="hidden" id="idtampil">
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" id="menueditdata" href="#" data-toggle="modal"
                                        data-target="#modal-xl">Edit Data</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
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




<div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Data Pengurus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <form autocomplete="off" id="formtambahpengurus">
                    <input type="hidden" name="tipe" id="tipe" value="tambah">
                    <input type="hidden" name="idPengurus" id="idPengurus">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="nikpengurus" class="col-sm-4 col-form-label">NIK | NO. HP</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatapengurus" name="nikpengurus"
                                        id="nikpengurus" tabindex="1" data-inputmask="'mask' : '9999999999999999'"
                                        data-mask="">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatapengurus" name="hppengurus"
                                        id="hppengurus" tabindex="2" data-inputmask="'mask' : '999-999-999-999'"
                                        data-mask="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelaminpengurus" class="col-sm-4 col-form-label">J. KELAMIN | TMP
                                    LHR</label>
                                <div class="col-sm-4">
                                    <select name="kelaminpengurus" id="kelaminpengurus" class="form-control">
                                        <option value="">..:Pilih Kelamin:..</option>
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatapengurus" name="tempatpengurus"
                                        id="tempatpengurus" tabindex="4">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="propengurus" class="col-sm-4 col-form-label">PROVINSI</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatapengurus" name="propengurus"
                                        id="propengurus" tabindex="8">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kecpengurus" class="col-sm-4 col-form-label">KECAMATAN</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatapengurus" name="kecpengurus"
                                        id="kecpengurus" tabindex="10">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dusunpengurus" class="col-sm-4 col-form-label">DUSUN</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatapengurus" name="dusunpengurus"
                                        id="dusunpengurus" tabindex="12">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group row">
                                <label for="namapengurus" class="col-sm-4 col-form-label">NAMA</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatapengurus" name="namapengurus"
                                        id="namapengurus" tabindex="3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl" class="col-sm-4 col-form-label">TANGGAL LAHIR</label>
                                <div class="col-sm-2">
                                    <select name="tgl" id="tgl" class="form-control inputdatapengurus" tabindex="5">
                                        <option value="">.:Tgl:.</option>
                                        <?php
                                        $l = 1;
                                        for ($i = 1; $i <= 31; $i++) {
                                        ?>
                                        <option value="<?= sprintf('%02d', $i); ?>">
                                            <?= sprintf('%02d', $i); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select name="bln" id="bln" class="form-control inputdatapengurus" tabindex="6">
                                        <option value="">.:Bulan:.</option>
                                        <?php
                                        $bulan = [
                                            1 =>
                                            'Januari',
                                            'Februari',
                                            'Maret',
                                            'April',
                                            'Mei',
                                            'Juni',
                                            'Juli',
                                            'Agustus',
                                            'September',
                                            'Oktober',
                                            'November',
                                            'Desember'
                                        ];
                                        $k = 1;
                                        for ($p = 1; $p <= 12; $p++) {
                                        ?>
                                        <option value="<?= sprintf('%02d', $p); ?>">
                                            <?= $bulan[$p]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select name="thn" id="thn" class="form-control inputdatapengurus" tabindex="7">
                                        <option value="">.:Tahun:.</option>
                                        <?php
                                        for ($b = 1960; $b <= 2010; $b++) {
                                        ?>
                                        <option value="<?= $b; ?>">
                                            <?= $b; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kabpengurus" class="col-sm-4 col-form-label">KABUPATEN/KOTA</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatapengurus" name="kabpengurus"
                                        id="kabpengurus" tabindex="9">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desapengurus" class="col-sm-4 col-form-label">DESA</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatapengurus" id="desapengurus"
                                        name="desapengurus" tabindex="11">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtpengurus" class="col-sm-4 col-form-label">RT/RW/KODE POS</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatapengurus" name="rtpengurus"
                                        id="rtpengurus" tabindex="13" data-inputmask="'mask' : '999'" data-mask="">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatapengurus" name="rwpengurus"
                                        id="rwpengurus" tabindex="14" data-inputmask="'mask' : '999'" data-mask="">
                                </div>
                                <div class="col-sm-4">
                                    <input readonly type="text" class="form-control inputdatapengurus"
                                        name="pospengurus" id="pospengurus">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="tombolsimpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" id="idPro">
<input type="hidden" id="idKab">
<input type="hidden" id="idKec">