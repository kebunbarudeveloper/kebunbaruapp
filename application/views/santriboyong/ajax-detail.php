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

        $statuswali = $data->status_wali;
        $kataStatusWali = ['', 'Sebagai Wali', 'Sebagai Wakil Wali'];

        $status = $data->status_angket;
        $katastatus = ['Dalam proses', 'Selesai dan resmi boyong'];

        $kab = str_replace('Kabupaten', '', $data->kabupaten_santri);
    ?>

        <div class="col-12 col-sm-9 col-md-9">
            <div class="card mb-0" style="height: 500px;">
                <div class="card-body">
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
                                <h6 class="mb-0">Detail Angket</h6>
                            </div>
                            <table class="table text-left table-sm">
                                <thead>
                                    <tr>
                                        <th>WALI</th>
                                        <th>:</th>
                                        <th><?= $data->nama_wali ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>STATUS</td>
                                        <td>:</td>
                                        <td>
                                            <span class="badge badge-success">
                                                <?= $kataStatusWali[$statuswali] ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">ALAMAT</td>
                                        <td>:</td>
                                        <td><?= $data->desa_wali ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->kec_wali ?> <?= str_replace('Kabupaten', '', $data->kab_wali) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: 0px;"></td>
                                        <td style="border-top: 0px;"><?= $data->pro_wali ?>, <?= $data->pos_wali ?></td>
                                    </tr>
                                    <tr>
                                        <td>ALASAN</td>
                                        <td>:</td>
                                        <td><?= $data->alasan_boyong ?></td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL ANGKET</td>
                                        <td>:</td>
                                        <td><?= TampilHijri($data->tanggal_angket) ?></td>
                                    </tr>
                                    <tr>
                                        <td>STATUS ANGKET</td>
                                        <td>:</td>
                                        <td>
                                            <span class="badge badge-success">
                                                <?= $katastatus[$status] ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="margin-top: 60px;" class="text-right">
                                <!-- <button <?= ($data->status_angket == 1) ? 'disabled' : '' ?> type="button" title="Hapus Data Boyong" class="btn btn-app bg-danger" onclick="hapus(<?= $data->id_datasantriboyong ?>)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button> -->
                                <button type="button" title="Hapus Data Boyong" class="btn btn-app bg-danger" onclick="hapus(<?= $data->id_datasantriboyong ?>)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                                <form action="<?= base_url() ?>santriboyong/getLinkAngket" target="_blank" method="post" class="d-inline-block">
                                    <input type="hidden" name="iddatasantriboyong" value="<?= $data->id_datasantriboyong ?>">
                                    <button <?= ($data->status_angket == 1) ? 'disabled' : '' ?> type="submit" title="Print Out Angket Boyong" class="btn btn-app bg-default">
                                        <i class="fas fa-file"></i> Angket
                                    </button>
                                </form>
                                <form action="<?= base_url() ?>santriboyong/getLinkResmi" target="_blank" method="post" class="d-inline-block">
                                    <input type="hidden" name="iddatasantriboyong" value="<?= $data->id_datasantriboyong ?>">
                                    <button <?= ($data->status_angket != 1) ? 'disabled' : '' ?> type="submit" title="Print Out Surat Resmi Boyong" class="btn btn-app bg-default">
                                        <i class="fas fa-print"></i> Surat
                                    </button>
                                </form>
                            </div>
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
                    <p class="text-success text-center"></p>
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
                    </ul>
                    <div class="row">
                        <div class="col-6">
                            <button <?= ($data->status_angket == 1) ? 'disabled' : '' ?> onclick="selesaikan(<?= $data->id_datasantriboyong ?>)" class="btn btn-primary btn-sm btn-block">
                                Selesaikan
                            </button>
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
        </div>
    <?php
    }
    ?>
</div>