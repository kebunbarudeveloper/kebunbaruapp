<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->
    <input type="hidden" id="flashdata" value="<?= $this->session->flashdata('hasilaturperiode'); ?>">
    <input type="hidden" id="pesankalender" value="<?= $this->session->flashdata('pesanaturkalender'); ?>">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-cog"></i> Atur Periode</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <form id="formsimpan" action="<?= base_url() ?>atursementara/simpan" method="post" autocomplete="off">
                                <div class="form-group row">
                                    <label for="tahunperiode" class="col-sm-3 col-form-label">Tahun Periode</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tahunperiode" name="tahunperiode" data-inputmask="'mask': ['9999-9999']" data-mask="" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-2">
                                        <select name="tanggal" id="tanggal" class="form-control">
                                            <option value="">---</option>
                                            <?php
                                            for ($i = 1; $i < 31; $i++) {
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
                                                'Muharram',
                                                'Shafar',
                                                'Rabi\'ul Awal',
                                                'Rabi\'ul Tsani',
                                                'Jumadal Ula',
                                                'Jumadal Akhirah',
                                                'Rajab',
                                                'Sya\'ban',
                                                'Ramadhan',
                                                'Syawal',
                                                'Dzul Qo\'dah',
                                                'Dzul Hijjah'
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
                                            $sekarang = 1444;
                                            for ($b = 1425; $b <= $sekarang; $b++) {
                                            ?>
                                                <option value="<?= $b; ?>"><?= $b; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary float-right" id="tombolsimpan">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-cog"></i> Pengaturan Saat Ini</h3>
                        </div>
                        <div class="card-body">
                            <table>
                                <?php
                                if ($data) {
                                ?>
                                    <thead>
                                        <tr>
                                            <th>Tahun Periode</th>
                                            <th>:</th>
                                            <th><?= $data->periode ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td><?= TampilHijri($data->tanggal) ?></td>
                                        </tr>
                                    </tbody>
                                <?php
                                } else {
                                    echo '<h6 class="text-danger">Belum diatur</h6>';
                                }
                                ?>
                            </table>
                        </div>
                    </div>
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