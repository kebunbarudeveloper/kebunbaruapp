<div class="card" style="max-height: 71.5vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th colspan="2" class="text-center">NAMA</th>
                    <th>ALAMAT</th>
                    <th>DOMISILI</th>
                    <th>ALASAN</th>
                    <th>STATUS</th>
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

                        $kab = str_replace('Kabupaten', '', $dd->kabupaten_santri);

                        $kata = ['Dalam proses', 'Resmi boyong'];
                        $class = ['success', 'primary'];
                ?>
                        <tr style="cursor: pointer;" title="Klik untuk detail" onclick="getdetail(<?= $dd->id_datasantriboyong ?>)">
                            <td class="align-middle"><?= $no++ ?></td>
                            <td>
                                <img style="border-radius: 5px;" alt="Foto <?= $dd->nama_santri ?>" width="45px" class="table-avatar" src="<?= $fotoj ?>">
                            </td>
                            <td class="align-middle">
                                <b><?= $dd->nama_santri ?></b>
                                <br>
                                <small class="text-success"> <?= $dd->id_santri ?></small>
                            </td>
                            <td class="align-middle"><?= $dd->desa_santri . '<br>' . $kab ?></td>
                            <td class="align-middle">
                                <span class="badge badge-success"><?= $dd->status_domisili_santri ?></span> <br>
                                <?= str_replace('Khusus', '', $dd->domisili_santri) . ' - ' . $dd->nomor_kamar_santri ?>
                            </td>
                            <td class="align-middle"><?= $dd->alasan_boyong ?></td>
                            <td class="align-middle">
                                <span class="badge badge-<?= $class[$dd->status_angket] ?>">
                                    <?= $kata[$dd->status_angket] ?>
                                </span>
                            </td>
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
        <b>Total Santri Boyong : <?= $total ?> orang<b>
    </div>
</div>
</div>