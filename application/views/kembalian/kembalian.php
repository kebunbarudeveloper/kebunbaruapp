<?php
$kata = ['Belum Diatur', 'Liburan Maulid', 'Liburan Ramadhan']
?>

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
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Check In Santri</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- <form class="form-horizontal" autocomplete="off"> -->
                        <div class="card-body">
                            <div id="setliburanlagi" class="callout callout-warning" style="cursor: pointer;">
                                <?php

                                $kata = ['Belum Diatur', 'Liburan Maulid', 'Liburan Ramadhan'];
                                $textZone = ['Belum Diatur', 'Zona Atas', 'Zona Bawah'];

                                ?>
                                <h6>Pengaturan Saat Ini:</h6>
                                <ul class="mb-0">
                                    <li><?= $kata[$liburan] ?></li>
                                    <li><?= $textZone[$zone] ?></li>
                                </ul>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <label for="idSantri" class="col-sm-3 col-form-label">ID P2K</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="liburan" value="<?= $liburan ?>">
                                    <input type="hidden" id="zone" value="<?= $zone ?>">
                                    <input type="hidden" id="kembali" value="<?= $kembali ?>">
                                    <input autocomplete="off" autofocus type="text" maxlength="8" class="form-control" id="idSantri" placeholder="ID P2K" data-inputmask="'mask' : '99999999'" data-mask="">
                                    <small class="text-info mt-2">Tekan F2 untuk autofocus</small>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lg">Perijinan</button>
                            <small class="text-info">Pilih untuk melakukan perijinan santri terlambat kembali</small>
                        </div>
                        <!-- /.card-footer -->
                        <!-- </form> -->
                    </div>
                </div>

                <div class="col-7" id="tampil">

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