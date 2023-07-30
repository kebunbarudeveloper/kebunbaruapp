<div class="col-12">
    <div class="card" style="height: 71.8vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>DOMISILI</th>
                        <th>ALAMAT</th>
                        <th>PENDIDIKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data[0]) {
                        $no = 1;
                        foreach ($data[0] as $d) {
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?= $d->nama_santri ?>
                                </td>
                                <td>
                                    <b><?= $d->status_domisili_santri ?></b>, <?= $d->domisili_santri ?> - <?= $d->nomor_kamar_santri ?>
                                </td>
                                <td>
                                    <?= $d->desa_santri . ', ' . $d->kabupaten_santri ?>
                                </td>
                                <td>
                                    <small><?= $d->kelas . ' - ' . $d->tingkat ?></small>
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