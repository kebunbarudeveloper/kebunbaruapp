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
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h6><b>Seluruh Santri Per Domisili</b></h6>
                            <table style="width: 100%;">
                                <?php
                                foreach ($perkab[0] as $dkab) {
                                    $kab1 = $dkab->domisili_santri;
                                ?>
                                    <tr>
                                        <td><?= $kab1 ?></td>
                                        <td>:</td>
                                        <td><?= $dkab->total ?> Orang</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box">
                        <div class="inner">
                            <h6><b> Santri Putra Per Domisili</b></h6>
                            <table style="width: 100%;">
                                <?php
                                foreach ($perkab[1] as $dkaba) {
                                    $kab2 = $dkaba->domisili_santri;
                                ?>
                                    <tr>
                                        <td><?= $kab2 ?></td>
                                        <td>:</td>
                                        <td><?= $dkaba->total ?> Orang</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box">
                        <div class="inner">
                            <h6><b> Santri Putri Per Domisili</b></h6>
                            <table style="width: 100%;">
                                <?php
                                foreach ($perkab[2] as $dkabb) {
                                    $kab3 = $dkabb->domisili_santri;
                                ?>
                                    <tr>
                                        <td><?= $kab3 ?></td>
                                        <td>:</td>
                                        <td><?= $dkabb->total ?> Orang</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <! -- /.content -->
</div>

<!-- /.content-wrapper -->
</div>