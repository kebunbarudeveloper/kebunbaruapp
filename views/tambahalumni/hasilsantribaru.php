<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <input type="hidden" id="urldataprovinsi" value="<?= base_url() ?>santribaru/GetProvinsi">
    <input type="hidden" id="urldatakab" value="<?= base_url() ?>santribaru/GetKab">
    <input type="hidden" id="urldatakec" value="<?= base_url() ?>santribaru/GetKec">
    <input type="hidden" id="urldatadesa" value="<?= base_url() ?>santribaru/GetDesa">
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <?php
        if ($dataentri) {
        ?>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fa fa-users"></i> Hasil Entri Terbaru</h5>
                        </div>
                        <div class="card-body pt-1">


                            <div class="row">
                                <div class="col-6">
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="padding:8px; width: 35%; border-bottom: 1px solid #ddd;">
                                                    ID | Induk Santri</th>
                                                <th style="padding:8px; width: 5%; border-bottom: 1px solid #ddd;">:
                                                </th>
                                                <th style="padding:8px; width: 60%; border-bottom: 1px solid #ddd;">
                                                    <?= $dataentri->id_santri . ' | ' . $dataentri->induk_santri; ?>
                                                </th>
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
                                    <table style="width: 100%;">
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
                                        <a class="btn btn-app" data-toggle="modal" data-target="#modal-editsantri">
                                            <i class="fas fa-edit"></i> Santri
                                        </a>
                                        <a class="btn btn-app" data-toggle="modal" data-target="#modal-editwali">
                                            <i class="fas fa-edit"></i> Wali
                                        </a>
                                        <a class="btn btn-app bg-warning" href="<?= base_url() ?>santribaru">
                                            <i class="fas fa-plus-circle"></i> Entri
                                        </a>
                                        <a class="btn btn-app bg-primary"
                                            href="<?= base_url() ?>santribaru/print/<?= encrypt_url($dataentri->id_santri) ?>"
                                            target="_blank">
                                            <i class="fas fa-print"></i> Print Out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        <?php
        } else {
        ?>
        <div class="error-page" style="margin-top: 100px;">

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Data tidak ditemukan
                </h3>

                <p>Terdapat kesalahan saat memuat data
                    <br>
                    <br>
                    <a href="<?= base_url() ?>santribaru">Kembali ke Entri Santri Baru</a>
                </p>

            </div>
        </div>
        <?php
        }
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>

<div class="flashdata" data-flashdata="<?= $this->session->flashdata('suksesedit'); ?>"></div>



<?php if ($dataentri) : ?>
<!-- Modal edit data santri -->
<div class="modal fade" id="modal-editsantri" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Santri</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <form action="<?= base_url() ?>santribaru/editdatasantri" method="POST" autocomplete="off"
                    id="formeditsantri">
                    <input type="hidden" value="<?= $dataentri->id_santri; ?>" id="id_santri" name="id_santri">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="niksantri" class="col-sm-4 col-form-label">No.
                                    (KTP/NIK)/KK</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatasantri" id="niksantri"
                                        name="niksantri" autofocus data-inputmask="'mask' : '9999999999999999'"
                                        data-mask="" tabindex="1" value="<?= $dataentri->nik_santri; ?>">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatasantri" id="kksantri"
                                        name="kksantri" autofocus data-inputmask="'mask' : '9999999999999999'"
                                        data-mask="" tabindex="2" value="<?= $dataentri->kk_santri; ?>">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="tempatlahirsantri" class="col-sm-4 col-form-label">Tempat
                                    Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="tempatlahirsantri"
                                        name="tempatlahirsantri" tabindex="4"
                                        value="<?= $dataentri->tempat_lahir_santri; ?>">
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">

                            <div class="form-group row">
                                <label for="namasantri" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="namasantri"
                                        name="namasantri" tabindex="3" value="<?= $dataentri->nama_santri; ?>">
                                </div>
                            </div>
                            <?php
                                $pecahtgl = explode('-', $dataentri->tanggal_lahir_santri);
                                ?>
                            <div class="form-group row">
                                <label for="tanggallahirsantri" class="col-sm-4 col-form-label">Tanggal
                                    Lahir</label>
                                <div class="col-sm-2">
                                    <select name="tanggallahirsantri" id="tanggallahirsantri"
                                        class="form-control inputdatasantri" tabindex="5">
                                        <option value="">..::..</option>
                                        <?php
                                            $le = 1;
                                            for ($i = 1; $i <= 31; $i++) {
                                            ?>
                                        <option value="<?= sprintf('%02d', $i); ?>"
                                            <?= ($pecahtgl[2] == sprintf('%02d', $le++)) ? 'selected' : ''; ?>>
                                            <?= sprintf('%02d', $i); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select name="bulanlahirsantri" id="bulanlahirsantri"
                                        class="form-control inputdatasantri" tabindex="6">
                                        <option value="">..::..</option>
                                        <?php
                                            $bulan = [
                                                1 =>
                                                'Januari',
                                                'Februari',
                                                'Maret',
                                                'April',
                                                'Mei',
                                                'Juni',
                                                'Juli',
                                                'Agustus',
                                                'September',
                                                'Oktober',
                                                'November',
                                                'Desember'
                                            ];
                                            $ke = 1;
                                            for ($p = 1; $p <= 12; $p++) {
                                            ?>
                                        <option value="<?= sprintf('%02d', $p); ?>"
                                            <?= ($pecahtgl[1] == sprintf('%02d', $ke++)) ? 'selected' : ''; ?>>
                                            <?= $bulan[$p]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select name="tahunlahirsantri" id="tahunlahirsantri"
                                        class="form-control inputdatasantri" tabindex="7">
                                        <option value="">..::..</option>
                                        <?php
                                            $sekarang = date('Y');
                                            for ($b = 1985; $b <= $sekarang; $b++) {
                                            ?>
                                        <option value="<?= $b; ?>" <?= ($pecahtgl[0] == $b) ? 'selected' : ''; ?>>
                                            <?= $b; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr class="mt-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="provinsisantri" class="col-sm-4 col-form-label">Provinsi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="provinsisantri"
                                        name="provinsisantri" tabindex="8" value="<?= $dataentri->provinsi_santri ?>">
                                </div>
                            </div>
                            <input type="hidden" id="idProvinsiSantri" value="">
                            <input type="hidden" id="idKabSantri" value="">
                            <input type="hidden" id="idKecSantri" value="">
                            <div class="form-group row">
                                <label for="kecamatansantri" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kecamatansantri"
                                        name="kecamatansantri" tabindex="10"
                                        value="<?= $dataentri->kecamatan_santri ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dusunsantri" class="col-sm-4 col-form-label">Dusun</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="dusunsantri"
                                        name="dusunsantri" tabindex="12" value="<?= $dataentri->dusun_santri ?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="kabupatensantri" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kabupatensantri"
                                        name="kabupatensantri" tabindex="9" value="<?= $dataentri->kabupaten_santri ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desasantri" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="desasantri"
                                        name="desasantri" tabindex="11" value="<?= $dataentri->desa_santri ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtsantri" class="col-sm-4 col-form-label">RT/RW/Kode
                                    Pos</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rtsantri"
                                        data-inputmask="'mask' : '999'" data-mask="" name="rtsantri" tabindex="13"
                                        value="<?= $dataentri->rt_santri ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rwsantri"
                                        data-inputmask="'mask' : '999'" data-mask="" name="rwsantri" tabindex="14"
                                        value="<?= $dataentri->rw_santri ?>">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatasantri" id="kodepossantri"
                                        name="kodepossantri" value="<?= $dataentri->kode_pos_santri; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr class="mt-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="pendidikansantri" class="col-sm-4 col-form-label">Pendidikan
                                    Akhir</label>
                                <div class="col-sm-8">
                                    <select name="pendidikansantri" id="pendidikansantri"
                                        class="form-control inputdatasantri" tabindex="15">
                                        <option value="">..::Pilih::..</option>
                                        <option value="Tidak Tamat SD/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Tidak Tamat SD/Sederajat') ? 'selected' : ''; ?>>
                                            Tidak Tamat SD/Sederajat
                                        </option>
                                        <option value="Tamat SD/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Tamat SD/Sederajat') ? 'selected' : '' ?>>
                                            Tamat SD/Sederajat</option>
                                        <option value="Tamat SMP/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Tamat SMP/Sederajat') ? 'selected' : '' ?>>
                                            Tamat SMP/Sederajat</option>
                                        <option value="Tamat SMA/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Tamat SMA/Sederajat') ? 'selected' : '' ?>>
                                            Tamat SMA/Sederajat</option>
                                        <option value="Sarjana/Diploma"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Sarjana/Diploma') ? 'selected' : '' ?>>
                                            Sarjana/Diploma</option>
                                        <option value="Pasca Sarjana"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Pasca Sarjana') ? 'selected' : '' ?>>
                                            Pasca
                                            Sarjana</option>
                                        <option value="Pondok Pesantren"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Pondok Pesantren') ? 'selected' : '' ?>>
                                            Pondok
                                            Pesantren</option>
                                        <option value="Lainnya"
                                            <?= ($dataentri->pendidikan_akhir_santri == 'Lainnya') ? 'selected' : '' ?>>
                                            Lainnya
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="statusdomisilisantri" class="col-sm-4 col-form-label">Rencana
                                    Domisili</label>
                                <div class="col-sm-8 pt-2">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="rencanadomisili" id="radioPrimary1" value="P2K"
                                            tabindex="16"
                                            <?= ($dataentri->status_domisili_santri == 'P2K') ? 'checked' : '';; ?>>
                                        <label for="radioPrimary1" style="font-weight: 500;">P2K (Asrama)</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-4">
                                        <input type="radio" name="rencanadomisili" id="radioPrimary2" value="LP2K"
                                            <?= ($dataentri->status_domisili_santri == 'LP2K') ? 'checked' : ''; ?>>
                                        <label for="radioPrimary2" style="font-weight: 500;">LP2K (Non-Asrama)</label>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kelasdiniyahsantri" class="col-sm-4 col-form-label">Rencana
                                    Diniyah</label>
                                <div class="col-sm-3">
                                    <select name="kelasdiniyahsantri" id="kelasdiniyahsantri"
                                        class="form-control inputdatasantri" tabindex="19">
                                        <option value="">..::..</option>
                                        <option value="0" <?= ($dataentri->kelas_diniyah == 0) ? 'selected' : ''; ?>>0
                                        </option>
                                        <option value="Jilid"
                                            <?= ($dataentri->kelas_diniyah == 'Jilid') ? 'selected' : ''; ?>>Jilid
                                        </option>
                                        <option value="Takhossus"
                                            <?= ($dataentri->kelas_diniyah == 'Takhossus') ? 'selected' : ''; ?>>
                                            Takhossus
                                        </option>
                                        <?php
                                            $kaa = 1;
                                            for ($ke = 1; $ke <= 6; $ke++) {
                                            ?>
                                        <option value="<?= $ke; ?>"
                                            <?= ($dataentri->kelas_diniyah == $kaa++) ? 'selected' : ''; ?>>
                                            <?= $ke; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <select name="tingkatdiniyahsantri" id="tingkatdiniyahsantri"
                                        class="form-control inputdatasantri" tabindex="20">
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                            if ($datapendidikanDiniyah) {
                                                foreach ($datapendidikanDiniyah as $dpd) {


                                            ?>
                                        <option value="<?= $dpd->nama_datapendidikan ?>"
                                            <?= ($dataentri->tingkat_diniyah == $dpd->nama_datapendidikan) ? 'selected' : '' ?>>
                                            <?= $dpd->nama_datapendidikan ?></option>
                                        <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ayahsantri" class="col-sm-4 col-form-label">Nama
                                    Ayah</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="ayahsantri"
                                        name="ayahsantri" tabindex="23" value="<?= $dataentri->ayah_santri; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomorkamarsantri" class="col-sm-4 col-form-label">Rencana
                                    Kamar</label>
                                <div class="col-sm-2">
                                    <select name="nomorkamarsantri" id="nomorkamarsantri"
                                        <?= ($dataentri->status_domisili_santri == 'LP2K') ? 'disabled' : '' ?>
                                        class="form-control inputdatasantri" tabindex="17">
                                        <option value="">..::..</option>
                                        <?php
                                            $kkk = 1;
                                            for ($k = 1; $k <= 10; $k++) {
                                            ?>
                                        <option value="<?= $k; ?>"
                                            <?= ($dataentri->nomor_kamar_santri == $kkk++) ? 'selected' : ''; ?>>
                                            <?= $k; ?>
                                        </option>

                                        <?php
                                            }
                                            ?>
                                    </select>

                                </div>
                                <div class="col-sm-6">
                                    <select name="daerahsantri" id="daerahsantri" class="form-control inputdatasantri"
                                        tabindex="18"
                                        <?= ($dataentri->status_domisili_santri == 'LP2K') ? 'disabled' : '' ?>>
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                            if ($datakamar) {
                                                foreach ($datakamar as $datakamar) {
                                            ?>
                                        <option value="<?= $datakamar->nama_kamar; ?>"
                                            <?= ($dataentri->domisili_santri == $datakamar->nama_kamar) ? 'selected' : ''; ?>>
                                            <?= $datakamar->nama_kamar; ?></option>
                                        <?php
                                                }
                                            }
                                            ?>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kelasformalsantri" class="col-sm-4 col-form-label">Rencana
                                    Formal</label>
                                <div class="col-sm-2">
                                    <select name="kelasformalsantri" id="kelasformalsantri"
                                        class="form-control inputdatasantri" tabindex="21">
                                        <option value="">..::..</option>
                                        <?php
                                            $llll = 1;
                                            for ($ke = 1; $ke <= 6; $ke++) {
                                            ?>
                                        <option value="<?= $ke; ?>"
                                            <?= ($dataentri->kelas_formal == $llll++) ? 'selected' : ''; ?>>
                                            <?= $ke; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="tingkatformalsantri" id="tingkatformalsantri"
                                        class="form-control inputdatasantri" tabindex="22">
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                            if ($datapendidikanFormal) {
                                                foreach ($datapendidikanFormal as $dpf) {
                                            ?>
                                        <option value="<?= $dpf->nama_datapendidikan ?>"
                                            <?= ($dataentri->tingkat_formal == $dpf->nama_datapendidikan) ? 'selected' : '' ?>>
                                            <?= $dpf->nama_datapendidikan ?></option>
                                        <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ibusantri" class="col-sm-4 col-form-label">Nama Ibu</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="ibusantri"
                                        name="ibusantri" tabindex="24" value="<?= $dataentri->ibu_santri ?>">
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="tombolsimpaneditsantri">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- Modal edit wali santri -->
<div class="modal fade" id="modal-editwali" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Wali Santri</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <form id="formeditwali" action="<?= base_url() ?>santribaru/EditDataWali" method="post"
                    autocomplete="off">
                    <input type="hidden" value="<?= $dataentri->id_santri; ?>" id="idsantri" name="idsantri">
                    <input type="hidden" name="idwali" id="idwali" value="<?= $dataentri->id_walisantri ?>">
                    <input type="hidden" name="nikwaliedit" id="nikwaliedit" value="<?= $dataentri->nik_walisantri ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nikwali" class="col-sm-4 col-form-label">Nomor KTP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="nikwali" name="nikwali"
                                        autofocus data-inputmask="'mask' : '9999999999999999'" data-mask=""
                                        tabindex="25" value="<?= $dataentri->nik_walisantri ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="namawali" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="namawali"
                                        name="namawali" tabindex="26" value="<?= $dataentri->nama_walisantri ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomorhpwali" class="col-sm-4 col-form-label">Nomor
                                    HP</label>
                                <div class="col-sm-8">
                                    <input type="text" data-inputmask="'mask' : '9999-9999-9999'" data-mask=""
                                        class="form-control inputdatasantri" id="nomorhpwali" name="nomorhpwali"
                                        tabindex="27" value="<?= $dataentri->nomor_hp_walisantri ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr class="mt-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" id="idProWali" value="">
                            <input type="hidden" id="idKabWali" value="">
                            <input type="hidden" id="idKecWali" value="">
                            <div class="form-group row">
                                <label for="provinsiwali" class="col-sm-4 col-form-label">Provinsi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="provinsiwali"
                                        name="provinsiwali" tabindex="28"
                                        value="<?= $dataentri->provinsi_walisantri ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kecamatanwali" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kecamatanwali"
                                        name="kecamatanwali" tabindex="30"
                                        value="<?= $dataentri->kecamatan_walisantri ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dusunwali" class="col-sm-4 col-form-label">Dusun</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="dusunwali"
                                        name="dusunwali" tabindex="32" value="<?= $dataentri->dusun_walisantri ?>">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="kabupatenwali" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kabupatenwali"
                                        name="kabupatenwali" tabindex="29"
                                        value="<?= $dataentri->kabupaten_walisantri ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desawali" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="desawali"
                                        name="desawali" tabindex="31" value="<?= $dataentri->desa_walisantri ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtwali" class="col-sm-4 col-form-label">RT/RW/Kode
                                    Pos</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rtwali"
                                        data-inputmask="'mask' : '999'" data-mask="" name="rtwali" tabindex="33"
                                        value="<?= $dataentri->rt_walisantri ?>">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rwwali"
                                        data-inputmask="'mask' : '999'" data-mask="" name="rwwali" tabindex="34"
                                        value="<?= $dataentri->rw_walisantri ?>">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" readonly class="form-control inputdatasantri" id="kodeposwali"
                                        name="kodeposwali" value="<?= $dataentri->kode_pos_walisantri ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr class="mt-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="pendidikanwali" class="col-sm-4 col-form-label">Pend.
                                    Akhir</label>
                                <div class="col-sm-8">
                                    <select name="pendidikanwali" id="pendidikanwali"
                                        class="form-control inputdatasantri" tabindex="35">
                                        <option value="">..::..</option>
                                        <option value="Tidak Tamat SD/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Tidak Tamat SD/Sederajat') ? 'selected' : ''; ?>>
                                            Tidak Tamat
                                            SD/Sederajat
                                        </option>
                                        <option value="Tamat SD/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Tamat SD/Sederajat') ? 'selected' : ''; ?>>
                                            Tamat
                                            SD/Sederajat</option>
                                        <option value="Tamat SMP/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Tamat SMP/Sederajat') ? 'selected' : ''; ?>>
                                            Tamat
                                            SMP/Sederajat</option>
                                        <option value="Tamat SMA/Sederajat"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Tamat SMA/Sederajat') ? 'selected' : ''; ?>>
                                            Tamat
                                            SMA/Sederajat</option>
                                        <option value="Sarjana/Diploma"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Sarjana/Diploma') ? 'selected' : ''; ?>>
                                            Sarjana/Diploma</option>
                                        <option value="Pasca Sarjana"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Pasca Sarjana') ? 'selected' : ''; ?>>
                                            Pasca
                                            Sarjana</option>
                                        <option value="Pondok Pesantren"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Pondok Pesantren') ? 'selected' : ''; ?>>
                                            Pondok
                                            Pesantren</option>
                                        <option value="Lainnya"
                                            <?= ($dataentri->pendidikan_akhir_walisantri == 'Lainnya') ? 'selected' : ''; ?>>
                                            Lainnya
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="pekerjaanwali" class="col-sm-4 col-form-label">Pekerjaan</label>
                                <div class="col-sm-8">
                                    <select name="pekerjaanwali" id="pekerjaanwali" class="form-control inputdatasantri"
                                        tabindex="36">
                                        <option value="">..::..</option>
                                        <option value="BELUM/TIDAK BEKERJA"
                                            <?= ($dataentri->pekerjaan_walisantri == 'BELUM/TIDAK BEKERJA') ? 'selected' : ''; ?>>
                                            BELUM/TIDAK BEKERJA</option>
                                        <option value="USTADZ/MUBALIGH"
                                            <?= ($dataentri->pekerjaan_walisantri == 'USTADZ/MUBALIGH') ? 'selected' : ''; ?>>
                                            USTADZ/MUBALIGH</option>
                                        <option value="WIRASWASTA"
                                            <?= ($dataentri->pekerjaan_walisantri == 'WIRASWASTA') ? 'selected' : ''; ?>>
                                            WIRASWASTA
                                        </option>
                                        <option value="NELAYAN/PERIKANAN"
                                            <?= ($dataentri->pekerjaan_walisantri == 'NELAYAN/PERIKANAN') ? 'selected' : ''; ?>>
                                            NELAYAN/PERIKANAN</option>
                                        <option value="PETANI/PEKEBUN"
                                            <?= ($dataentri->pekerjaan_walisantri == 'PETANI/PEKEBUN') ? 'selected' : ''; ?>>
                                            PETANI/PEKEBUN</option>
                                        <option value="PELAJAR/MAHASISWA"
                                            <?= ($dataentri->pekerjaan_walisantri == 'PELAJAR/MAHASISWA') ? 'selected' : ''; ?>>
                                            PELAJAR/MAHASISWA</option>
                                        <option value="KARYAWAN SWASTA"
                                            <?= ($dataentri->pekerjaan_walisantri == 'KARYAWAN SWASTA') ? 'selected' : ''; ?>>
                                            KARYAWAN
                                            SWASTA</option>
                                        <option value="KARYAWAN HONORER"
                                            <?= ($dataentri->pekerjaan_walisantri == 'KARYAWAN HONORER') ? 'selected' : ''; ?>>
                                            KARYAWAN
                                            HONORER</option>
                                        <option value="LAINNYA"
                                            <?= ($dataentri->pekerjaan_walisantri == 'LAINNYA') ? 'selected' : ''; ?>>
                                            LAINNYA
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="hubunganwali" class="col-sm-4 col-form-label">Hub.
                                    Perwalian</label>
                                <div class="col-sm-8">
                                    <select name="hubunganwali" id="hubunganwali" class="form-control inputdatasantri"
                                        tabindex="37">
                                        <option value="">..::..</option>
                                        <option value="Orang Tua Kandung"
                                            <?= ($dataentri->hubungan_walisantri == 'Orang Tua Kandung') ? 'selected' : ''; ?>>
                                            Orang Tua
                                            Kandung</option>
                                        <option value="Kakek/Nenek"
                                            <?= ($dataentri->hubungan_walisantri == 'Kakek/Nenek') ? 'selected' : ''; ?>>
                                            Kakek/Nenek
                                        </option>
                                        <option value="Paman/Bibi"
                                            <?= ($dataentri->hubungan_walisantri == 'Paman/Bibi') ? 'selected' : ''; ?>>
                                            Paman/Bibi
                                        </option>
                                        <option value="Saudara Kandung"
                                            <?= ($dataentri->hubungan_walisantri == 'Saudara Kandung') ? 'selected' : ''; ?>>
                                            Saudara
                                            Kandung</option>
                                        <option value="Orang Tua Tiri"
                                            <?= ($dataentri->hubungan_walisantri == 'Orang Tua Tiri') ? 'selected' : ''; ?>>
                                            Orang Tua
                                            Tiri</option>
                                        <option value="Lainnya"
                                            <?= ($dataentri->hubungan_walisantri == 'Lainnya') ? 'selected' : ''; ?>>
                                            Lainnya
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="tombolsimpateditwali" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php endif; ?>