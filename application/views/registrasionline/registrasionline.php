<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
			$alert = $this->session->flashdata('sukses');
			if ($alert) :
			?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Sipppp!</strong> <?= $alert ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php
			endif;
			?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pendaftar Online</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 73.5vh;">
                            <table class="table table-head-fixed text-nowrap table-sm">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID</th>
                                        <th>NAMA</th>
                                        <th>JENIS</th>
                                        <th>KELAS</th>
                                        <th>AYAH</th>
                                        <th>NO. HP/WA</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$no = 1;
									$jenis = [1 => 'Putra', 'Putri'];
									foreach ($data as $row) {
										$status = $row->status;
									?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->id_santri ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $jenis[$row->jenis] ?></td>
                                        <td><?= $row->kelasd . ', ' . $row->diniyah ?></td>
                                        <td><?= $row->ayah ?></td>
                                        <td><?= $row->hp . '<br>' . $row->wa ?></td>
                                        <td>
                                            <?php
												if ($status == 0) {
												?>
                                                <button class="btn btn-xs btn-danger" disabled="">Invalid</button>
                                                <?php 
                                            }elseif ($status == 1) {
                                                ?>
                                            <a href="<?= base_url() ?>registrasionline/proses/<?= $row->id_santri ?>"
                                                class="btn btn-xs btn-success">Proses</a>
                                            <?php
												} else {
												?>
                                            <button class="btn btn-xs btn-danger" disabled="">Selesai</button>
                                            <?php
												}
												?>
                                        </td>
                                    </tr>
                                    <?php
									}
									?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>
</div>
</div>
<!-- /.content-wrapper -->

































</div>