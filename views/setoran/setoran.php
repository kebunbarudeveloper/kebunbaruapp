<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-2">
                            <div class="row mb-3 pt-1">
                                <input type="text" style="width: 200px;" placeholder="Masukkan Nama atau ID P2K" name="" id="" class="form-control form-control-sm">
                                <select name="" id="" class="form-control form-control-sm ml-2" style="width: auto;">
                                    <option value="111">.:Setoran.:</option>
                                    <option value="RA">1</option>
                                    <option value="I'dadiyah">2</option>
                                </select>
                                <select name="" id="" class="form-control form-control-sm ml-2" style="width: auto;">
                                    <option value="111">.:Status.:</option>
                                    <option value="1">Menyetor</option>
                                    <option value="0">Tidak Menyetor</option>
                                </select>
                                <select name="" id="" class="form-control form-control-sm ml-2" style="width: auto;">
                                    <option value="111">.:Kelas.:</option>
                                    <?php
                                    for ($i = 1; $i < 10; $i++) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <select name="" id="" class="form-control form-control-sm ml-2" style="width: auto;">
                                    <option value="111">.:Tingkat.:</option>
                                    <option value="RA">RA</option>
                                    <option value="I'dadiyah">I'dadiyah</option>
                                    <option value="Ibtidaiyah">Ibtidaiyah</option>
                                    <option value="Tsanawiyah">Tsanawiyah</option>
                                    <option value="Aliyah">Aliyah</option>
                                </select>
                                <select name="" id="" class="form-control form-control-sm ml-2" style="width: auto;">
                                    <option value="111">.:Domisili.:</option>
                                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                    <option value="Bahasa Jawa">Bahasa Jawa</option>
                                    <option value="Bahasa Arab">Bahasa Arab</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="Khusus Tahfidz al-Qur'an">Tahfidz al-Qur'an</option>
                                </select>
                                <select name="" id="" class="form-control form-control-sm ml-2" style="width: auto;">
                                    <option value="111">.:Kamar.:</option>
                                    <?php
                                    for ($i = 1; $i < 10; $i++) {
                                    ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php
                                if ($data['hasil'] == 200) {
                                    $sekarang = date('Y-m-d');
                                    if ($sekarang > $data['data']['batas']) {
                                ?>
                                        <button class="btn btn-default btn-sm ml-2" onclick="warning('Batas akhir setoran sudah kadaluarsa')">
                                            <i class="fa fa-plus-circle"></i>
                                            Tambah
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-default btn-sm ml-2" data-toggle="modal" data-target="#modalsetoran">
                                            <i class="fa fa-plus-circle"></i>
                                            Tambah
                                        </button>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <button class="btn btn-default btn-sm ml-2" onclick="warning('Pastikan setoran sudah diset')">
                                        <i class="fa fa-plus-circle"></i>
                                        Tambah
                                    </button>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row" style="height: 69vh; overflow: auto;" id="panel">

                            </div>
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


<!-- Modal tambah setoran -->
<input type="hidden" id="idsetoran" value="0">
<div class="modal fade" id="modalsetoran" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-2 pl-3">
                <h6 class="modal-title">Form Setoran Ke-<?= $data['data']['part'] ?></h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-7">
                        <div class="card-body pt-0 pb-0">
                            <div class="form-group row mb-0">
                                <label for="idSantri" class="col-sm-2 col-form-label pt-1">ID P2K</label>
                                <div class="col-sm-6">
                                    <input autocomplete="off" maxlength="8" type="text" class="form-control form-control-sm" id="idSantri">
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-default btn-sm" id="buttoncheck" onclick="buttoncheck()">
                                        <i class="fa fa-tasks"></i> Lakukan Cek
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card-body pt-0 pb-0">
                            <div class="form-group row mb-0">
                                <label for="" class="col-sm-12 col-form-label text-danger font-weight-lighter">
                                    <span id="error" style="display: none;"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6" id="panelshowdata">

                    </div>

                    <div class="col-6" style="display: none;" id="pilihpaket">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group clearfix row">
                                    <div class="col-6">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="full" value="full" name="tipe">
                                            <label for="full">
                                                Paket Full
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="porsi" value="porsi" name="tipe">
                                            <label for="porsi">
                                                Paket 1 porsi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix row">
                                    <div class="col-6">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="now" name="tanggal" value="now">
                                            <label for="now">
                                                Berlaku Hari Ini
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="manual" name="tanggal" value="manual">
                                            <label for="manual">
                                                Tanggal Manual
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div id="paneltanggal" style="display: none;">
                                    <div class="input-group mt-4">
                                        <input type="date" class="form-control" id="tanggalmanual" name="tanggalmanual">
                                    </div>
                                </div>
                                <hr class="mt-4">
                                <div class="mt-4">
                                    <h3 id="total" class="text-center text-success">Rp. 0</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end p-1">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="coba()">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>