<div class="col-12">
    <div class="card" style="height: 71.8vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>IDENTITY</th>
                        <th>SANTRI</th>
                        <th>ADMINISTRSI</th>
                        <th>WALI</th>
                        <th>KET</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data) {
                        $no = 1;
                        foreach ($data as $d) {
                            $status = $d->status;
                            $platform = $d->platform;
                            $wordStatus = ['pending', 'selesai'];
                            $classStatus = ['danger', 'success'];

                            $wordPlatform = ['', 'Offline', 'Online'];
                            $classPlatform = ['', 'danger', 'success'];
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <b class="text-primary"><?= $d->id ?></b> <br>
                                    <div class="btn-group mt-2">
                                        <button type="button" class="btn btn-default btn-sm" <?= ($d->status == 1) ? 'disabled' : '' ?> title="Edit Data" data-toggle="modal" data-target="#modal-tambah" onclick="edit(<?= $d->id ?>)">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm" <?= ($d->status == 1) ? 'disabled' : '' ?> title="Tambah ke Data Santri" onclick="beforesetdatasantri(<?= $d->id ?>)">
                                            <i class="fas fa-user-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm" title="Print Out Salinan" <?= ($d->status != 1) ? 'disabled' : '' ?> onclick="print(<?= $d->id_santri ?>)">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <?= $d->nama ?> <br>
                                    <small><?= $d->nik ?></small> <br>
                                    <small><?= $d->desa ?>, <?= str_replace(['Kabupaten', 'Kota '], '', $d->kabupaten) ?></small>
                                </td>
                                <td>
                                    <small><?= $d->domisili ?>, <?= $d->daerah ?> - <?= $d->kamar ?></small> <br>
                                    <small><?= $d->kelas ?> - <?= $d->tingkat ?> </small> <br>
                                    <small><?= $d->kelasf ?> - <?= $d->tingkatf ?> </small>
                                </td>
                                <td>
                                    <?= $d->namaw ?> <br>
                                    <small><?= $d->hp ?></small> <br>
                                    <small><?= $d->desaw ?>, <?= str_replace(['Kabupaten', 'Kota '], '', $d->kabupatenw) ?></small>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $classStatus[$status] ?>"><?= $wordStatus[$status] ?></span> <br>
                                    <small class="text-<?= $classPlatform[$platform] ?>"><?= $wordPlatform[$platform] ?></small>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <b>Jumlah : <?= $total ?> Orang</b>
        </div>
    </div>
    <!-- /.card -->
</div>