<div class="card" style="height: 71.8vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th colspan="2" class="text-center">NAMA</th>
                    <th>TETALA</th>
                    <th>ALAMAT</th>
                    <th>DOMISILI</th>
                    <th>DINIYAH</th>
                    <th>FORMAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datasantri) {
                    $no = 1;
                    foreach ($datasantri as $dd) {
                        $fotoc = FCPATH . 'assets/fotosantri/';
                        $foto = base_url('assets/fotosantri/');
                        $image = $dd->tipe_santri . '/' . $dd->id_santri . '.jpg';

                        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                            $fotoj = $foto . $dd->tipe_santri . '.jpg';
                        } else {
                            $fotoj = $foto . $image;
                        }

                        $kab = str_replace('Kabupaten', '', $dd->kabupaten_santri);

                ?>
                        <tr style="cursor: pointer;" title="Klik untuk detail" data-id="<?= $dd->id_santri ?>" data-toggle="modal" data-target="#modal-detail" class="detaildata">
                            <td class="align-middle"><?= $no++ ?></td>
                            <td>
                                <img style="border-radius: 5px;" alt="Foto <?= $dd->nama_santri ?>" width="45px" class="table-avatar" src="<?= $fotoj ?>">
                            </td>
                            <td class="align-middle">
                                <b><?= $dd->nama_santri ?></b>
                                <br>
                                <!-- <small class="text-success"><i class="fa fa-calendar-day"></i> Umur : <?= $dd->umur ?> Tahun</small> -->
                                <small class="text-success"><i class="fa fa-calendar-day"></i> <?= $dd->id_santri ?></small>
                            </td>
                            <td class="align-middle"><?= $dd->tempat_lahir_santri . '<br> ' . @tanggalIndoShort($dd->tanggal_lahir_santri) ?></td>
                            <td class="align-middle"><?= $dd->desa_santri . '<br>' . $kab ?></td>
                            <td class="align-middle"><?= str_replace('Khusus', '', $dd->domisili_santri) . '<br>' . $dd->nomor_kamar_santri . ', ' . $dd->status_domisili_santri ?></td>
                            <td class="align-middle"><?= $dd->kelas_diniyah . '<br>' . $dd->tingkat_diniyah ?></td>
                            <td class="align-middle"><?= $dd->kelas_formal . '<br>' . $dd->tingkat_formal ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr class="text-center"><td colspan="8"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
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