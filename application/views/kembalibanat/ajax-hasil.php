<?php
$user = $this->session->userdata('tipe_user');
?>
<div class="card card-success card-outline">
    <div class="card-header">
        <h4 class="card-title">Data Santri</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <img src="<?= base_url() ?>assets/fotosantri/<?= $user . '/' . $hasil->id_santri . '.jpg' ?>" alt="Foto santri" style="width: 100%;">
            </div>
            <div class="col-8">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 30%;">ID P2K</th>
                            <th style="width: 5%;">:</th>
                            <th style="width: 65%;"><?= $hasil->id_santri ?></th>
                        </tr>
                        <tr>
                            <td>Nomor Induk</td>
                            <td>:</td>
                            <td><?= $hasil->induk_santri ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><b><?= $hasil->nama_santri ?></b></td>
                        </tr>
                        <tr>
                            <td>Domisili</td>
                            <td>:</td>
                            <td>P2K, <?= $hasil->domisili_santri ?> - <?= $hasil->nomor_kamar_santri ?></td>
                        </tr>
                        <tr>
                            <td>Pendidikan Diniyah</td>
                            <td>:</td>
                            <td><?= $hasil->kelas_diniyah ?> - <?= $hasil->tingkat_diniyah ?></td>
                        </tr>
                        <tr>
                            <td>Pendidikan Formal</td>
                            <td>:</td>
                            <td><?= $hasil->kelas_formal ?> - <?= $hasil->tingkat_formal ?></td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="align-top">Alamat</td>
                            <td>:</td>
                            <td><?= $hasil->dusun_santri . ', RT ' . $hasil->rt_santri . '/RW ' . $hasil->rw_santri ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?= $hasil->desa_santri ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?= $hasil->kecamatan_santri . ' ' . $hasil->kabupaten_santri ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><?= $hasil->provinsi_santri . ', ' . $hasil->kode_pos_santri ?></td>
                        </tr>
                        <tr>
                            <td>Ayah</td>
                            <td>:</td>
                            <td><b><?= $hasil->ayah_santri ?></b></td>
                        </tr>
                        <tr>
                            <td>Check In</td>
                            <td>:</td>
                            <td>
                                <?php
                                $tanggalDB = strtotime($hasil->kembali);
                                echo tanggalIndo(date('Y-m-d', $tanggalDB)) . ' | ' . date('H:i:s', $tanggalDB);
                                ?>
                                WIB
                            </td>
                        </tr>
                        <tr>
                            <?php
                            $statusx = $hasil->status;
                            if ($statusx == 2) {
                                $classStatus = 'text-danger';
                                $alasan = '';
                                $selisih = '<br>' . $this->kem->selisihWaktu($hasil->kembali);
                            } elseif ($statusx == 1) {
                                $classStatus = 'text-warning';
                                $alasan = '<br>Alasan : ' . $hasil->alasan;
                                $selisih = '';
                            } elseif ($statusx == 3) {
                                $classStatus = 'text-success';
                                $alasan = '';
                                $selisih = '';
                            }

                            $status = ['', 'Ijin Terlambat', 'Terlambat Kembali', 'Disiplin'];
                            ?>
                            <td class="align-top">Status</td>
                            <td class="align-top">:</td>
                            <td>
                                <b class="<?= $classStatus ?>">
                                    <?= $status[$statusx]; ?>
                                </b>
                                <?= $alasan . $selisih ?>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-danger" id="batalSurat" data-id="<?= $hasil->id; ?>">Batalkan</button>
    </div>
</div>