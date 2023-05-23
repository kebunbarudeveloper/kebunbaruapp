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
                        <th>INVOICE</th>
                        <th>PEMBAYARAN</th>
                        <th>DETAIL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($datax) {
                        $no = 1;
                        foreach ($datax as $dd) {
                            $fotoc = FCPATH . 'assets/fotosantri/';
                            $foto = base_url('assets/fotosantri/');
                            $image = $dd->tipe_santri . '/' . $dd->id_santri . '.jpg';

                            if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                                $fotoj = $foto . $dd->tipe_santri . '.jpg';
                            } else {
                                $fotoj = $foto . $image;
                            }

                            $kab = str_replace(['Kabupaten', 'Kota '], '', $dd->kabupaten_santri);

                            $status = $dd->status;
                            if ($status == 'LUNAS') {
                                $kata = 'Lunas';
                                $class = 'success';
                            } else {
                                $kata = 'Belum Lunas';
                                $class = 'danger';
                            }

                            $nominal = $dd->nominal;
                            $detail = $this->pm->getpaymentdetail($dd->id);
                            if ($nominal == $detail) {
                                $katalagi = 'Valid';
                                $classlagi = 'success';
                            } else {
                                $katalagi = 'Tidak Valid';
                                $classlagi = 'danger';
                            }

                    ?>
                            <tr style="cursor: pointer;" title="Klik untuk detail" data-toggle="modal" data-target="#modal-detail" onclick="loaddetail(<?= $dd->id ?>)">
                                <td class="align-middle"><?= $no++ ?></td>
                                <td>
                                    <img style="border-radius: 5px;" alt="Foto <?= $dd->nama_santri ?>" width="45px" class="table-avatar" src="<?= $fotoj ?>">
                                </td>
                                <td class="align-middle">
                                    <b><?= $dd->nama_santri ?></b>
                                    <br>
                                    <small> <?= $dd->desa_santri . ', ' . $kab ?></small>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <?= $dd->status_domisili_santri . ', ' . str_replace('Khusus', '', $dd->domisili_santri) . ' - ' . $dd->nomor_kamar_santri ?> <br>
                                        <?= $dd->kelas_diniyah . ' - ' . $dd->tingkat_diniyah ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        Nomor : <?= $dd->id ?> <br>
                                        <?= TampilHijri($dd->hijriah) ?> <br>
                                    </small>

                                </td>
                                <td class="align-middle">
                                    <small>
                                        Nominal : Rp. <?= number_format($nominal, 0, ',', '.') ?> <br>
                                    </small>
                                    <span class="badge badge-<?= $class ?>"><?= $kata ?></span>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        Nominal : Rp. <?= number_format($detail, 0, ',', '.') ?>
                                    </small>
                                    <br>
                                    <span class="badge badge-<?= $classlagi ?>"><?= $katalagi ?></span>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr class="text-center"><td colspan="8"><h6 class="text-danger">Tak ada data untuk ditampilkan</h6></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer justify-content-between">
            <b>Total Santri : <?= @$total ?> orang</b>
            <b class="float-right">Total Pemasukan : Rp. <?= number_format(@$grand->nominal, 0, ',', '.') ?><b>
        </div>
    </div>
</div>