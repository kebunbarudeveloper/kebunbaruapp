<!-- Content Wrapper. Contains page content -->
<input type="hidden" id="hiddenLiburan" value="<?= $data ?>">
<input type="hidden" id="hiddenJadwal" value="<?= $jadwal ?>">
<input type="hidden" id="hiddenStatus" value="">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row" id="tampilData">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-danger text-center">Sedang Memuat Data..........</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <hr> -->
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Pengambilan Surat Ijin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- <form class="form-horizontal" autocomplete="off"> -->
                        <div class="card-body">
                            <div id="setliburanlagi" class="callout callout-warning" style="cursor: pointer;">
                                <?php

                                $kata = ['Belum Diatur', 'Liburan Maulid', 'Liburan Ramadhan'];

                                ?>
                                <h6>Pengaturan Saat Ini:</h6>
                                <ul class="mb-0">
                                    <li><?= $kata[$data] ?></li>
                                    <li><?= $jadwal ?></li>
                                </ul>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="idSantri" class="col-sm-3 col-form-label">ID P2K</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" autofocus type="text" maxlength="8" class="form-control" id="idSantri" placeholder="ID P2K" data-inputmask="'mask' : '99999999'" data-mask="">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <!-- <button type="button" id="simpanSuratIjin" class="btn btn-success btn-sm float-right">Simpan</button> -->
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