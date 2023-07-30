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
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Santri Baru</span>
                            <span class="info-box-number">
                                <?= $santribaru[0] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-male"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Putra</span>
                            <span class="info-box-number">
                                <?= $santribaru[1] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-female"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Putri</span>
                            <span class="info-box-number">
                                <?= $santribaru[2] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-sign-out-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Boyong (Berhenti)</span>
                            <span class="info-box-number">
                                <?= $santribaru[3] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Seluruh Santri</span>
                            <span class="info-box-number">
                                <?= $totalsantri[0] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-male"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Putra</span>
                            <span class="info-box-number">
                                <?= $totalsantri[1] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-female"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Putri</span>
                            <span class="info-box-number">
                                <?= $totalsantri[2] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-sign-out-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Boyong (Berhenti)</span>
                            <span class="info-box-number">
                                <?= $totalsantri[3] ?> <small>Orang</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>


            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h6><b>Seluruh Santri Per Domisili</b></h6>
                            <table style="width: 100%;">
                                <?php
                                foreach ($perkab[0] as $dkab) {
                                    $kab1 = $dkab->domisili_santri;
                                    if ($kab1 == '') {
                                        $kamarxx = 'Belum Diatur';
                                    } else {
                                        $kamarxx = $kab1;
                                    }
                                ?>
                                    <tr>
                                        <td><?= $kamarxx ?></td>
                                        <td>:</td>
                                        <td><?= $dkab->total ?> Orang</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <?php $kataTipe = ['Santri', 'Santri Putra', 'Santri Putri', 'Semua Santri'] ?>
                            <h3 class="card-title"> <?= $kataTipe[$tipe] ?></h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 180px;">
                                    <select name="" id="pilihKamar" class="form-control">
                                        <option value="111">..::All::..</option>
                                        <?php
                                        foreach ($domisili as $ddd) {
                                            $namaKamar = $ddd->nama_kamar;
                                            if ($namaKamar == '') {
                                                $kamarx = 'Belum Diatur';
                                            } else {
                                                $kamarx = $namaKamar;
                                            }
                                        ?>
                                            <option value="<?= $namaKamar ?>"><?= $kamarx ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" id="tampilKategori">

                        </div>
                        <div class="card-footer"></div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <! -- /.content -->
</div>

<!-- /.content-wrapper -->
</div>


<div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Santri Domisili <span class="text-success" id="judul"></span></h5>

            </div>
            <div class="modal-body pt-0" id="tampilKamar" style="height: 72vh; overflow: auto">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>