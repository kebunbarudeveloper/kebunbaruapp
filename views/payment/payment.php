<!-- Content Wrapper. Contains page content -->
<form action="<?= base_url() ?>payment/print" method="post" target="_blank" id="formprintafterpay">
    <input type="hidden" name="invoice" id="invoiceprint" value="0">
</form>
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
                        <div class="card-header py-2">
                            <button <?= ($pengaturan <= 0) ? 'disabled' : '' ?> type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-tambah">
                                <i class="fa fa-plus-circle"></i>
                                Tambah Pembayaran
                            </button>
                            <a href="<?= base_url() ?>exportexcel/payment" class="mr-2 btn btn-sm btn-primary float-right">
                                <i class="fa fa-download"></i>
                                Export
                            </a>
                            <input type="hidden" id="resulthijriah" value="<?= $bulan ?>">
                            <input type="hidden" id="resultstatus" value="">
                            <select id="changeBulan" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 130px;">
                                <option value="">Semua Bulan</option>
                                <option <?= ($bulan == '01') ? 'selected' : '' ?> value="01">Muharram</option>
                                <option <?= ($bulan == '02') ? 'selected' : '' ?> value="02">Shafar</option>
                                <option <?= ($bulan == '03') ? 'selected' : '' ?> value="03">Rabi'ul Awal</option>
                                <option <?= ($bulan == '04') ? 'selected' : '' ?> value="04">Rabi'ul Tsani</option>
                                <option <?= ($bulan == '05') ? 'selected' : '' ?> value="05">Jumadal Ula</option>
                                <option <?= ($bulan == '06') ? 'selected' : '' ?> value="06">Jumadal Akhirah</option>
                                <option <?= ($bulan == '07') ? 'selected' : '' ?> value="07">Rajab</option>
                                <option <?= ($bulan == '08') ? 'selected' : '' ?> value="08">Sya'ban</option>
                                <option <?= ($bulan == '09') ? 'selected' : '' ?> value="09">Ramadhan</option>
                                <option <?= ($bulan == '10') ? 'selected' : '' ?> value="10">Syawal</option>
                                <option <?= ($bulan == '11') ? 'selected' : '' ?> value="11">Dzul Qo'dah</option>
                                <option <?= ($bulan == '12') ? 'selected' : '' ?> value="12">Dzul Hijjah</option>
                            </select>
                            <select id="changeStatus" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 100px;">
                                <option value="">Semua</option>
                                <option value="LUNAS">Lunas</option>
                                <option value="BELUM LUNAS">Belum Lunas</option>
                            </select>
                            <input placeholder="Ketikkan nama lalu ENTER" type="text" id="changenama" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 200px;">
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if ($pengaturan <= 0) {
            ?>
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-default alert-dismissible">
                                    <span class="text-danger">
                                        <h5><i class="icon fas fa-info"></i> PERHATIAN!</h5>
                                        <hr>
                                        - Anda tidak bisa melayani Pembayaran Biaya Tahunan jika pengaturan belum ditutup. <br>
                                        - Pastikan semua tarif sudah diatur sebelum pengaturan ditutup. <br>
                                    </span>
                                    <a class="btn btn-sm btn-danger mt-5" href="<?= base_url() ?>aturtarif">Tutup Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="row" id="tampil">

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>

<!-- Modal tambah Pembayaran -->
<div class="modal fade" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Tambah Pembayaran</h6>
                <button class="btn btn-sm btn-default float-right" id="tombolcekpengurangan"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group row">
                            <label for="idsantri" class="col-sm-6 col-form-label">ID SANTRI/MURID</label>
                            <div class="col-sm-6">
                                <input data-inputmask="'mask' : '99999999'" data-mask="" type="text" class="form-control" id="idsantri" autocomplete="off">
                                <small class="text-danger">Tekan ENTER</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" id="tampilnominal" style="display: none;">
                        <form autocomplete="off" id="formtambahpembayaran">
                            <input type="hidden" name="idfix" id="idfix" value="0">
                            <input type="hidden" name="nikfix" id="nikfix" value="0">
                            <input type="hidden" name="tagihanawal" id="tagihanawal" value="0">
                            <input type="hidden" name="tagihanfix" id="tagihanfix" value="0">
                            <input type="hidden" name="jumlahfix" id="jumlahfix" value="0">
                            <input type="hidden" name="nominalfix" id="nominalfix" value="0">
                            <input type="hidden" name="tahappembayaran" id="tahappembayaran" value="0">
                            <input type="hidden" name="mutasidomisili" id="mutasidomisili" value="0">
                            <input type="hidden" name="saudara" id="saudara" value="0">
                            <input type="hidden" name="lainjenis" id="lainjenis" value="0">
                            <input type="hidden" name="tipe_saudara" id="tipe_saudara" value="0">
                            <input type="hidden" name="seragam" id="seragam" value="0">
                            <input type="hidden" name="penambahan" id="penambahan" value="0">
                            <input type="hidden" name="ubah_domisili" id="ubah_domisili" value="0">
                            <input type="hidden" name="totaldiskon" id="totaldiskon" value="0">

                            <!-- PENAMPUNG NOMINAL DISKON -->
                            <input type="hidden" name="nominalmutasidomisili" id="nominalmutasidomisili" value="0">
                            <input type="hidden" name="nominalsejenis" id="nominalsejenis" value="0">
                            <input type="hidden" name="nominallainjenis" id="nominallainjenis" value="0">
                            <input type="hidden" name="nominalseragam" id="nominalseragam" value="0">
                            <input type="hidden" name="nominalpenambahan" id="nominalpenambahan" value="0">
                            <input type="hidden" name="nominalubahdomisili" id="nominalubahdomisili" value="0">
                        </form>
                        <div class="form-group row">
                            <label for="nominal" class="col-sm-4 col-form-label text-right">NOMINAL</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control rupiahFormat" id="nominal" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-3" id="tampileditkelas" style="display: none;">
                        <button type="button" class="btn btn-default float-right mr-2" id="modaleditkelas" data-toggle="modal" data-target="#modal-edit-kelas">
                            <i class="fa fa-user-edit"></i>
                            Edit Data Kelas
                        </button>
                    </div>
                </div>
                <div class="row" id="divdiskon" style="display: none;">
                    <div class="col-12">
                        <form id="formtampilpengurangan">
                            <div class="form-group clearfix divopsi" id="divminmutasidomisili">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" id="minmutasidomisili">
                                    <label for="minmutasidomisili" class="font-weight-normal text-danger">
                                        Pengurangan Mutasi Domisili/Jenjang
                                    </label>
                                </div>
                            </div>
                            <div class="form-group clearfix divopsi" id="divminsejenis" style="display: none;">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" id="minsejenis">
                                    <label for="minsejenis" class="font-weight-normal text-danger">
                                        Pengurangan Saudara Sejenis
                                    </label>
                                </div>
                            </div>
                            <div class="form-group clearfix divopsi" id="divminlainjenis" style="display: none;">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" id="minlainjenis">
                                    <label for="minlainjenis" class="font-weight-normal text-danger">
                                        Pengurangan Saudara Lain Jenis
                                    </label>
                                </div>
                            </div>
                            <div class="form-group clearfix divopsi" id="divminseragam" style="display: none;">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" id="minseragam">
                                    <label for="minseragam" class="font-weight-normal text-danger">
                                        Pengurangan Seragam
                                    </label>
                                </div>
                            </div>
                            <div class="form-group clearfix divopsi" id="divpenambahan" style="display: none;">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="pluspenambahan">
                                    <label for="pluspenambahan" class="font-weight-normal text-success">
                                        Penambahan Mutasi Jenjang
                                    </label>
                                </div>
                            </div>
                            <div class="form-group clearfix divopsi" id="divplusubahdomisili" style="display: none;">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" id="plusubahdomisili">
                                    <label for="plusubahdomisili" class="font-weight-normal text-success">
                                        Opsi Penambahan Pindah Status Domisili
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="divdatasantri" style="display: none;">
                    <hr>
                    <div class="row">
                        <div class="col-9" id="tampildatasantri"></div>
                        <div class="col-3">
                            <table class="table table-striped table-sm">
                                <tbody>
                                    <tr>
                                        <td>-</td>
                                        <td><span class="badge badge-success" id="tahap"></span></td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>Tagihan</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td id="tampiltagihan"></td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td>-</td>
                                        <td>Pengurangan</td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td></td>
                                        <td id="jumlahdiskon">Rp. 0</td>
                                    </tr>
                                    <tr class="text-primary">
                                        <td>-</td>
                                        <td>Penambahan</td>
                                    </tr>
                                    <tr class="text-primary">
                                        <td></td>
                                        <td id="jumlahpenambahan">Rp. 0</td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td><b class="font-weight-bold text-success">TOTAL AKHIR</b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td id="setelahdiskon">Rp. 0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolsimpan" disabled>Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Edit Kelas -->
<div class="modal fade" id="modal-edit-kelas" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Edit Kelas</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="idedit" id="idedit" value="0">
                    <div class="col-5">
                        <select name="kelasedit" id="kelasedit" class="form-control">
                            <option value="">..:Pilih Kelas:..</option>
                            <option value="0">0</option>
                            <option value="TPQ">TPQ</option>
                            <option value="RA">RA</option>
                            <option value="Jilid">Jilid</option>
                            <option value="Takhossus">Takhossus
                            </option>
                            <?php
                            $kaa = 1;
                            for ($ke = 1; $ke <= 6; $ke++) {
                            ?>
                                <option value="<?= $ke; ?>"><?= $ke; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-7">
                        <select id="tingkatedit" class="form-control">
                            <option value="">.:Pilih Tingkat:.</option>
                            <option value="RA">RA</option>
                            <option value="I'dadiyah">I'dadiyah</option>
                            <option value="Ibtidaiyah">Ibtidaiyah</option>
                            <option value="Tsanawiyah">Tsanawiyah</option>
                            <option value="Aliyah">Aliyah</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="simpaneditkelas">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- MODAL DETAIL DATA -->
<div class="modal fade" id="modal-detail" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="showdetail">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>