<div class="row">
    <div class="col-6">
        <table border="0" style="width: 100%;">
            <thead>
                <tr>
                    <th style="padding:8px; width: 35%; border-bottom: 1px solid #ddd;">
                        Induk Santri</th>
                    <th style="padding:8px; width: 5%; border-bottom: 1px solid #ddd;">:
                    </th>
                    <th style="padding:8px; width: 60%; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->induk_santri; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">No. KTP/NIK
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->nik_santri; ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">No. KK
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->kk_santri; ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">No. Registrasi
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->no_reg_santri; ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Tahun Masuk |
                        Tanggal
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->tahun_masuk . ' | ' . $this->baseModel->TampilHijri($dataentri->tanggal_masuk); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Nama
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->nama_santri; ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Tempat Tgl.
                        Lahir
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->tempat_lahir_santri . ', ' . $this->baseModel->TampilMasehi($dataentri->tanggal_lahir_santri); ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px 8px 0px 8px;">Alamat</td>
                    <td style="padding:8px 8px 0px 8px;">:</td>
                    <td style="padding:8px 8px 0px 8px;">
                        <?= $dataentri->dusun_santri . ', RT ' . $dataentri->rt_santri . '/RW ' . $dataentri->rw_santri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:8px;"></td>
                    <td style="padding-left:8px;"></td>
                    <td style="padding-left:8px;">
                        <?= $dataentri->desa_santri . ' ' . $dataentri->kecamatan_santri . ', ' . $dataentri->kabupaten_santri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0px 8px 8px 8px; border-bottom: 1px solid #ddd;">
                    </td>
                    <td style="padding:0px 8px 8px 8px; border-bottom: 1px solid #ddd;">
                    </td>
                    <td style="padding:0px 8px 8px 8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->provinsi_santri . ', ' . $dataentri->kode_pos_santri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Pendidikan Akhir
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->pendidikan_akhir_santri; ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Domisili
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->status_domisili_santri . ', ' . $dataentri->domisili_santri . ' | ' . $dataentri->nomor_kamar_santri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Kelas Diniyah
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->kelas_diniyah . ' | ' . $dataentri->tingkat_diniyah; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Kelas Formal
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->kelas_formal . ' | ' . $dataentri->tingkat_formal; ?>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="col-6">
        <table border="0" style="width: 100%;">
            <tbody>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Nama Ayah
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->ayah_santri; ?>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Nama Ibu
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->ibu_santri; ?>
                </tr>
                <tr style="height: 20px;">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Nama Wali
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->nama_walisantri ?>
                </tr>

                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">No. NIK/KTP</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->nik_walisantri ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">No. HP
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->nomor_hp_walisantri ?></td>
                </tr>
                <tr>
                    <td style="padding:8px 8px 0px 8px;">Alamat</td>
                    <td style="padding:8px 8px 0px 8px;">:</td>
                    <td style="padding:8px 8px 0px 8px;">
                        <?= $dataentri->dusun_walisantri . ', RT ' . $dataentri->rt_walisantri . '/RW ' . $dataentri->rw_walisantri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left:8px;"></td>
                    <td style="padding-left:8px;"></td>
                    <td style="padding-left:8px;">
                        <?= $dataentri->desa_walisantri . ' ' . $dataentri->kecamatan_walisantri . ', ' . $dataentri->kabupaten_walisantri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0px 8px 8px 8px; border-bottom: 1px solid #ddd;">
                    </td>
                    <td style="padding:0px 8px 8px 8px; border-bottom: 1px solid #ddd;">
                    </td>
                    <td style="padding:0px 8px 8px 8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->provinsi_walisantri . ', ' . $dataentri->kode_pos_walisantri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Pendidikan Akhir
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->pendidikan_akhir_walisantri ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Pekerjaan
                    </td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->pekerjaan_walisantri ?></td>
                </tr>
                <tr>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">Hubungan
                        Perwalian</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                    <td style="padding:8px; border-bottom: 1px solid #ddd;">
                        <?= $dataentri->hubungan_walisantri ?></td>
                </tr>
            </tbody>
        </table>
        <div class="float-right mt-5">
            <!-- <a class="btn btn-app" data-toggle="modal" data-target="#modal-editsantri">
                <i class="fas fa-edit"></i> Santri
            </a>
            <a class="btn btn-app" data-toggle="modal" data-target="#modal-editwali">
                <i class="fas fa-edit"></i> Wali
            </a> -->
            <a class="btn btn-app bg-warning" href="<?= base_url() ?>santribaru">
                <i class="fas fa-plus-circle"></i> Entri
            </a>
            <a class="btn btn-app bg-primary"
                href="<?= base_url() ?>santribaru/print/<?= encrypt_url($dataentri->id_santri) ?>" target="_blank">
                <i class="fas fa-print"></i> Print Out
            </a>
        </div>
    </div>
</div>