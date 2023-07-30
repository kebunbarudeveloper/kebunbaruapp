<div class="row text-xs">
    <?php
    if ($data) {
        $fotoc = FCPATH . 'assets/fotosantri/';
        $foto = base_url('assets/fotosantri/');
        $image = $data->tipe_santri . '/' . $data->id_santri . '.jpg';

        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
            $fotoj = $foto . $data->tipe_santri . '.jpg';
        } else {
            $fotoj = $foto . $image;
        }

        $status = $data->status_santri;
        $kataStatus = ['Boyong', 'Aktif', 'Tugas'];

        $kab = str_replace('Kabupaten', '', $data->kabupaten_santri);
    ?>

        <div class="col-12 col-sm-9 col-md-9">
            <div class="card mb-0" style="height: 500px;">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 text-center">
                            <div class="card card-comments py-3">
                                <h6 class="mb-0">Data Santri</h6>
                            </div>
                            <table class="table text-left table-sm">
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>:</th>
                                        <th><?= $data->nama_santri ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ID P2K</td>
                                        <td>:</td>
                                        <td><?= $data->id_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td>NO. INDUK</td>
                                        <td>:</td>
                                        <td><?= $data->induk_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td><?= $data->nik_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td>NO. KK</td>
                                        <td>:</td>
                                        <td><?= $data->kk_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td>TETALA</td>
                                        <td>:</td>
                                        <td>
                                            <?= $data->tempat_lahir_santri ?>,
                                            <?= @tanggalIndo($data->tanggal_lahir_santri) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">ALAMAT</td>
                                        <td>:</td>
                                        <td><?= $data->dusun_santri ?>, RT <?= $data->rt_santri ?>/RW <?= $data->rw_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->desa_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->kecamatan_santri . ' ' . $kab ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->provinsi_santri ?>, <?= $data->kode_pos_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td>AYAH</td>
                                        <td>:</td>
                                        <td><?= $data->ayah_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td>IBU</td>
                                        <td>:</td>
                                        <td><?= $data->ibu_santri ?></td>
                                    </tr>
                                    <tr>
                                        <td>MASUK</td>
                                        <td>:</td>
                                        <td><?= TampilHijri($data->tanggal_masuk) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 text-center">
                            <div class="card card-comments py-3">
                                <h6 class="mb-0">Data Wali</h6>
                            </div>
                            <table class="table text-left table-sm">
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>:</th>
                                        <th><?= $data->nama_walisantri ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ID WALI</td>
                                        <td>:</td>
                                        <td><?= $data->id_walisantri ?></td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td><?= $data->nik_walisantri ?></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">ALAMAT</td>
                                        <td>:</td>
                                        <td><?= $data->dusun_walisantri ?>, RT <?= $data->rt_walisantri ?>/RW <?= $data->rw_walisantri ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->desa_walisantri ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->kecamatan_walisantri ?> <?= str_replace('Kabupaten', '', $data->kabupaten_walisantri) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->provinsi_walisantri ?>, <?= $data->kode_pos_walisantri ?></td>
                                    </tr>
                                    <tr>
                                        <td>HUBUNGAN</td>
                                        <td>:</td>
                                        <td><?= $data->hubungan_wali ?></td>
                                    </tr>
                                    <tr>
                                        <td>NO. HP</td>
                                        <td>:</td>
                                        <td><?= $data->nomor_hp_walisantri ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                            $jabatanUser = $this->session->userdata('jabatan_user');
                            if ($jabatanUser != 47) {
                            ?>
                                <div style="margin-top: 60px;" class="text-center">
                                    <button title="Sunting Data Santri" class="btn btn-app bg-default" id="editsantri" data-toggle="modal" data-target="#modal-editsantri">
                                        <i class="fas fa-user"></i> Santri
                                    </button>
                                    <button title="Sunting Data Wali" class="btn btn-app bg-default" data-toggle="modal" data-target="#modal-editwali" id="editwali">
                                        <i class="fas fa-user-tie"></i> Wali
                                    </button>
                                    <form action="<?= base_url() ?>datasantri/printout" target="_blank" method="post" class="d-inline-block">
                                        <input type="hidden" name="idSantri" value="<?= $data->id_santri ?>">
                                        <input type="hidden" name="tipe" value="1">
                                        <button type="submit" title="Print Out Salinan Data" class="btn btn-app bg-default">
                                            <i class="fas fa-address-book"></i> Salinan
                                        </button>
                                    </form>

                                    <form action="<?= base_url() ?>datasantri/printout" target="_blank" method="post" class="d-inline-block">
                                        <input type="hidden" name="idSantri" value="<?= $data->id_santri ?>">
                                        <input type="hidden" name="tipe" value="2">
                                        <button type="submit" title="Print Out KTS" class="btn btn-app bg-default">
                                            <i class="fas fa-id-card"></i> KTS
                                        </button>
                                    </form>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3 col-md-3">
            <div class="card mb-0">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        <img src="<?= $fotoj ?>" alt="IMAGE OF <?= $data->nama_santri ?>" style="width: 130px; border-radius: 3px;">
                    </div>
                    <p class="text-success text-center">Status : <?= $kataStatus[$status] ?></p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b><?= $data->domisili_santri ?></b>
                            <a class="float-right"><?= $data->nomor_kamar_santri ?></a>
                        </li>
                        <li class="list-group-item">
                            <b><?= $data->tingkat_diniyah ?></b>
                            <a class="float-right"><?= $data->kelas_diniyah ?></a>
                        </li>
                        <li class="list-group-item">
                            <b><?= $data->tingkat_formal ?></b>
                            <a class="float-right"><?= $data->kelas_formal ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Umur</b>
                            <a class="float-right"><?= $data->umur ?> Tahun</a>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-6">
                            <form action="<?= base_url() ?>datasantri/printout" target="_blank" method="post" class="d-inline-block" style="width: 100%;">
                                <input type="hidden" name="idSantri" value="<?= $data->id_santri ?>">
                                <input type="hidden" name="tipe" value="3">
                                <button <?= ($jabatanUser == 47) ? 'disabled' : '' ?> type="submit" title="Print Out Ketrangan" class="btn btn-primary btn-sm btn-block">
                                    Keterangan
                                </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger btn-sm btn-block" data-dismiss="modal">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="card">
            <div class="card-body">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Data tak ditemukan.</h3>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger btn-sm btn-block" data-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    <?php
    }
    ?>
</div>