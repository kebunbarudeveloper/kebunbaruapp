<table class="table table-sm">
    <thead>
        <tr>
            <th>NO</th>
            <th>ID</th>
            <th>INDUK</th>
            <th>NAMA</th>
            <th>KAMAR</th>
            <th>ALAMAT</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($hasil) {
            $no = 1;
            foreach ($hasil as $dd) {
                $id = $dd->id_santri;
                $kabupaten = str_replace(['Kabupaten', 'Kota'], '', $dd->kabupaten_santri,);
        ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $id ?></td>
                    <td><?= $dd->induk_santri ?></td>
                    <td><?= $dd->nama_santri ?></td>
                    <td><?= $dd->nomor_kamar_santri ?></td>
                    <td><?= $dd->desa_santri . ', ' . $kabupaten ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td class="text-center text-danger" colspan="6">Data Tidak Ditemukan</td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>