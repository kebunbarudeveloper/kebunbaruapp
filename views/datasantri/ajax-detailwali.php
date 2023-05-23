<table class="table table-head-fixed text-nowrap table-hover">
    <thead>
        <tr>
            <th>FOTO</th>
            <th>NAMA</th>
            <th>DOMISILI</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($data) {
            foreach ($data as $dd) {
                $fotoc = FCPATH . 'assets/fotosantri/';
                $foto = base_url('assets/fotosantri/');
                $image = $dd->tipe_santri . '/' . $dd->id_santri . '.jpg';

                if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                    $fotoj = $foto . $dd->tipe_santri . '.jpg';
                } else {
                    $fotoj = $foto . $image;
                }

                $kab = str_replace(['Kabupaten', 'Kota'], '', $dd->kabupaten_santri);

        ?>
                <tr>
                    <td>
                        <img style="border-radius: 5px;" alt="Foto <?= $dd->nama_santri ?>" width="50px" class="table-avatar" src="<?= $fotoj ?>">
                    </td>
                    <td class="align-middle">
                        <b><?= $dd->nama_santri ?></b>
                        <br>
                        <small style="cursor: pointer;" class="text-success copyID"><i class="fa fa-copy"></i> <span><?= $dd->id_santri ?></span></small>

                    </td>
                    <td class="align-middle"><?= $dd->domisili_santri . ' - ' . $dd->nomor_kamar_santri ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>