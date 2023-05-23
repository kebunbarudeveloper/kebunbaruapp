<div class="col-12" style="height: 64vh;">
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-pendapatan" data-toggle="pill" href="#tab-pendapatan-tab"
                        role="tab" aria-controls="tab-pendapatan-tab" aria-selected="true">Pendapatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                        href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                        aria-selected="false">Belanja</a>
                </li>
            </ul>
        </div>
        <div class="card-body pt-0" id="cardScroll" style="height: 60vh; overflow-y: auto;">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade active show" id="tab-pendapatan-tab" role="tabpanel"
                    aria-labelledby="tab-pendapatan">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID AKUN</th>
                                <th>NAMA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($datapendapatan) {
                                $no1 = 1;
                                foreach ($datapendapatan as $satu) {
                            ?>
                            <tr>
                                <td><?= $no1++ ?></td>
                                <td><span class="badge badge-btn badge-success"><?= $satu->id_akunkeuangan ?></span>
                                </td>
                                <td><?= $satu->nama_akunkeuangan ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal-default"
                                        class="btn btn-xs btn-warning editdata" data-tipeedit="1"
                                        data-id="<?= $satu->id_akunkeuangan ?>"
                                        data-nama="<?= $satu->nama_akunkeuangan; ?>">Sunting</button>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-three-profile-tab">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID AKUN</th>
                                <th>NAMA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($databelanja) {
                                $no2 = 1;
                                foreach ($databelanja as $dua) {
                            ?>
                            <tr>
                                <td><?= $no2++ ?></td>
                                <td><span class="badge badge-btn badge-success"><?= $dua->id_akunkeuangan ?></span>
                                </td>
                                <td><?= $dua->nama_akunkeuangan ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal-default"
                                        class="btn btn-xs btn-warning editdata" data-tipeedit="2"
                                        data-id="<?= $dua->id_akunkeuangan ?>"
                                        data-nama="<?= $dua->nama_akunkeuangan; ?>">Sunting</button>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>