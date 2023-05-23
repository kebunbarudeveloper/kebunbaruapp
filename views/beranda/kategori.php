<table class="table table-hover text-nowrap table-sm">
    <thead>
        <tr>
            <th class="text-center">NO</th>
            <th>DOMISILI</th>
            <th class="text-center" colspan="2">POPULASI</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($perkab[1] as $dkaba) {
            $kab2 = $dkaba->domisili_santri;
            if ($kab2 == '') {
                $kamarj = 'Belum Diatur';
            } else {
                $kamarj = $kab2;
            }
        ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $kamarj ?></td>
                <td class="text-center"><?= $dkaba->total ?></td>
                <td class="text-center">Orang</td>
            </tr>
        <?php } ?>
    </tbody>
</table>