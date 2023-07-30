<div class="card card-widget widget-user-2 shadow-sm">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-default">
        <div class="widget-user-image">
            <img style="border-radius: 4px;" class="" src="<?= base_url() ?>assets/fotosantri/<?= $data->tipe_santri . '/' . $data->id_santri ?>.jpg" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h5 class="widget-user-username"><?= $data->nama_santri ?></h5>
        <h6 class="widget-user-desc font-weight-light"><?= $data->id_santri ?></h6>
    </div>
    <div class="card-footer p-0">
        <ul class="nav flex-column">
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fa fa-house-user"></i>
                    <span class="float-right">
                        <?= $data->domisili_santri ?> - <?= $data->nomor_kamar_santri ?>
                    </span>
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fa fa-mosque"></i>
                    <span class="float-right">
                        <?= $data->kelas_diniyah ?> - <?= $data->tingkat_diniyah ?>
                    </span>
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fa fa-school"></i>
                    <span class="float-right">
                        <?= $data->kelas_formal ?> - <?= $data->tingkat_formal ?>
                    </span>
                </span>
            </li>
            <li class="nav-item">
                <span class="nav-link">
                    <i class="fa fa-map-marked-alt"></i>
                    <span class="float-right">
                        <?= $data->desa_santri ?>, <?= str_replace(['Kabupaten', 'Kota '], '', $data->kabupaten_santri) ?>
                    </span>
                </span>
            </li>
        </ul>
    </div>
</div>