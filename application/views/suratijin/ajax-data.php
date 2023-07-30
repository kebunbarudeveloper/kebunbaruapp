<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumlah Santri</span>
            <span class="info-box-number">
                <?= $hasil[0] ?>
                <small>Orang</small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<div class="col-12 col-sm-6 col-md-3" data-target="#modal-kosong" data-toggle="modal">
    <div class="info-box" style="cursor: pointer;" id="jumlahPengambil">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-alt"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Jumlah Sesuai Jadwal</span>
            <span class="info-box-number">
                <?= $hasil[3] ?>
                <small>Orang</small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-3" data-target="#modal-satu" data-toggle="modal">
    <div class="info-box mb-3 jumlahStatus" style="cursor: pointer;" data-id="1">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Sudah Ambil</span>
            <span class="info-box-number">
                <?= $hasil[1] ?>
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

<div class="col-12 col-sm-6 col-md-3" data-target="#modal-dua" data-toggle="modal">
    <div class="info-box mb-3 jumlahStatus" style="cursor: pointer;" data-id="2">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Belum Ambil</span>
            <span class="info-box-number">
                <?= $hasil[2] ?>
                <small>Orang</small>
            </span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- Atur Biaya Pendaftaran -->
<div class="modal fade" id="modal-kosong">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Santri Pengambil Surat Ijin</h5>
                <select class="form-control form-control-sm" style="width: 20%;" id="pilihkamarsemua">
                    <option value="">::No. Kamar::</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="modal-body" id="tampilPertama" style="height: 70vh; overflow: auto">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-satu">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Santri Yang Sudah Mengambil Surat Ijin</h5>
                <select class="form-control form-control-sm" style="width: 20%;" id="pilihkamarsudah">
                    <option value="">::No. Kamar::</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
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


<div class="modal fade" id="modal-dua">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Santri Yang Belum Mengambil Surat Ijin</h5>
                <select class="form-control form-control-sm" style="width: 20%;" id="pilihkamarbelum">
                    <option value="">::No. Kamar::</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="modal-body" id="tampilBelum" style="height: 70vh; overflow: auto">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>