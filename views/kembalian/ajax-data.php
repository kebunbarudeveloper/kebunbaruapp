<?php
if ($zone == 1) {
    $listZone = [
        'Bahasa Arab',
        'Bahasa Inggris',
        'Bahasa Jawa',
        'Khusus Tahfidz al-Qur\'an'
    ];
} elseif ($zone == 2) {
    $listZone = [
        'Khusus Takhossus',
        'Khusus Qur\'ani',
        'Bahasa Indonesia'
    ];
}
?>
<input type="hidden" id="valtipe" value="">
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box bg-dark">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Seluruh Santri</span>
            <span class="info-box-number">
                <small>Kembali : </small><?= $hasil[1] ?>
                <small>Orang</small> <br>
                <small>
                    Disiplin : <b><?= $hasil[8] ?></b> |
                    Telat : <b><?= $hasil[9] ?></b>
                </small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box bg-dark" id="jumlahPengambil">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Seluruh Santri</span>
            <span class="info-box-number">
                <small>Belum Kembali : </small><?= $hasil[0] ?>
                <small>Orang</small> <br>
                <small>
                    Izin : <b><?= $hasil[11] ?></b> |
                    Tanpa Izin : <b><?= $hasil[10] ?></b>
                </small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-3" data-target="#modal-satu" data-toggle="modal">
    <div class="info-box bg-dark mb-3 jumlahStatus" style="cursor: pointer;" data-id="1">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Kembali Sesuai Zona</span>
            <span class="info-box-number">
                <small>Disiplin :</small> <?= $hasil[4] ?>
                <small>Orang</small> <br>
                <small>Terlambat :</small> <?= $hasil[5] ?>
                <small>Orang</small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-6 col-md-3" data-target="#modal-satu" data-toggle="modal">
    <div class="info-box bg-dark mb-3 jumlahStatus" style="cursor: pointer;" data-id="2">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Belum Kembali Sesuai Zona</span>
            <span class="info-box-number">
                <small>Ijin :</small> <?= $hasil[6] ?>
                <small>Orang</small> <br>
                <small>Tanpa Ijin :</small> <?= $hasil[7] ?>
                <small>Orang</small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->



<div class="modal fade" id="modal-satu">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Santri yang Kembali Sesuai Zona</h5>
                <select class="form-control form-control-sm" style="width: 20%;" id="pilihdaerah">
                    <option value="">::Daerah::</option>
                    <?php
                    $no = 0;
                    $nol = 0;
                    foreach ($listZone as $d) {
                    ?>
                        <option value="<?= $d ?>"><?= $d ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="modal-body" id="tampilSudah" style="height: 70vh; overflow: auto">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>