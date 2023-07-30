<?php
if ($hasil) {
    $kab = str_replace(['Kabupaten', 'Kota'], '', $hasil->kabupaten_santri);
?>
    <div class="row">
        <div class="col-8">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID P2K</th>
                        <th>:</th>
                        <th><?= $hasil->id_santri ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>No. Induk</td>
                        <td>:</td>
                        <td><?= $hasil->induk_santri ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $hasil->nama_santri ?></td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="align-top">Alamat</td>
                        <td class="align-top">:</td>
                        <td><?= $hasil->dusun_santri ?>, RT <?= $hasil->rt_santri ?>/RW <?= $hasil->rw_santri ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= $hasil->desa_santri ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= $hasil->kecamatan_santri ?> <?= $kab ?></td>
                    </tr>
                    <tr>
                        <td>Domisili</td>
                        <td>:</td>
                        <td>P2K, <?= $hasil->domisili_santri ?> - <?= $hasil->nomor_kamar_santri ?></td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td><?= $hasil->kelas_diniyah ?> - <?= $hasil->tingkat_diniyah ?></td>
                    </tr>
                    <tr>
                        <td>Wali</td>
                        <td>:</td>
                        <td><?= $hasil->nama_walisantri ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <img width="100%" src="<?= base_url() ?>assets/fotosantri/<?= $hasil->tipe_santri ?>/<?= $hasil->id_santri ?>.jpg" alt="Foto Santri">
        </div>
    </div>
<?php

} else {
    echo 'Tak ada data untuk ditampilkan';
}
