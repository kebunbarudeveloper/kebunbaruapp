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
                            <h3 class="card-title"> <i class="fa fa-retweet"></i> Update Kelas Santri</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 850px;">
                                    <a href="<?= base_url() ?>exportexcel/mutasi" class="btn btn-primary form-control float-right">
                                        <i class="fas fa-file-excel"></i> Eksport Excel
                                    </a>
                                    <select onchange="filterdata()" class="form-control" id="kelas">
                                        <option value="111">..:Kelas Asal:..</option>
                                        <option value="Jilid">Jilid</option>
                                        <option value="Takhossus">Takhossus</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                    <select onchange="filterdata()" class="form-control" id="tingkat">
                                        <option value="111">..:Tingkat Asal:..</option>
                                        <option value="RA">RA</option>
                                        <option value="I'dadiyah">I'dadiyah</option>
                                        <option value="Ibtidaiyah">Ibtidaiyah</option>
                                        <option value="Tsanawiyah">Tsanawiyah</option>
                                        <option value="Aliyah">Aliyah</option>
                                        <option value="Kuliah Syari'ah">Kuliah Syari'ah</option>
                                    </select>
                                    <select class="form-control" id="kelaske" onchange="showButton()">
                                        <option value="111">..:Ke Kelas:..</option>
                                        <option value="111">..:Kelas Asal:..</option>
                                        <option value="Jilid">Jilid</option>
                                        <option value="Takhossus">Takhossus</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                    <select class="form-control" id="tingkatke" onchange="showButton()">
                                        <option value="111">..:Ke Tingkat:..</option>
                                        <option value="RA">RA</option>
                                        <option value="I'dadiyah">I'dadiyah</option>
                                        <option value="Ibtidaiyah">Ibtidaiyah</option>
                                        <option value="Tsanawiyah">Tsanawiyah</option>
                                        <option value="Aliyah">Aliyah</option>
                                        <option value="Kuliah Syari'ah">Kuliah Syari'ah</option>
                                    </select>
                                    <form id="formPrint" action="<?= base_url() ?>mutasi/print" method="post" target="_blank">
                                        <input type="hidden" name="kelasp" id="kelasp">
                                        <input type="hidden" name="tingkatp" id="tingkatp">
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