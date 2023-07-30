<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 477px;">
            <table class="table table-head-fixed text-nowrap table-sm">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>JABATAN</th>
                        <th>DATA MENU</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($datamenu) {
                        $no = 1;
                        foreach ($datamenu as $dmm) {
                            $kategori = $dmm->kategori_jabatan;
                            $jabatan  = $dmm->id_jabatan;

                    ?>
                    <tr>
                        <td rowspan=""><?= $no++ ?></td>
                        <td rowspan=""><?= $dmm->nama_jabatan; ?></td>
                        <td>
                            <?php
                                    $detailmenu = $this->menuModel->getMenuPerjabatan($kategori, $jabatan);
                                    $kata  = ['Non-Aktif', 'Aktif'];
                                    $class = ['danger', 'success'];

                                    $kata1  = ['Aktifkan', 'Non-Aktifkan'];
                                    $datas = [1, 0];

                                    if ($detailmenu) {
                                        foreach ($detailmenu as $ddm) {
                                    ?>
                            <?= $ddm->nama_menu . '<br>'; ?>

                            <?php
                                        }
                                    } else {
                                        echo 'Belum ada menu';
                                    }
                                    ?>


                        </td>
                        <td>
                            <?php
                                    if ($detailmenu) {
                                        foreach ($detailmenu as $ddm2) {
                                    ?>
                            <span
                                class="text-<?= $class[$ddm2->status_menu] ?>"><?= $kata[$ddm2->status_menu]; ?></span><br>

                            <?php
                                        }
                                    } else {
                                        echo '---';
                                    }
                                    ?>
                        </td>
                        <td>
                            <?php
                                    if ($detailmenu) {
                                        foreach ($detailmenu as $ddm3) {
                                    ?>
                            <a href="#" data-id="<?= $ddm3->id_datamenu; ?>"
                                data-kategori="<?= $ddm3->kategori_datamenu; ?>"
                                data-status="<?= $datas[$ddm3->status_menu] ?>"
                                class="tombolubahstatusmenu"><?= $kata1[$ddm3->status_menu]; ?></a><br>

                            <?php
                                        }
                                    } else {
                                        echo '---';
                                    }
                                    ?>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr class="text-center text-danger"><td colspan="5">Tak ada data untuk ditampilkan</td></tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>