<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-body py-2">
                <h6 class="text-center mb-0">DATA MAHRAM</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img style="width: 40%; border-radius: 3px;" src="<?= base_url() ?>assets/fotowali/<?= $data->foto ?>.jpg" alt="User profile picture">
                </div>

                <h6 class="text-center mt-2"><?= $data->nama ?></h6>

                <ul class="list-group list-group-unbordered text-center">
                    <li class="list-group-item">
                        <span>Dibuat pada : <?= TampilHijri($data->tanggal) ?> H</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card">
            <div class="card-body py-2">
                <h6 class="text-center mb-0">DATA SANTRI</h6>
            </div>
        </div>
        <?php
        foreach ($santri as $row) {
        ?>
            <div class="card">
                <div class="card-body p-0">
                    <div style="display: flex;">
                        <img style="width: 20%; border-top-left-radius: 3px; border-bottom-left-radius: 3px;" src="<?= base_url() ?>assets/fotosantri/<?= $row->tipe_santri . '/' . $row->id_santri ?>.jpg" alt="User profile picture">
                        <div style="padding: 10px;">
                            <span><b><?= $row->nama_santri ?></b></span>
                            <ul style="padding-inline-start: 16px;">
                                <li class="text-xs"><?= $row->desa_santri ?>, <?= $row->kabupaten_santri ?></li>
                                <li class="text-xs"><?= $row->domisili_santri ?> - <?= $row->nomor_kamar_santri ?></li>
                                <li class="text-xs"><?= $row->kelas_diniyah ?> - <?= $row->tingkat_diniyah ?>, <?= $row->kelas_formal ?> - <?= $row->tingkat_formal ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>