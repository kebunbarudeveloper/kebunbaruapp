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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Seluruh</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Pondok</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings"
                                        data-toggle="tab">I'dadiyah</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#tsanawiyah"
                                        data-toggle="tab">Tsanawiyah</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    <!-- Post -->
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i
                                                        class="fa fa-wallet"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Pemasukan</span>
                                                    <span class="info-box-number">Rp.
                                                        <?= number_format($rekap[0], 0, ',', '.') ?></span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i
                                                        class="fa fa-hand-holding-usd"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Transaksi</span>
                                                    <span class="info-box-number"><?= $rekap[1] ?> Kali</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <div class="col-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Rincian Pemasukan</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">No</th>
                                                                <th>Uraian</th>
                                                                <th>Nominal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															if ($rekap[2]) {
																$no1 = 1;
																foreach ($rekap[2] as $detail1) {
															?>
                                                            <tr>
                                                                <td><?= $no1++ ?></td>
                                                                <td><?= $detail1->nama_akunkeuangan ?></td>
                                                                <td><?= number_format($detail1->total, 0, ',', '.'); ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																}
															}
															?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i
                                                        class="fa fa-wallet"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Pemasukan</span>
                                                    <span class="info-box-number">Rp.
                                                        <?= number_format($pondok[0], 0, ',', '.') ?></span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i
                                                        class="fa fa-hand-holding-usd"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Transaksi</span>
                                                    <span class="info-box-number"><?= $pondok[1] ?> Kali</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <div class="col-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Rincian Pemasukan</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">No</th>
                                                                <th>Uraian</th>
                                                                <th>Nominal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															if ($pondok[2]) {
																$no1 = 1;
																foreach ($pondok[2] as $detail2) {
															?>
                                                            <tr>
                                                                <td><?= $no1++ ?></td>
                                                                <td><?= $detail2->nama_akunkeuangan ?></td>
                                                                <td><?= number_format($detail2->total, 0, ',', '.'); ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																}
															}
															?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i
                                                        class="fa fa-wallet"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Pemasukan</span>
                                                    <span class="info-box-number">Rp.
                                                        <?= number_format($idad[0], 0, ',', '.') ?></span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i
                                                        class="fa fa-hand-holding-usd"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Transaksi</span>
                                                    <span class="info-box-number"><?= $idad[1] ?> Kali</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <div class="col-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Rincian Pemasukan</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">No</th>
                                                                <th>Uraian</th>
                                                                <th>Nominal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															if ($idad[2]) {
																$no1 = 1;
																foreach ($idad[2] as $detail3) {
															?>
                                                            <tr>
                                                                <td><?= $no1++ ?></td>
                                                                <td><?= $detail3->nama_akunkeuangan ?></td>
                                                                <td><?= number_format($detail3->total, 0, ',', '.'); ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																}
															}
															?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tsanawiyah">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i
                                                        class="fa fa-wallet"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Pemasukan</span>
                                                    <span class="info-box-number">Rp.
                                                        <?= number_format($ts[0], 0, ',', '.') ?></span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i
                                                        class="fa fa-hand-holding-usd"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Total Transaksi</span>
                                                    <span class="info-box-number"><?= $ts[1] ?> Kali</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <div class="col-8">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Rincian Pemasukan</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">No</th>
                                                                <th>Uraian</th>
                                                                <th>Nominal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
															if ($ts[2]) {
																$no1 = 1;
																foreach ($ts[2] as $detail4) {
															?>
                                                            <tr>
                                                                <td><?= $no1++ ?></td>
                                                                <td><?= $detail4->nama_akunkeuangan ?></td>
                                                                <td><?= number_format($detail4->total, 0, ',', '.'); ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																}
															}
															?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
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
            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<!-- /.modal-dialog -->
</div>