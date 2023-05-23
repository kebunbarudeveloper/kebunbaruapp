<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Courier New', Courier, monospace;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 11pt;
            /* color: cyan; */
        }

        .container {
            width: 800px;
            display: relative;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-7 {
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-5 {
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }

        .col-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .logo {
            width: 100%;
            margin-top: 8px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0.1rem;
            margin-bottom: 0.1rem;
            margin-block-start: 0px;
            margin-block-end: 0px;
            font-family: inherit;
            font-weight: bold;
            color: inherit;
        }

        .invoice-title {
            font-size: 3.5rem;
        }

        .text-right {
            text-align: end;
        }

        hr {
            margin-top: 0.6rem;
            margin-bottom: 0.6rem;
            border: 0;
            border-top: 1px solid rgb(0 0 0 / 82%)
        }

        table {
            border-collapse: collapse;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .tablestripped {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .tablebottom {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mt-2 {
            margin-top: 3rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .tablestripped td,
        .tablestripped th {
            vertical-align: top;
            border-top: 1px solid #999797;
        }

        .tablebottom td,
        .tablebottom th {
            vertical-align: top;
            border-top: 1px dashed #999797;
        }

        .table-xl td,
        .table-xl th {
            padding: 0.5rem;
        }

        .table-sm td,
        .table-sm th {
            padding: 0.2rem;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .notes {
            padding-left: 25px;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <?php
    if ($data) {
        $id = $data->santri;
        $tahap = $data->tahap;
        if ($tahap == 2) {
            //GET INVOICE PERTAMA
            $secondpayment = $this->pm->getsecond($id);
            $firstnominal = $secondpayment->nominal;
            $total = $secondpayment->sisa;
        } else {
            $firstnominal = 0;
            $total = $data->tagihan;
        }
        $pembayaran = ['', 'Pertama', 'Kedua'];
    ?>
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <img class="logo" src="<?= base_url() ?>assets/images/logo-slip.png" alt="">
                </div>
                <div class="col-7 text-right">
                    <h1 class="invoice-title">KUITANSI</h1>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-7">
                    <table class="table">
                        <tr>
                            <td>ID P2K</td>
                            <td><?= $data->id_santri ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><b><?= $data->nama_santri ?></b></td>
                        </tr>
                        <tr>
                            <td>Domisili</td>
                            <td><?= $data->status_domisili_santri ?>, <?= str_replace('Khusus', '', $data->domisili_santri) ?> - <?= $data->nomor_kamar_santri ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>
                                <?= $data->kelas_diniyah ?> - <?= $data->tingkat_diniyah ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $data->desa_santri ?>, <?= str_replace(['Kabupaten', 'Kota'], '', $data->kabupaten_santri) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-5">
                    <table class="table">
                        <tr>
                            <td>Nomor</td>
                            <td><?= $data->id ?></td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td><?= $pembayaran[$data->tahap] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td><?= TampilHijri($data->hijriah) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="tablestripped table-xl">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KETERANGAN</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-bold">
                                <td class="text-center">1</td>
                                <td>Biaya Pendidikan Satu Tahun</td>
                                <td class="text-center">Rp. <?= number_format($data->tagihan, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <b>Terbilang :</b>
                                    <i>
                                        <?= ucwords(terbilang($data->tagihan)) ?> Rupiah
                                    </i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-7">
                    <table class="tablebottom table-sm">
                        <tbody>
                            <tr>
                                <td style="border-top: 0px">Tarif Awal</td>
                                <td style="border-top: 0px">Rp. </td>
                                <td style="border-top: 0px" class="text-right"><?= number_format($data->tarif, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Pengurangan</td>
                                <td>Rp. </td>
                                <td class="text-right"><?= number_format($data->diskon, 0, ',', '.') ?></td>
                            </tr>
                            <?php
                            if ($data->diskon_id > 0) {
                                $getdiskon = $this->pm->getdatadiskon($data->diskon_id);
                                if ($getdiskon) {
                                    foreach ($getdiskon as $dd) {
                                        $katadiskon = ['Mutasi Jenjang/Domisili', 'Saudara Sejenis', 'Saudara Lain Jenis', 'Biaya Seragam'];
                            ?>
                                        <tr>
                                            <td style="border-top: 0px; padding-left: 15px;">- <?= $katadiskon[$dd->status] ?> </td>
                                            <td style="border-top: 0px;">Rp. </td>
                                            <td style="border-top: 0px;" class="text-right"><?= number_format($dd->total, 0, ',', '.') ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <?php
                            if ($data->tahap == 2) {
                            ?>
                                <tr>
                                    <td>Pembayaran I</td>
                                    <td>Rp. </td>
                                    <td class="text-right"><?= number_format($firstnominal, 0, ',', '.') ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b>Rp. </b></td>
                                <td class="text-right"><b><?= number_format($total, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Nominal Bayar</td>
                                <td>Rp. </td>
                                <td class="text-right"><?= number_format($data->nominal, 0, ',', '.') ?></b></td>
                            </tr>
                            <tr>
                                <td>Jumlah Sisa</td>
                                <td>Rp. </td>
                                <td class="text-right"><?= number_format($data->sisa, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>STATUS</b></td>
                                <td> <b><?= $data->status ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-5">
                    <div class="text-center">
                        Kebun Baru, <?= TampilHijri($data->hijriah) ?> H <br>
                        Bendahara I <br>
                        <p style="margin-top: 60px;">
                            <u><b><?= $data->user ?></b></u>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div>
                        <b>Catatan :</b>
                        Kuitansi ini adalah bukti pembayaran yang SAH.
                        Mohon simpan dengan baik.
                    </div>
                </div>
            </div>

            <div class="row mt-2 mb-2">
                <div class="col-12 text-center">
                    <span style="font-style: italic; font-size: 8pt; color: #080000">
                        -----------------------------------------------------Potong di sini-----------------------------------------------------
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                    <img class="logo" src="<?= base_url() ?>assets/images/logo-slip.png" alt="">
                </div>
                <div class="col-7 text-right">
                    <h1 class="invoice-title">KUITANSI</h1>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-7">
                    <table class="table">
                        <tr>
                            <td>ID P2K</td>
                            <td><?= $data->id_santri ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><b><?= $data->nama_santri ?></b></td>
                        </tr>
                        <tr>
                            <td>Domisili</td>
                            <td><?= $data->status_domisili_santri ?>, <?= str_replace('Khusus', '', $data->domisili_santri) ?> - <?= $data->nomor_kamar_santri ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>
                                <?= $data->kelas_diniyah ?> - <?= $data->tingkat_diniyah ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $data->desa_santri ?>, <?= str_replace(['Kabupaten', 'Kota'], '', $data->kabupaten_santri) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-5">
                    <table class="table">
                        <tr>
                            <td>Nomor</td>
                            <td><?= $data->id ?></td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td><?= $pembayaran[$data->tahap] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td><?= TampilHijri($data->hijriah) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="tablestripped table-xl">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KETERANGAN</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-bold">
                                <td class="text-center">1</td>
                                <td>Biaya Pendidikan Satu Tahun</td>
                                <td class="text-center">Rp. <?= number_format($data->tagihan, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <b>Terbilang :</b>
                                    <i>
                                        <?= ucwords(terbilang($data->tagihan)) ?> Rupiah
                                    </i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-7">
                    <table class="tablebottom table-sm">
                        <tbody>
                            <tr>
                                <td style="border-top: 0px">Tarif Awal</td>
                                <td style="border-top: 0px">Rp. </td>
                                <td style="border-top: 0px" class="text-right"><?= number_format($data->tarif, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Pengurangan</td>
                                <td>Rp. </td>
                                <td class="text-right"><?= number_format($data->diskon, 0, ',', '.') ?></td>
                            </tr>
                            <?php
                            if ($data->diskon_id > 0) {
                                $getdiskon = $this->pm->getdatadiskon($data->diskon_id);
                                if ($getdiskon) {
                                    foreach ($getdiskon as $dd) {
                                        $katadiskon = ['Mutasi Jenjang/Domisili', 'Saudara Sejenis', 'Saudara Lain Jenis', 'Biaya Seragam'];
                            ?>
                                        <tr>
                                            <td style="border-top: 0px; padding-left: 15px;">- <?= $katadiskon[$dd->status] ?> </td>
                                            <td style="border-top: 0px;">Rp. </td>
                                            <td style="border-top: 0px;" class="text-right"><?= number_format($dd->total, 0, ',', '.') ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <?php
                            if ($data->tahap == 2) {
                            ?>
                                <tr>
                                    <td>Pembayaran I</td>
                                    <td>Rp. </td>
                                    <td class="text-right"><?= number_format($firstnominal, 0, ',', '.') ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b>Rp. </b></td>
                                <td class="text-right"><b><?= number_format($total, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Nominal Bayar</td>
                                <td>Rp. </td>
                                <td class="text-right"><?= number_format($data->nominal, 0, ',', '.') ?></b></td>
                            </tr>
                            <tr>
                                <td>Jumlah Sisa</td>
                                <td>Rp. </td>
                                <td class="text-right"><?= number_format($data->sisa, 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>STATUS</b></td>
                                <td> <b><?= $data->status ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-5">
                    <div class="text-center">
                        Kebun Baru, <?= TampilHijri($data->hijriah) ?> H <br>
                        Bendahara I <br>
                        <p style="margin-top: 60px;">
                            <u><b><?= $data->user ?></b></u>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div>
                        <b>Catatan :</b>
                        Kuitansi ini adalah bukti pembayaran yang SAH.
                        Mohon simpan dengan baik.
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        window.print()
        setTimeout(function() {
            window.close()
        }, 2000);
    </script>
</body>

</html>