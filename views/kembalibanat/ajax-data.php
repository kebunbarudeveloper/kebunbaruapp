<input type="hidden" id="valtipe" value="">
<div class="col-12 col-sm-6 col-md-4">
    <div class="info-box">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Seluruh Santri</span>
            <span class="info-box-number">
                <small>Kembali : </small><?= $hasil[0] ?>
                <small>orang</small> <br>
                <small>
                    Belum Kembali : <b><?= $hasil[1] ?></b> orang 
                </small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3 checked" style="cursor: pointer;">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Sudah Kembali</span>
            <span class="info-box-number">
                <small>Disiplin :</small> <?= $hasil[2] ?>
                <small>Orang</small> <br>
                <small>Terlambat :</small> <?= $hasil[3] ?>
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

<div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3 not-checked" style="cursor: pointer;">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Belum Kembali</span>
            <span class="info-box-number">
                <small>Ijin :</small> <?= $hasil[4] ?>
                <small>Orang</small> <br>
                <small>Tanpa Ijin :</small> <?= $hasil[5] ?>
                <small>Orang</small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
