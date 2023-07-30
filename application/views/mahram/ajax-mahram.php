<div class="card" style="height: 71.8vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover">
            <thead>
                <tr>
                    <th style="width: 5%;">NO</th>
                    <th style="width: 5%;"></th>
                    <th style="width: 20%;">NAMA</th>
                    <th style="width: 15%;">ALAMAT</th>
                    <th style="width: 20%;">NO HP</th>
                    <th style="width: 10%;">FIROQ</th>
                    <th style="width: 15%;">STATUS</th>
                    <th style="width: 10%;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($data) {
                    $no = 1;
                    foreach ($data as $dd) {
                        $fotoc = FCPATH . 'assets/fotowali/';
                        $foto = base_url('assets/fotowali/');
                        $image = $dd->foto . '.jpg';

                        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                            $fotoj = base_url('assets/1.jpg');
                        } else {
                            $fotoj = $foto . $image;
                        }

                        $kab = str_replace('Kabupaten', '', $dd->kab);

                        $status = $dd->status;
                        $print = $dd->print;
                        $pengajuan = $dd->pengajuan;

                        $kataStatus = ['Belum Diaktivasi', 'Aktif', 'Hilang', 'Rusak'];
                        $kataPrint = ['Belum Diprint', 'Sudah Diprint'];
                        $katawakil = ['Wali', 'Wakil Wali'];

                        $statusFiroq = ['', 'Firoq', 'Firoq', 'Non-Firoq'];
                        $kataFiroq = ['', 'Pihak Suami', 'Pihak Istri', ''];
                        // if ($status == 0 || $status == 1 && $dd->pengajuan == 1 || $status == 1 && $dd->pengajuan == 2) {
                        if ($status != 10) {

                ?>
                            <tr class="detaildata">
                                <td class="align-middle"><?= $no++ ?></td>
                                <td title="Klik untuk melihat detail">
                                    <img style="border-radius: 5px;" alt="FOTO <?= $dd->nama ?>" width="40px" class="table-avatar" src="<?= $fotoj ?>">
                                </td>
                                <td class="align-middle">
                                    <b><?= $dd->nama ?></b> <br>
                                    <small class="text-success"> Sebagai : <?= $katawakil[$dd->tipe] ?></small>
                                </td>
                                <td class="align-middle"><?= $dd->desa . '<br>' . $kab ?></td>
                                <td class="align-middle">
                                    <?= $dd->nope ?>
                                    <br>
                                    <small>Kode foto : <?= $dd->foto ?></small> <br>
                                </td>
                                <td class="align-middle">
                                    <small><?= $statusFiroq[$dd->firoq] ?></small> <br>
                                    <small><?= $kataFiroq[$dd->firoq] ?></small>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <?= $kataStatus[$status] ?>
                                    </small>
                                    <br>
                                    <small class="text-info">
                                        <?= $kataPrint[$print] ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <button data-id="<?= $dd->id ?>" onclick="detail(this)" class="btn btn-default" title="Klik untuk melihat detail"><i class="fa fa-list"></i></button>
                                        <?php
                                        if ($tipe == 1 && $print != 1) {
                                        ?>
                                            <a href="<?= base_url() ?>mahram/print/<?= encrypt_url($dd->id) ?>" title="Print Out Kartu" target="_blank" class="btn btn-default"><i class="fas fa-print"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($tipe == 1 && $pengajuan > 0) {
                                        ?>
                                            <button onclick="setaduan(this)" data-id="<?= $dd->id ?>" data-aduan="<?= $pengajuan ?>" data-toggle="modal" data-target="#modal-aduan" title="Pengajuan Duplikasi Kartu" class="btn btn-default"><i class="fa fa-clone"></i></button>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($tipe == 2 && $print == 1) {
                                        ?>
                                            <button onclick="pengajuan(this)" data-id="<?= $dd->id ?>" title="Ajukan Print Ulang" class="btn btn-default <?= ($pengajuan > 0) ? 'd-none' : '' ?>"><i class="fas fa-window-restore"></i></button>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($tipe == 2) {
                                        ?>
                                            <button onclick="editdatamahram(this)" data-id="<?= $dd->id ?>" title="Edit Data" class="btn btn-default"><i class="fas fa-edit"></i></button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                <?php
                        }
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
        <b>Total Santri : <?= $total ?> orang<b>
    </div>
</div>
</div>