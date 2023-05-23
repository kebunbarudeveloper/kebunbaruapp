<div class="col-12">
    <div class="card" style="height: 71.5vh;">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
            <table class="table table-head-fixed table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th colspan="2" class="text-center">NAMA</th>
                        <th>ADMINISTRASI</th>
                        <th>PEMBAYARAN</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($datas) {
                        $no = 1;
                        $arT = [
                            'I\'dadiyah',
                            'Ibtidaiyah',
                            'Tsanawiyah',
                            'Aliyah'
                        ];
                        foreach ($datas as $dd) {
                            $fotoc = FCPATH . 'assets/fotosantri/';
                            $foto = base_url('assets/fotosantri/');
                            $image = $dd->tipe . '/' . $dd->santri_id . '.jpg';

                            if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                                $fotoj = $foto . $dd->tipe . '.jpg';
                            } else {
                                $fotoj = $foto . $image;
                            }

                            $kab = str_replace(['Kabupaten', 'Kota '], '', $dd->kab);
                    ?>
                            <tr title="Klik untuk detail">
                                <td class="align-middle"><?= $no++ ?></td>
                                <td>
                                    <img style="border-radius: 5px;" alt="Foto <?= $dd->nama ?>" width="45px" class="table-avatar" src="<?= $fotoj ?>">
                                </td>
                                <td class="align-middle">
                                    <b><?= $dd->nama ?></b>
                                    <br>
                                    <small> <?= $dd->desa . ', ' . $kab ?></small>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <?= $dd->status_dom . ', ' . str_replace('Khusus', '', $dd->dom) . ' - ' . $dd->kamar ?> <br>
                                        <?= $dd->kelas . ' - ' . $arT[$dd->tingkat] ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <?php
                                        if ($dd->status != 'BELUM BAYAR') {
                                        ?>
                                            Tagihan : <?= number_format($dd->tagihan, 0, ',', '.') ?> <br>
                                            Nominal : <?= number_format($dd->nominal, 0, ',', '.') ?>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge badge-danger">
                                                TIDAK ADA PEMBAYARAN
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </small>

                                </td>
                                <td class="align-middle">
                                    <small>
                                        Status : <b class="text-success"><?= $dd->status ?></b>
                                    </small>
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