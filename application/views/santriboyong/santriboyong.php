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
                        <div class="card-header py-2 pr-2">
                            <h3 class="card-title mt-1"> <i class="fa fa-user-minus"></i> Data Santri Boyong</h3>
                            <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modal-lg">
                                <i class="fas fa-plus-circle"></i> Tambah
                            </button>
                            <a href="<?= base_url() ?>exportexcel/boyong" class="btn btn-primary btn-sm mr-2 float-right">
                                <i class="fas fa-file-excel"></i> Eksport Excel
                            </a>
                            <select onchange="loaddata()" id="bulan" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 130px;">
                                <option value="">Semua Bulan</option>
                                <option value="01">Muharram</option>
                                <option value="02">Shafar</option>
                                <option value="03">Rabi'ul Awal</option>
                                <option value="04">Rabi'ul Tsani</option>
                                <option value="05">Jumadal Ula</option>
                                <option value="06">Jumadal Akhirah</option>
                                <option value="07">Rajab</option>
                                <option value="08">Sya'ban</option>
                                <option value="09">Ramadhan</option>
                                <option value="10">Syawal</option>
                                <option value="11">Dzul Qo'dah</option>
                                <option value="12">Dzul Hijjah</option>
                            </select>
                            <select onchange="loaddata()" class="form-control form-control-sm float-right mr-2" id="periode" style="width: 130px">
                                <option value="">..:Pilih Periode:..</option>
                                <option value="1441-1442">1441-1442</option>
                                <option value="1442-1443">1442-1443</option>
                                <option value="1443-1444">1443-1444</option>
                                <option value="1444-1445">1444-1445</option>
                            </select>
                            <select onchange="loaddata()" class="form-control form-control-sm float-right mr-2" id="status" style="width: 130px">
                                <option value="">..:Pilih Status:..</option>
                                <option value="0">Proses</option>
                                <option value="1">Resmi</option>
                            </select>
                            <input type="text" onkeyup="loaddata()" class="form-control form-control-sm mr-2 float-right" id="nama" autofocus autocomplete="off" placeholder="Cari nama santri" style="width: 180px">
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12" id="tampildataboyong">

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




<div class="modal fade" id="modal-lg" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Tambah Angket Boyong</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <form autocomplete="off" id="formtambahboyong">
                            <div class="alert alert-warning" role="alert" id="notiferror" style="display: none;"></div>
                            <div class="form-group row">
                                <label for="idsantri" class="col-sm-4 col-form-label">ID P2K</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="idsantri" autofocus>
                                    <small class="text-danger">Tekan ENTER untuk cek data</small>
                                </div>
                            </div>
                            <div class="form-group row mb-0 tampilhasil" style="display: none;">
                                <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="alasan" id="alasan">
                                        <option value="">..:Pilih Alasan:..</option>
                                        <option value="Dibutuhkan Orang Tua">Dibutuhkan Orang Tua</option>
                                        <option value="Faktor Ekonomi">Faktor Ekonomi</option>
                                        <option value="Faktor Kesehatan">Faktor Kesehatan</option>
                                        <option value="Pindah Pesantren/Sekolah">Pindah Pesantren/Sekolah</option>
                                        <option value="Melanjutkan ke Perguruan Tinggi">Melanjutkan ke Perguruan Tinggi</option>
                                        <option value="Menikah">Menikah</option>
                                        <option value="Tidak Kerasan">Tidak Kerasan</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="idsantriboyong" value="">
                        </form>
                        <div class="form-group clearfix mt-4 tampilhasil" style="display: none;">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="wakilwali">
                                <label for="wakilwali">
                                    Pilih jika pemohon merupakan wakil wali santri
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 ml-3">
                        <div class="form-group row tampilhasil" id="databoyong" style="display: none;">

                        </div>
                    </div>
                </div>
                <div class="row tampilhasil" style="display: none;">
                    <div class="col-4">
                        <button type="button" id="refreshdata" class="btn btn-success btn-xs">Refresh</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" id="tombolbatal" class="btn btn-danger btn-sm">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolCek">Lakukan Pengecekan</button>
                <button style="display: none;" class="btn btn-primary btn-sm" id="tombolSimpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-detail" data-backdrop="static" data-keyboard="false">
    <!-- <div class="modal fade" id="modal-detail"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header p-1" style="border-bottom: 0px;">
            </div>
            <div class="modal-body" style="height: 82vh; overflow: auto;" id="tampildetaildata">

            </div>
            <div class="modal-footer p-1" style="border-top: 0px;">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-dialog -->
</div>