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
                            <h3 class="card-title"> <i class="fa fa-retweet"></i> Mutasi Kamar Santri</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 850px;">
                                    <a href="<?= base_url() ?>exportexcel/mutasi" class="btn btn-primary form-control float-right">
                                        <i class="fas fa-file-excel"></i> Eksport Excel
                                    </a>
                                    <select onchange="filterdata()" class="form-control" id="daerah">
                                        <option value="111">..:Dari Daerah:..</option>
                                        <?php
                                        if ($domisili) {
                                            foreach ($domisili as $d) {
                                        ?>
                                                <option value="<?= $d->nama_kamar ?>"><?= $d->nama_kamar ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <select onchange="filterdata()" class="form-control" id="kamar">
                                        <option value="111">..:Dari Kamar:..</option>
                                        <?php
                                        for ($i = 0; $i < 15; $i++) {
                                        ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <select class="form-control" id="daerahke" onchange="showButton()">
                                        <option value="111">..:Ke Daerah:..</option>
                                        <?php
                                        if ($daerah) {
                                            foreach ($daerah as $dd) {
                                        ?>
                                                <option value="<?= $dd->nama_kamar ?>"><?= $dd->nama_kamar ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <select class="form-control" id="kamarke" onchange="showButton()">
                                        <option value="111">..:Ke Kamar:..</option>
                                        <?php
                                        for ($i = 1; $i < 15; $i++) {
                                        ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <form id="formPrint" action="<?= base_url() ?>mutasi/print" method="post" target="_blank">
                                        <input type="hidden" name="daerahp" id="daerahp">
                                        <input type="hidden" name="kamarp" id="kamarp">
                                        <button style="border-radius: 0px;" id="tombolprint" class="btn btn-primary btn-sm">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                    </form>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success" style="display: none;" id="tombolsimpan">
                                            <i class="fas fa-plus-circle"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12" id="tampildata">

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