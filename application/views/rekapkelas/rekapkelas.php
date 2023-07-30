<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-2 pr-1">
                            <h4 class="card-title mt-1">Rekapitulasi Keuangan Per Kelas</h4>

                            <form action="<?= base_url() ?>rekapkelas/laporan" method="post">
                                <input type="hidden" name="tingkat" id="val-tingkat" value="">
                                <input type="hidden" name="kelas" id="val-kelas" value="">
                                <input type="hidden" name="status" id="val-status" value="">
                                <button type="submit" class="mr-2 btn btn-sm btn-primary float-right">
                                    <i class="fa fa-download"></i>
                                    Export Laporan
                                </button>
                            </form>
                            <select id="changeStatus" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 130px;" onchange="loaddata()">
                                <option value="">Semua</option>
                                <option value="LUNAS">LUNAS</option>
                                <option value="BELUM LUNAS">BELUM LUNAS</option>
                                <option value="BELUM BAYAR">BELUM BAYAR</option>
                            </select>
                            <select id="changeKelas" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 100px;" onchange="loaddata()">
                                <option value="">Semua</option>
                                <option value="Jilid">Jilid</option>
                                <option value="Praktik">Praktik</option>
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
                            <select id="changeTingkat" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 150px;" onchange="loaddata()">
                                <option value="">Semua Tingkat</option>
                                <option value="0">I'dadiyah</option>
                                <option value="1">Ibtidaiyah</option>
                                <option value="2">Tsanawiyah</option>
                                <option value="3">Aliyah</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="show-data">

            </div>


        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>