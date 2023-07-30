<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Cek Nomor Registrasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form autocomplete="off" method="POST" action="<?= base_url() ?>verifikasi/proses"
                            id="formverifikasi">
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <label for="id">Nomor Registrasi</label>
                                    <input type="text" class="form-control" id="id" autofocus
                                        data-inputmask="'mask' : '99999999'" data-mask="" name="id">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" class="btn btn-primary float-right"
                                    id="tombolverifikasi">Proses</button>
                            </div>
                        </form>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Perhatian!!</strong> Sebelum memulai, silahkan baca pentunjuk <span class="text-dark"><a
                                href="<?= base_url() ?>petunjuk">di sini</a></span>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="col-8">
                    <?php
					$error = $this->session->flashdata('error');
					//$error = $this->session->flashdata('sukses');
					if ($error) {
					?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal!!</strong> <?= $error ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
					}
					?>

                    <?php
					$sukses = $this->session->flashdata('sukses');
					if ($sukses) {
						$datahasil = $this->vm->cekNomorRegistrasi($sukses);
					?>

                    <div class="card card">
                        <div class="card-header">
                            <h3 class="card-title">Hasil Pengecekan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary text-center">Biodata Calon Santri</h6>
                                    <table style="width: 100%;">
                                        <tr>
                                            <th>Nama</th>
                                            <th>:</th>
                                            <th><?= $datahasil->nama ?></th>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td><?= $datahasil->nik ?></td>
                                        </tr>
                                        <tr>
                                            <td>KK</td>
                                            <td>:</td>
                                            <td><?= $datahasil->kk ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tetala</td>
                                            <td>:</td>
                                            <td><?= $datahasil->tempat . ', ' . $datahasil->tanggal ?></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="5" style="vertical-align: baseline;">Alamat</td>
                                            <td>:</td>
                                            <td><?= $datahasil->dusun . ', RT ' . $datahasil->rt . '/RW ' . $datahasil->rw  ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->desa ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->kecamatan ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->kabupaten ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->provinsi . ', ' . $datahasil->pos ?></td>
                                        </tr>
                                        <tr>
                                            <td>Domisili</td>
                                            <td>:</td>
                                            <td><?= $datahasil->domisili . ', ' . $datahasil->daerah . ' - ' . $datahasil->nomor ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Diniyah</td>
                                            <td>:</td>
                                            <td><?= $datahasil->kelasd . ', ' . $datahasil->diniyah ?></td>
                                        </tr>
                                        <tr>
                                            <td>Formal</td>
                                            <td>:</td>
                                            <td><?= $datahasil->kelasf . ', ' . $datahasil->formal ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ayah</td>
                                            <td>:</td>
                                            <td><?= $datahasil->ayah ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ibu</td>
                                            <td>:</td>
                                            <td><?= $datahasil->ibu ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-primary text-center">Biodata Calon Wali Santri</h6>
                                    <table style="width: 100%;">
                                        <tr>
                                            <th>Nama</th>
                                            <th>:</th>
                                            <th><?= $datahasil->namaw ?></th>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td><?= $datahasil->nikw ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td>:</td>
                                            <td><?= $datahasil->hp ?></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="5" style="vertical-align: baseline;">Alamat</td>
                                            <td>:</td>
                                            <td><?= $datahasil->dusunw . ', RT ' . $datahasil->rtw . '/RW ' . $datahasil->rww  ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->desaw ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->kecamatanw ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->kabupatenw ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?= $datahasil->provinsiw . ', ' . $datahasil->posw ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan</td>
                                            <td>:</td>
                                            <td><?= $datahasil->pendidikanw ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>:</td>
                                            <td><?= $datahasil->pekerjaan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hubungan</td>
                                            <td>:</td>
                                            <td><?= $datahasil->hubungan ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-sm btn-primary float-right" target="_blank" href="<?= base_url() ?>santribaru/print/<?= encrypt_url($datahasil->status) ?>">Print Out</a>
                        </div>
                    </div>

                    <?php
					}
					?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->


















































































</div>