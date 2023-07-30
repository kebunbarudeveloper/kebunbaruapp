<div class="row">
    <?php
    if ($data) {
        $fotoc = FCPATH . 'assets/fotosantri/';
        $foto = base_url('assets/fotosantri/');
        $image = $data->tipe_santri . '/' . $data->id_santri . '.jpg';

        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
            $fotoj = $foto . $data->tipe_santri . '.jpg';
        } else {
            $fotoj = $foto . $image;
        }

        $status = $data->status_santri;
        $kataStatus = ['Boyong', 'Aktif', 'Tugas'];

        $kab = str_replace(['Kabupaten', 'Kota '], '', $data->kabupaten_santri);
    ?>
        <div class="col-4">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img src="<?= $fotoj ?>" alt="IMAGE OF <?= $data->nama_santri ?>" style="width: 130px; border-radius: 3px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><b><?= $data->nama_santri ?></b></td>
                            </tr>
                            <tr>
                                <td>Domisili</td>
                                <td>:</td>
                                <td>
                                    <span class="badge badge-success"><?= $data->status_domisili_santri ?></span> |
                                    (<?= $data->domisili_santri ?> - <?= $data->nomor_kamar_santri ?>)
                                </td>
                            </tr>
                            <tr>
                                <td>Diniyah</td>
                                <td>:</td>
                                <td><?= $data->kelas_diniyah ?> - <?= $data->tingkat_diniyah ?></td>
                            </tr>
                            <tr>
                                <td>Formal</td>
                                <td>:</td>
                                <td><?= $data->kelas_formal ?> - <?= $data->tingkat_formal ?></td>
                            </tr>
                            <tr>
                                <td class="align-top">Alamat</td>
                                <td class="align-top">:</td>
                                <td>
                                    <?= $data->desa_santri ?> <br>
                                    <?= $data->kecamatan_santri ?>, <?= $kab ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Wali</td>
                                <td>:</td>
                                <td> <b><?= $data->nama_walisantri ?></b></td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td><?= $data->nomor_hp_walisantri ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="col-12">
            <h5 class="text-center text-danger">
                DATA TIDAK DITEMUKAN
            </h5>
        </div>
    <?php
    }
    ?>
</div>