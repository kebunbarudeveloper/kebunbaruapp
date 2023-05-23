<div class="col-6">
    <div class="card">
        <div class="card-body py-2 text-center">
            <h6 class="mb-0">DATA CALON SANTRI</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-sm text-left">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <th><?= $data->nama ?></th>
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
                        <td><?= $data->domisili ?>, <?= $data->daerah ?> - <?= $data->nomor ?></td>
                    </tr>
                    <tr>
                        <td>Diniyah</td>
                        <td>:</td>
                        <td><?= $data->kelasd ?> - <?= $data->diniyah ?></td>
                    </tr>
                    <tr>
                        <td>Formal</td>
                        <td>:</td>
                        <td><?= $data->kelasf ?> - <?= $data->formal ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="card">
        <div class="card-body py-2 text-center">
            <h6 class="mb-0">DATA CALON WALI SANTRI</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-sm text-left">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>:</th>
                        <th><?= $data->namaw ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td><?= $data->nikw ?></td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td><?= $data->hp ?></td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td><?= $data->pendidikanw ?></td>
                    </tr>
                    <tr>
                        <td>Hubungan</td>
                        <td>:</td>
                        <td><?= $data->hubungan ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>