<div class="card" style="max-height: 71.5vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th colspan="2" class="text-center">NAMA</th>
                    <th>DOMISILI</th>
                    <th>ALASAN</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
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

                        $kab = str_replace(['Kota ', 'Kabupaten '], '', $dd->kabupaten_santri);

                        $kata = ['Permohonan', 'Aktif', 'Kembali Disiplin', 'Kembali Telat'];
                        $class = ['primary', 'success', 'primary', 'danger'];
                ?>
                        <tr style="cursor: pointer;">
                            <td class="align-middle"><?= $no++ ?></td>
                            <td>
                                <img style="border-radius: 5px;" alt="Foto <?= $dd->nama_santri ?>" width="45px" class="table-avatar" src="<?= $fotoj ?>">
                            </td>
                            <td class="align-middle">
                                <b><?= $dd->nama_santri ?></b>
                                <button class="btn btn-xs btn-default px-2">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <br>
                                <small>
                                    <?= $dd->desa_santri . ', ' . $kab ?>
                                </small>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-success"><?= $dd->status_domisili_santri ?></span> <br>
                                <?= str_replace('Khusus', '', $dd->domisili_santri) . ' - ' . $dd->nomor_kamar_santri ?>
                            </td>
                            <td class="align-middle">
                                <?= $dd->alasan ?> <br>
                                <small> <?= @datetimeIDShirtFormat($dd->active_to) ?></small>
                            </td>
                            <td class="align-middle">
                                <span class="badge badge-<?= $class[$dd->status] ?>">
                                    <?= $kata[$dd->status] ?>
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <?php
                                if ($dd->status == 0) {
                                ?>
                                    <a href="<?= base_url() ?>perizinan/getLinkPrint/<?= $dd->id ?>" target="_blank" class="btn btn-xs btn-default px-2">
                                        <i class="fas fa-print"></i>
                                    </a>
                                <?php
                                } else if ($dd->status == 1) {
                                ?>
                                    <a href="<?= base_url() ?>perizinan/getLinkSurat/<?= $dd->id ?>" target="_blank" class="btn btn-xs btn-default px-2">
                                        <i class="fas fa-print"></i>
                                    </a>
                                <?php
                                } else {
                                    echo '<small>Selesai</small>';
                                }
                                ?>
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
        <b>Total : <?= $total ?> izin<b>
    </div>
</div>
</div>