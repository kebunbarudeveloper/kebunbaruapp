<table class="table table-hover text-nowrap table-sm">
    <thead>
        <tr class="text-center">
            <th>NO</th>
            <th>DOMISILI</th>
            <th>POPULASI</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($data as $d) {
        ?>
            <tr data-toggle="modal" data-target="#modal-xl" title="Klik untuk melihat detail" class="text-center detailKamar" data-daerah="<?= $d->domisili_santri ?>" data-kamar="<?= $d->nomor_kamar_santri ?>" style="cursor: pointer">
                <td><?= $no++ ?></td>
                <td><?= $d->domisili_santri . ' - ' . $d->nomor_kamar_santri ?></td>
                <td><?= $d->total ?> Orang</td>
            </tr>
        <?php } ?>
    </tbody>
</table>