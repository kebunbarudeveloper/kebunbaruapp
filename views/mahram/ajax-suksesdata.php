<div class="col-6">
    <h6 class="text-center">IDENTITAS WALI</h6>
    <hr class="mb-1">
    <table class="table-xs" width="100%">
        <tbody>
            <?php
            if ($wali) {
            ?>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><b><?= $wali->nama_walisantri ?></b></td>
                </tr>
                <tr>
                    <td rowspan="2" class="align-top">Alamat</td>
                    <td>:</td>
                    <td><?= $wali->desa_walisantri ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= str_replace(['Kabupaten', 'Kota '], '', $wali->kabupaten_walisantri) ?></td>
                </tr>
                <tr>
                    <td>No. HP</td>
                    <td>:</td>
                    <td><?= $wali->nomor_hp_walisantri ? $wali->nomor_hp_walisantri : '-----' ?></td>
                </tr>
            <?php
            } else {
            ?>
                <tr class="text-center text-danger">
                    <td colspan="3">
                        <h6>Tidak ada data untuk ditampilkan</h6>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <div class="row justify-content-between">
        <button class="btn btn-default btn-sm" style="width: 49%;" data-toggle="modal" data-target="#modal-default">
            Edit Nomor HP
        </button>
        <button class="btn btn-default btn-sm" style="width: 49%;" data-toggle="modal" data-target="#modal-wakil">
            Wakil Wali
        </button>
    </div>
</div>
<div class="col-6">
    <h6 class="text-center">DATA SANTRI</h6>
    <hr class="mb-1">
    <table class="table-xs" width="100%">
        <tbody>
            <?php
            if ($santri) {
                foreach ($santri as $d) {
                    $fotoc = FCPATH . 'assets/fotosantri/';
                    $foto = base_url('assets/fotosantri/');
                    $image = $d->tipe_santri . '/' . $d->id_santri . '.jpg';

                    if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                        $fotoj = $foto . $d->tipe_santri . '.jpg';
                    } else {
                        $fotoj = $foto . $image;
                    }
            ?>
                    <tr>
                        <td style="width: 18%;">
                            <img style="border-radius: 5px" src="<?= $fotoj ?>" alt="FOTO <?= $d->nama_santri ?>" width="50px">
                        </td>
                        <td>
                            <b><?= $d->nama_santri ?></b>
                            <br>
                            <?= $d->desa_santri ?>, <?= str_replace(['Kabupaten', 'Kota '], '', $d->kabupaten_santri) ?>
                            <br>
                            <?= $d->domisili_santri ?> - <?= $d->nomor_kamar_santri ?>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr class="text-center text-danger">
                    <td colspan="2">
                        <h6>Tidak ada data untuk ditampilkan</h6>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <hr class="mb-1 mt-1">
</div>