<table class="table table-sm" width="100%">
    <thead>
        <tr>
            <th>NO</th>
            <th>ID</th>
            <th>INDUK</th>
            <th>NAMA</th>
            <th>DOMISILI</th>
            <th>ALAMAT</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $kata = ['Belum kembali', 'Ijin terlambat', 'Terlambat Kembali', 'Disiplin'];
        $kelas = ['text-danger', 'text-success', 'text-danger', 'text-success'];
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
                    <td><?= $dd->domisili_santri . ' - ' . $dd->nomor_kamar_santri ?></td>
                    <td><?= $dd->desa_santri . ', ' . $kabupaten ?></td>
                    <td> <span class="<?= $kelas[$dd->status] ?>"><?= $kata[$dd->status] ?></span> </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td class="text-center text-danger" colspan="7">Data Tidak Ditemukan</td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>