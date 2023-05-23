<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Keuangan Bulan <?= $bulan ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", "Bitstream Vera Sans", "Liberation Sans", Verdana, "Verdana Ref", sans-serif;
            font-size: 11pt;
        }


        .text-center {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid;

        }

        th {
            padding: 5px 0px;
        }

        td {
            padding: 4px 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }

        .no-border-right {
            border-right: 0px;
        }

        .no-border-left {
            border-left: 0px;
        }

        h5 {
            margin: 4px;
        }

        h6 {
            margin: 4px 0px 8px 0px;
        }

        .mb-5 {
            margin-bottom: 20px;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .d-flex {
            display: flex;
            align-items: flex-end;
        }
    </style>
</head>

<body>
    <div>
        <?php
        $jenis = [1 => 'PUTRA', 'PUTRI'];
        ?>
        <section>
            <h5 class="text-center">
                REKAPITULASI KEUANGAN BAGIAN <?= $jenis[$this->session->userdata('tipe_user')] ?> <br>
                BULAN <?= strtoupper($bulan) ?>
            </h5>
        </section>
        <section class="mb-5">
            <h6>A. I'DADIYAH</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderIdad = 1;
                    if ($idad[0] != 0) {
                        foreach ($idad[0] as $idadRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderIdad++ ?></td>
                                <td><?= $idadRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($idadRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($idad[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section class="mb-5">
            <h6>B. IBTIDAIYAH</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderIbt = 1;
                    if ($ibt[0] != 0) {
                        foreach ($ibt[0] as $ibtRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderIbt++ ?></td>
                                <td><?= $ibtRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($ibtRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($ibt[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section class="mb-5">
            <h6>C. TSANAWIYAH</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderts = 1;
                    if ($ts[0] != 0) {
                        foreach ($ts[0] as $tsRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderts++ ?></td>
                                <td><?= $tsRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($tsRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($ts[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <div class="page-break"></div>
        <section class="mb-5">
            <h6>D. ALIYAH</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderal = 1;
                    if ($al[0] != 0) {
                        foreach ($al[0] as $alRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderal++ ?></td>
                                <td><?= $alRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($alRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($al[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section class="mb-5">
            <h6>E. UMUM</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderumum = 1;
                    if ($umum[0] != 0) {
                        foreach ($umum[0] as $umumRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderumum++ ?></td>
                                <td><?= $umumRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($umumRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($umum[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section class="mb-5">
            <h6>F. KABID MA'HADIYAH</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ordersatu = 1;
                    if ($satu[0] != 0) {
                        foreach ($satu[0] as $satuRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $ordersatu++ ?></td>
                                <td><?= $satuRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($satuRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($satu[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section class="mb-5">
            <h6>G. KABID SARPRAS</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderempat = 1;
                    if ($empat[0] != 0) {
                        foreach ($empat[0] as $empatRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderempat++ ?></td>
                                <td><?= $empatRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($empatRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($empat[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section class="mb-5">
            <h6>H. KABID DAKWAH & KEMASYARAKATAN</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>URAIAN</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderlima = 1;
                    if ($lima[0] != 0) {
                        foreach ($lima[0] as $limaRow) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderlima++ ?></td>
                                <td><?= $limaRow['kode'] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($limaRow['nominal'], 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($lima[1], 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <div class="page-break"></div>
        <section class="mb-5">
            <h6>I. KESIMPULAN</h6>
            <table border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>INSTANSI</th>
                        <th colspan="2">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $teksKes = [
                        'I\'dadiyah' => 'I\'dadiyah',
                        'Ibtidaiyah' => 'Ibtidaiyah',
                        'Tsanawiyah' => 'Tsanawiyah',
                        'Aliyah' => 'Aliyah',
                        'Umum' => 'Umum',
                        'Kabid I' => 'Kabid Ma\'hadiyah',
                        'Kabid IV' => 'Kabid Sarpras',
                        'Kabid V' => 'Kabid Dakwah & Kemasyarakatan'
                    ];
                    if ($kes) {
                        $orderkes = 1;
                        foreach ($kes as $k) {
                    ?>
                            <tr>
                                <td class="text-center"><?= $orderkes++ ?></td>
                                <td><?= $teksKes[$k->instansi] ?></td>
                                <td class="no-border-right">Rp</td>
                                <td class="text-right no-border-left">
                                    <?= number_format($k->total, 0, ',', '.') ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold">
                        <td colspan="2" class="text-center">TOTAL</td>
                        <td class="no-border-right">Rp</td>
                        <td class="text-right no-border-left">
                            <?= number_format($tot->total, 0, ',', '.') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <section>
            <?php
            $bendahara = [1 => 'ABD. KHOFI', 'HALIMAH'];
            ?>
            <div class="text-center">
                Kebun baru, <?= $this->baseModel->TampilHijri($this->baseModel->GetHijriSekarang()) ?> <br>
                Bendahara
                <br><br><br><br>
                <b><u><?= $bendahara[$this->session->userdata('tipe_user')] ?></u></b>
            </div>
        </section>
    </div>
</body>

</html>