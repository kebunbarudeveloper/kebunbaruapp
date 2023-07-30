<table class="table table-head-fixed text-nowrap table-hover">
    <thead>
        <tr>
            <th>NO</th>
            <th colspan="2" class="text-center">NAMA</th>
            <th>TETALA</th>
            <th>ALAMAT</th>
            <th>DINIYAH</th>
            <th>FORMAL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($data) {
            $no = 1;
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
                    <td class="align-middle"><?= $no++ ?></td>
                    <td>
                        <img style="border-radius: 5px;" alt="Foto <?= $dd->nama_santri ?>" width="50px" class="table-avatar" src="<?= $fotoj ?>">
                    </td>
                    <td class="align-middle">
                        <b><?= $dd->nama_santri ?></b>
                        <br>
                        <small style="cursor: pointer;" class="text-success copyID"><i class="fa fa-copy"></i> <span><?= $dd->id_santri ?></span></small>

                    </td>
                    <td class="align-middle"><?= $dd->tempat_lahir_santri . '<br> ' . @tanggalIndo($dd->tanggal_lahir_santri) ?></td>
                    <td class="align-middle"><?= $dd->desa_santri . '<br>' . $kab ?></td>
                    <td class="align-middle"><?= $dd->kelas_diniyah . '<br>' . $dd->tingkat_diniyah ?></td>
                    <td class="align-middle"><?= $dd->kelas_formal . '<br>' . $dd->tingkat_formal ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>