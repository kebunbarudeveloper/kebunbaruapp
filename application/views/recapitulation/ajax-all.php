<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h6 class="font-weight-bold text-center">
                        RINCIAN
                    </h6>
                    <div style="max-height: 55.5vh; overflow-y: auto">
                        <table class="table table-hover table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="4" class="font-weight-bold">UMUM</td>
                                </tr>
                                <?php
                                if ($umum) {
                                    foreach ($umum as $u) {
                                ?>
                                        <tr>
                                            <td style="width: 70%" class="pl-5"><?= $u->nama_akunkeuangan ?></td>
                                            <td style="width: 15%">(<?= $u->qty ?>)</td>
                                            <td style="width: 5%">Rp.</td>
                                            <td style="width: 10%" class="text-right"><?= number_format($u->total, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="pl-5 text-center text-danger" colspan="4">Tidak ada data untuk ditampilkan</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="font-weight-bold">KABID I</td>
                                </tr>
                                <?php
                                if ($pesantren) {
                                    foreach ($pesantren as $p) {
                                ?>
                                        <tr>
                                            <td style="width: 70%" class="pl-5"><?= $p->nama_akunkeuangan ?></td>
                                            <td style="width: 15%">(<?= $p->qty ?>)</td>
                                            <td style="width: 5%">Rp.</td>
                                            <td style="width: 10%" class="text-right"><?= number_format($p->total, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="pl-5 text-center text-danger" colspan="4">Tidak ada data untuk ditampilkan</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="font-weight-bold">KABID IV</td>
                                </tr>
                                <?php
                                if ($pembangunan) {
                                    foreach ($pembangunan as $pp) {
                                ?>
                                        <tr>
                                            <td style="width: 70%" class="pl-5"><?= $pp->nama_akunkeuangan ?></td>
                                            <td style="width: 15%">(<?= $pp->qty ?>)</td>
                                            <td style="width: 5%">Rp.</td>
                                            <td style="width: 10%" class="text-right"><?= number_format($pp->total, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="pl-5 text-center text-danger" colspan="4">Tidak ada data untuk ditampilkan</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="font-weight-bold">KABID V</td>
                                </tr>
                                <?php
                                if ($humas) {
                                    foreach ($humas as $pp) {
                                ?>
                                        <tr>
                                            <td style="width: 70%" class="pl-5"><?= $pp->nama_akunkeuangan ?></td>
                                            <td style="width: 15%">(<?= $pp->qty ?>)</td>
                                            <td style="width: 5%">Rp.</td>
                                            <td style="width: 10%" class="text-right"><?= number_format($pp->total, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="pl-5 text-center text-danger" colspan="4">Tidak ada data untuk ditampilkan</td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="font-weight-bold">MADRASAH</td>
                                </tr>
                                <?php
                                if ($madrasah) {
                                    foreach ($madrasah as $m) {
                                ?>
                                        <tr>
                                            <td style="width: 70%" class="pl-5"><?= $m->nama_akunkeuangan ?></td>
                                            <td style="width: 15%">(<?= $m->qty ?>)</td>
                                            <td style="width: 5%">Rp.</td>
                                            <td style="width: 10%" class="text-right"><?= number_format($m->total, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="pl-5 text-center text-danger" colspan="4">Tidak ada data untuk ditampilkan</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-4">
                    <h6 class="font-weight-bold text-center">
                        KESIMPULAN
                    </h6>
                    <div style="max-height: 55.5vh; overflow-y: auto">
                        <table class="table table-hover table-sm">
                            <tbody>
                                <tr>
                                    <td colspan="2"><b>UMUM</b></td>
                                </tr>
                                <tr>
                                    <td>Total Transaksi </td>
                                    <td><?= $kesimpulanumum->transaksi ?> kali</td>
                                </tr>
                                <tr>
                                    <td>Total Item </td>
                                    <td><?= $kesimpulanumum->item ?></td>
                                </tr>
                                <tr>
                                    <td>Total Pemasukan </td>
                                    <td>Rp. <?= number_format($kesimpulanumum->total, 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>KABID I</b></td>
                                </tr>
                                <tr>
                                    <td>Total Transaksi </td>
                                    <td><?= $kesimpulanpesantren->transaksi ?> kali</td>
                                </tr>
                                <tr>
                                    <td>Total Item </td>
                                    <td><?= $kesimpulanpesantren->item ?></td>
                                </tr>
                                <tr>
                                    <td>Total Pemasukan </td>
                                    <td>Rp. <?= number_format($kesimpulanpesantren->total, 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>KABID IV</b></td>
                                </tr>
                                <tr>
                                    <td>Total Transaksi </td>
                                    <td><?= $kesimpulanpembangunan->transaksi ?> kali</td>
                                </tr>
                                <tr>
                                    <td>Total Item </td>
                                    <td><?= $kesimpulanpembangunan->item ?></td>
                                </tr>
                                <tr>
                                    <td>Total Pemasukan </td>
                                    <td>Rp. <?= number_format($kesimpulanpembangunan->total, 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>KABID V</b></td>
                                </tr>
                                <tr>
                                    <td>Total Transaksi </td>
                                    <td><?= $kesimpulanhumas->transaksi ?> kali</td>
                                </tr>
                                <tr>
                                    <td>Total Item </td>
                                    <td><?= $kesimpulanhumas->item ?></td>
                                </tr>
                                <tr>
                                    <td>Total Pemasukan </td>
                                    <td>Rp. <?= number_format($kesimpulanhumas->total, 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>MADRASAH</b></td>
                                </tr>
                                <tr>
                                    <td>Total Transaksi </td>
                                    <td><?= $kesimpulanmadrasah->transaksi ?> kali</td>
                                </tr>
                                <tr>
                                    <td>Total Item </td>
                                    <td><?= $kesimpulanmadrasah->item ?></td>
                                </tr>
                                <tr>
                                    <td>Total Pemasukan </td>
                                    <td>Rp. <?= number_format($kesimpulanmadrasah->total, 0, ',', '.') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>