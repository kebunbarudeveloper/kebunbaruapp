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
            <!-- <hr> -->
            <div class="row" id="tampilData">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-danger text-center">Sedang Memuat Data..........</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if($kembali) { ?>
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Check In Santri</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- <form class="form-horizontal" autocomplete="off"> -->
                        <div class="card-body">
                            <div class="form-group row mb-0">
                                <label for="idSantri" class="col-sm-3 col-form-label">ID P2K</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="kembali" value="<?= $kembali ?>">
                                    <input autocomplete="off" autofocus type="text" maxlength="8" class="form-control" id="idSantri" placeholder="ID P2K" data-inputmask="'mask' : '99999999'" data-mask="">
                                    <small class="text-info mt-2">Tekan F2 untuk autofocus</small>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lg">Perijinan</button>
                            <small class="text-info">Pilih untuk melakukan perijinan santri terlambat/tidak kembali</small>
                            <?php if ($kembali) { 
                                $str = strtotime($kembali);
                                $tgl = date('Y-m-d', $str);
                                $jam = date('H:i:s', $str);
                            ?>
                                <hr>
                                <div class="card">
                                    <div class="card-body">
                                        Batas akhir: <span class="text-success text-bold"><?= tanggalIndo($tgl) . ' | ' . $jam; ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.card-footer -->
                        <!-- </form> -->
                    </div>
                </div>
                <?php } else { ?>
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tanggal Kembali</h5>
                        </div>
                        <form id="formTangal" action="<?= base_url() ?>kembalipesrom/tanggal" method="post" autocomplete="off">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tgl.</label>
                                    <div class="col-sm-3">
                                        <select name="tanggal" id="tanggal" class="form-control">
                                            <option value="">---</option>
                                            <?php
                                            for ($i = 1; $i < 32; $i++) {
                                            ?>
                                                <option value="<?= sprintf('%02d', $i) ?>"><?= sprintf('%02d', $i) ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="bulan" id="bulan" class="form-control inputdatasantri" tabindex="6">
                                            <option value="">..::..</option>
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
                                        <select name="tahun" id="tahun" class="form-control inputdatasantri" tabindex="7">
                                            <option value="">..::..</option>
                                            <?php
                                            $sekarang = date('Y');
                                            for ($b = 2020; $b <= $sekarang; $b++) {
                                            ?>
                                                <option value="<?= $b; ?>"><?= $b; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jam" class="col-sm-2 col-form-label">Jam</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" data-inputmask="'mask' : '99:99'" data-mask="" name="jam">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <button type="button" id="simpanTanggal" class="btn btn-success btn-sm float-right">Simpan</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-7" id="tampil"></div>
            </div>

            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>


<div class="modal fade" id="modal-lg" aria-modal="true" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Ijin Terlambat Kembali</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="idsantriijin">ID P2K</label>
                            <input autocomplete="off" type="text" id="idsantriijin" name="idsantriijin" class="form-control" placeholder="Masukkan ID P2K" data-inputmask="'mask' : '99999999'" data-mask="">
                            <small class="text-danger">Tekan ENTER untuk melakukan cek data</small>
                        </div>
                        <div class="form-group" style="display: none;" id="divalasan">
                            <label for="alasan">Alasan</label>
                            <textarea id="alasan" autocomplete="off" name="alasan" class="form-control" rows="5" placeholder="Masukkan alasan"></textarea>
                        </div>
                    </div>

                    <div class="col-8" id="tampilhasilijin">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="batalijin">Batal</button>
                <button style="display: none;" type="button" class="btn btn-primary" id="simpanijin">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- MODAL DETAIL -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filter-type" value="0">
                <h6 class="modal-title" id="title-detail"></h6>
                <select class="form-control form-control-sm" style="width: 20%;" id="domicile" onchange="showmodalfilter()">
                    <option value="">::Daerah::</option>
                    <?php
                    foreach ($domicile as $d) {
                    ?>
                        <option value="<?= $d->domisili_santri ?>"><?= $d->domisili_santri ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="modal-body" id="tampilSudah" style="height: 70vh; overflow: auto">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>