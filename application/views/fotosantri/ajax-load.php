<div class="col-12">
    <div class="card" style="height: 71.5vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
            <table class="table table-head-fixed table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th colspan="2" class="text-center">NAMA</th>
                        <th>DOMISILI</th>
                        <th>PENDIDIKAN</th>
                        <th>ALAMAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data) {
                        $tipe = $this->session->userdata('tipe_user');
                        $no = 1;
                        foreach ($data as $dd) {
                            $fotoc = FCPATH . 'assets/foto-temp/';
                            $foto = base_url('assets/foto-temp/');
                            $image = $dd->id_santri . '.jpg';

                            if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                                $fotoj = $foto . $dd->tipe_santri . '.jpg';
                            } else {
                                $fotoj = $foto . $image;
                            }

                            $kab = str_replace(['Kabupaten', 'Kota '], '', $dd->kabupaten_santri);
                    ?>
                            <tr>
                                <td class="align-middle"><?= $no++ ?></td>
                                <td>
                                    <img style="border-radius: 5px;" alt="Foto <?= $dd->nama_santri ?>" width="45px" class="table-avatar" src="<?= $fotoj ?>">
                                </td>
                                <td class="align-middle">
                                    <b><?= $dd->nama_santri ?></b>
                                    <br>
                                    <span class="badge badge-primary"><?= $dd->id_santri ?></span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-success"><?= $dd->status_domisili_santri ?></span> <br>
                                    <?= str_replace('Khusus', '', $dd->domisili_santri) . ' - ' . $dd->nomor_kamar_santri ?>
                                </td>
                                <td class="align-middle">
                                    <?= $dd->kelas_diniyah . ' - ' . $dd->tingkat_diniyah ?> <br>
                                    <?= $dd->kelas_formal . ' - ' . $dd->tingkat_formal ?>
                                </td>
                                <td class="align-middle">
                                    <?= $dd->desa_santri ?> <br>
                                    <?= $dd->kecamatan_santri . ', ' . $kab ?>
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        <?php
                                        if ($tipe == 2) {
                                        ?>
                                            <button type="button" class="btn btn-default btn-sm" title="Hapus data ini" onclick="hapus(<?= $dd->id_santri ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($tipe == 1) {
                                        ?>
                                            <button type="button" class="btn btn-default btn-sm" title="Selesaikan data ini" onclick="selesai(<?= $dd->id_santri ?>)">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr class="text-center"><td colspan="7"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer justify-content-between"></div>
    </div>
</div>