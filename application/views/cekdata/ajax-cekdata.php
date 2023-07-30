<div class="card" style="height: 74.0vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th style="width: 10%;">ID P2K</th>
                    <th colspan="2">NAMA</th>
                    <th>KABUPATEN</th>
                    <th>STATUS</th>
                    <th colspan="2">DOMISILI</th>
                    <th colspan="2">DINIYAH</th>
                    <th colspan="2">FORMAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datasantri) {
                    $nods = 1;
                    foreach ($datasantri as $ds) {
                        $fotoc = FCPATH . 'assets/fotosantri/';
                        $foto = base_url('assets/fotosantri/');
                        $image = $ds->tipe_santri . '/' . $ds->id_santri . '.jpg';

                        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                            $fotoj = $foto . $ds->tipe_santri . '.jpg';
                        } else {
                            $fotoj = $foto . $image;
                        }
                        $kab = str_replace(['Kabupaten', 'Kota'], '', $ds->kabupaten_santri);
                ?>
                        <tr style="cursor:pointer">
                            <td class="align-middle"><?= $nods++; ?></td>
                            <td>
                                <img style="border-radius: 5px;" alt="Foto <?= $ds->nama_santri ?>" width="45px" class="table-avatar" src="<?= $fotoj ?>">
                            </td>
                            <td class="align-middle">
                                <?= $ds->nama_santri ?> <br>
                                <span class="badge badge-success copyID" title="Klik untuk salin ID P2K">
                                    <i class="fa fa-copy"></i> <span><?= $ds->id_santri ?></span>
                                </span>
                            </td>
                            <td class="align-middle"><?= $ds->desa_santri . ' ' . $kab; ?></td>
                            <td class="align-middle"><?= $ds->status_domisili_santri ?></td>
                            <td class="align-middle"><?= $ds->domisili_santri; ?></td>
                            <td class="align-middle"><?= $ds->nomor_kamar_santri; ?></td>
                            <td class="align-middle"><?= $ds->kelas_diniyah; ?></td>
                            <td class="align-middle"><?= $ds->tingkat_diniyah; ?></td>
                            <td class="align-middle"><?= $ds->kelas_formal; ?></td>
                            <td class="align-middle"><?= $ds->tingkat_formal; ?></td>
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
    </div>
</div>
</div>