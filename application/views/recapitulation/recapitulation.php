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
                            <h4 class="card-title mt-1">Rekapitulasi Keuangan</h4>
                            <a target="_blank" href="<?= base_url() ?>recapitulation/laporan" class="mr-2 btn btn-sm btn-primary float-right">
                                <i class="fa fa-download"></i>
                                Export Laporan
                            </a>
                            <select id="changeBulan" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 150px;">
                                <option value="0">Semua Bulan</option>
                                <option value="01">Muharram</option>
                                <option value="02">Shafar</option>
                                <option value="03">Rabi'ul Awal</option>
                                <option value="04">Rabi'ul Tsani</option>
                                <option value="05">Jumadal Ula</option>
                                <option value="06">Jumadal Tsaniyah</option>
                                <option value="07">Rajab</option>
                                <option value="08">Sya'ban</option>
                                <option value="09">Ramadhan</option>
                                <option value="10">Syawal</option>
                                <option value="11">Dzul Qo'dah</option>
                                <option value="12">Dzul Hijjah</option>
                            </select>
                            <input type="hidden" id="resultbulan" value="">
                            <!-- <select id="changeTIngkat" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 150px;">
                                <option value="">Semua Tingkat</option>
                                <option value="I'dadiyah">I'dadiyah</option>
                                <option value="Ibtidaiyah">Ibtidaiyah</option>
                                <option value="Tsanawiyah">Tsanawiyah</option>
                                <option value="Aliyah">Aliyah</option>
                            </select>
                            <select id="changeCategory" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 150px;">
                                <option value="">Semua Kategori</option>
                                <option value="Umum">Umum</option>
                                <option value="Pesantren">Pesantren</option>
                                <option value="Madrasah">Madrasah</option>
                            </select> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="showfooter">

            </div>

            <div class="row" id="showall">

            </div>


        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>