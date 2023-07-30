<div class="card" style="height: 71.8vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed text-nowrap table-hover table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID P2K</th>
                    <th>NAMA</th>
                    <!-- <th>UMUR</th> -->
                    <th>KABUPATEN</th>
                    <!-- <th>STATUS</th> -->
                    <th colspan="2">DOMISILI</th>
                    <th colspan="2" class="hideDetail">DINIYAH</th>
                    <th colspan="2" class="hideDetail">FORMAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datasantri) {
                    $nods = 1;
                    foreach ($datasantri as $ds) {
                        $kab = str_replace(['Kabupaten', 'Kota'], '', $ds->kabupaten_santri);
                ?>
                        <tr class="posisimouse" data-id="<?= $ds->id_santri; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail" style="cursor:pointer">
                            <td><?= $nods++; ?></td>
                            <td><?= $ds->id_santri ?></td>
                            <td><?= $ds->nama_santri ?></td>
                            <!-- <td><?= $ds->umur ?></td> -->
                            <td><?= $kab; ?></td>
                            <!-- <td><?= $ds->status_domisili_santri ?></td> -->
                            <td><?= $ds->domisili_santri; ?></td>
                            <td><?= $ds->nomor_kamar_santri; ?></td>
                            <td class="hideDetail"><?= $ds->kelas_diniyah; ?></td>
                            <td class="hideDetail"><?= $ds->tingkat_diniyah; ?></td>
                            <td class="hideDetail"><?= $ds->kelas_formal; ?></td>
                            <td class="hideDetail"><?= $ds->tingkat_formal; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr class="text-center text-danger"><td colspan="11">Tidak ada data untuk ditampilkan</td></tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <b>Total Santri : <?= $totalsantri->total ?> orang<b>
    </div>
</div>
</div>