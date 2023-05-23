<?php
if ($data) {
    $avatarPath = FCPATH . 'assets/fotosantri/' . $data->tipe_santri . '/' . $data->id_santri . '.jpg';

    if (file_exists($avatarPath) === FALSE || $avatarPath == NULL) {
        $avatar = base_url('assets/fotosantri/' . $data->tipe_santri . '.jpg');
    } else {
        $avatar = base_url('assets/fotosantri/' . $data->tipe_santri . '/' . $data->id_santri . '.jpg');
    }

    $city = str_replace(['Kabupaten', 'Kota'], '', $data->kabupaten_santri);
?>
    <div class="col-9">
        <div class="callout callout-success py-1 px-3">
            <b>DATA DIRI</b>
        </div>
        <dl class="row mb-0">
            <dt class="col-sm-3 font-weight-normal mb-1">ID P2K</dt>
            <dd class="col-sm-9 mb-1">
                <?= $data->id_santri ?>
            </dd>
            <dt class="col-sm-3 font-weight-normal mb-1">Nama</dt>
            <dd class="col-sm-9 mb-1 font-weight-bold"><?= $data->nama_santri ?></dd>
            <dt class="col-sm-3 font-weight-normal mb-1">Tetala</dt>
            <dd class="col-sm-9 mb-1"><?= $data->tempat_lahir_santri ?>, <?= tanggalIndo($data->tanggal_lahir_santri) ?></dd>
            <dt class="col-sm-3 font-weight-normal mb-1">Alamat</dt>
            <dd class="col-sm-9 mb-1">
                <?= $data->desa_santri ?> <?= $data->kecamatan_santri ?> <?= $city ?>
            </dd>
            <dt class="col-sm-3 font-weight-normal mb-1">Domisili</dt>
            <dd class="col-sm-9 mb-1">
                <span class="badge badge-success"><?= $data->status_domisili_santri ?></span>
                <?= $data->domisili_santri ?> - <?= $data->nomor_kamar_santri ?>
            </dd>
            <dt class="col-sm-3 font-weight-normal mb-1">Diniyah</dt>
            <dd class="col-sm-9 mb-1"><?= $data->kelas_diniyah ?> - <?= $data->tingkat_diniyah ?></dd>
            <dt class="col-sm-3 font-weight-normal mb-1">Formal</dt>
            <dd class="col-sm-9 mb-1"><?= $data->kelas_formal ?> - <?= $data->tingkat_formal ?></dd>
        </dl>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body p-0">
                <img src="<?= $avatar ?>" alt="IMAGE OF <?= $data->nama_santri ?>" style="width: 100%; border-radius: 3px;">
            </div>
        </div>
    </div>
<?php
}
?>