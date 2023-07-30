<div class="card" style="height: 71.8vh;">
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID</th>
                    <th>PESANTREN</th>
                    <th>PESERTA</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($data !== 0) {
                    foreach ($data as $d) {
                        $kata = ['Belum Isi Data', 'Sudah Isi Data'];
                        $kata1 = ['Belum Checkin', 'Sudah Checkin'];
                        $kata2 = ['', 'Nomor WA: ' . $d->wa];
                ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d->id ?></td>
                            <td>
                                <?= $d->nama ?> <br>
                                <small class="text-success"><?= $kata2[$d->checkin] ?></small>
                            </td>
                            <td>- <?= $d->peserta_1 ?> <br>- <?= $d->peserta_2 ?></td>
                            <td><?= $kata[$d->status] ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#modal-coba" data-id="<?= $d->id ?>" onclick="getid(this)" class="btn btn-success btn-xs">
                                    Checkin
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
</div>