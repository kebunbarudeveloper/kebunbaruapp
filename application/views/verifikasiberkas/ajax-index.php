<div class="col-12">
    <div class="card" style="height: 71.8vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NO. VER.</th>
                        <th>SANTRI</th>
                        <th>PENDIDIKAN</th>
                        <th>WALI</th>
                        <th>PEND. WALI</th>
                        <th>STATUS</th>
                        <th style="width: 3%;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data[0]) {
                        $no = 1;
                        foreach ($data[0] as $d) {
                            $status = $d->status;
                            $platform = $d->platform;
                            $class = ['danger', 'success'];
                            $word = ['Pending', 'Selesai'];

                            $platformWord = ['', 'Offline', 'Online'];
                            $platformClass = ['', 'text-danger', 'text-success'];
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td> <b class="text-primary"> <?= $d->id ?> </b></td>
                                <td>
                                    <?= $d->nama ?> <br>
                                    <small class="<?= $platformClass[$platform] ?>"><?= $platformWord[$platform] ?></small> -
                                    <small><b><?= $d->domisili ?></b>, <?= $d->daerah ?> - <?= $d->kamar ?></small>
                                </td>
                                <td>
                                    <small><?= $d->kelas . ' - ' . $d->tingkat ?></small> <br>
                                    <small><?= $d->kelasf . ' - ' . $d->tingkatf ?></small>
                                </td>
                                <td>
                                    <?= $d->namaw ?> <br>
                                    <small><?= $d->hp ?></small>
                                </td>
                                <td>
                                    <small>- <?= $d->pendidikan ?></small> <br>
                                    <small>- <?= $d->hubungan ?></small>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $class[$status] ?>"><?= $word[$status] ?></span> <br>
                                </td>
                                <td>
                                    <?php

                                    if ($platform == 1) {
                                        if ($status == 1) {
                                            $disabled = 'disabled';
                                        } else {
                                            $disabled = '';
                                        }
                                    } else {
                                        $disabled = 'disabled';
                                    }
                                    ?>
                                    <button title="Edit data" <?= $disabled ?> class="btn btn-block btn-default btn-xs" onclick="edit(<?= $d->id ?>)">
                                        <i class="fa fa-pen"></i>
                                    </button>
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
            <h6>Jumlah : <?= @$data[1] ?> Orang</h6>
        </div>
    </div>
    <!-- /.card -->
</div>