<div class="col-6 pl-4">
    <table style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 30%;">Nama</th>
                <th style="width: 5%;">:</th>
                <th style="width: 65%;"><?= $data->nama ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $data->nik ?></td>
            </tr>
            <tr>
                <td>Domisili</td>
                <td>:</td>
                <td><?= $data->domisili ?>, <?= $data->daerah ?> - <?= $data->kamar ?></td>
            </tr>
            <tr>
                <td>Diniyah</td>
                <td>:</td>
                <td><?= $data->kelas ?>, <?= $data->tingkat ?></td>
            </tr>
            <tr>
                <td>Formal</td>
                <td>:</td>
                <td><?= $data->kelasf ?>, <?= $data->tingkatf ?></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-6 pl-4">
    <table style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 30%;">Nama</th>
                <th style="width: 5%;">:</th>
                <th style="width: 65%;"><?= $data->namaw ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $data->nikw ?></td>
            </tr>
            <tr>
                <td>No. HP | WA</td>
                <td>:</td>
                <td><?= $data->hp ?> | <?= $data->wa ?></td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>:</td>
                <td><?= $data->pendidikan ?></td>
            </tr>
            <tr>
                <td>Hubungan</td>
                <td>:</td>
                <td><?= $data->hubungan ?></td>
            </tr>
        </tbody>
    </table>
</div>