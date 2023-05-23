<div class="card">
    <div class="card-body" style="max-height: 77.5vh; overflow-y: auto;">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KELAS</th>
                    <th>TINGKAT</th>
                    <th>SANTRI BARU</th>
                    <th>SANTRI LAMA</th>
                    <th>MURID BARU</th>
                    <th>MURID LAMA</th>
                </tr>
                <?php
                if ($data) {
                    $no = 1;
                    foreach ($data as $d) {
                ?>
            <tbody>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d->kelas ?></td>
                    <td><?= $d->tingkat ?></td>
                    <td class="text-right"><?= number_format($d->santri_baru, 0, ',', '.') ?></td>
                    <td class="text-right"><?= number_format($d->santri_lama, 0, ',', '.') ?></td>
                    <td class="text-right"><?= number_format($d->murid_baru, 0, ',', '.') ?></td>
                    <td class="text-right"><?= number_format($d->murid_lama, 0, ',', '.') ?></td>
                </tr>
            </tbody>
    <?php
                    }
                }
    ?>
    </thead>
        </table>
    </div>
</div>