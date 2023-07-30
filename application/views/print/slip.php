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
        }

        .row {
            /* margin-left: auto;
        margin-right: auto; */
            width: 800px;
            /* background-color: aqua; */
        }

        .header {
            padding-bottom: 13px;
            border-bottom: 1px solid black;
        }

        .logo {
            display: inline-block;
            /* margin-left: auto;
        margin-right: auto; */
            width: 40%;
        }

        .slip {
            position: absolute;
            font-size: 30px;
            color: #848586b8;
            margin-left: 300px;
            margin-top: 120px;
            width: 50%;
            transform: rotate(331deg)
        }

        .barcode {
            display: inline;
        }

        .divjudul {
            padding-bottom: 10px;
            border-bottom: 1px solid black;
        }

        .judul {
            text-align: center;
            margin-bottom: 0em;
            margin-top: 1em;
            font-weight: bold;
            background-color: black;
            color: white;
            padding: 0px 10px 0px 10px
        }

        .noreg {
            text-align: center;
            margin-top: 0em;
        }

        .divisi {
            border-bottom: 1px solid black;
        }

        th {
            text-align: center;
        }

        .tebal {
            font-weight: bold;
        }

        .kiri {
            text-align: left;
        }

        .kanan {
            text-align: right;
            padding-right: 40px;
        }

        .potong {
            text-align: center;
            font-style: italic;
            font-weight: normal;
            font-size: 8px;
        }

        .tengah {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    $tipe = $this->session->userdata('tipe_user');
    $bendahara = [1 => 'ABD. KHOFI', 'HALIMAH'];

    $biaya = $data->tarif_jadi;
    $bayar = $totalKe[1]->total;
    $persen = ($bayar / $biaya) * 100;
    $sisa = $biaya - $bayar;
    $bayarnya = $data->nominal_pemasukan;

    $statusp = $data->status_pengurangan;
    $kataStatus = [1 => 'Potongan Lain Jenis', 'Potongan Sama Jenis'];

    ?>

    <div class="row">
        <div>
            <div class="header">
                <img class="logo" src="<?= base_url() ?>assets/images/logo-slip.png" alt="">
                <div class="barcode"><?= $barcode ?></div>
            </div>

            <div class="divjudul">
                <div>
                    <h2 class="judul" style="float: left">SLIP PEMBAYARAN</h2>
                    <h2 class="judul" style="float: right">NO. INVOICE : <?= $data->id_pemasukan ?></h2>
                </div>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 8%;">ID P2K</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 12%;"><?= $data->id_santri ?></td>
                        <td style="width: 7%;">NAMA</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 40%; text-align: left"><?= $data->nama_santri ?></td>
                        <td style="width: 7%;">KELAS</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 20%;"><?= $data->kelas_diniyah . ', ' . $data->tingkat_diniyah ?></td>
                    </tr>
                </table>
            </div>
            <div class="divisi">
                <img class="slip" src="<?= base_url() ?>assets/images/1.png" alt="">
                <table style="width: 100%;">
                    <tr>
                        <th style="width: 10%; border-bottom: 1px dashed black;">NO</th>
                        <th style="width: 60%; border-bottom: 1px dashed black;" class="kiri">URAIAN</th>
                        <th style="width: 30%; border-bottom: 1px dashed black;" class="kanan">JUMLAH</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($detail as $key => $dd) {
                    ?>
                        <tr>
                            <td style="text-align: center; border-bottom: 1px dashed black"><?= $no++ ?></td>
                            <td class="kiri" style="border-bottom: 1px dashed black"><?= $dd->nama_akunkeuangan ?></td>
                            <td class="kanan" style="border-bottom: 1px dashed black">
                                <?= number_format($dd->nominal_detail, 0, ',', '.') ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td class="tengah" colspan="2">
                            <b>BIAYA TAHUNAN YANG WAJIB DIBAYAR : Rp.
                                <?= number_format($data->tarif_pemasukan, 0, ',', '.') ?></b>
                        </td>
                        <td class="kanan"> <b>TOTAL :<?= number_format($bayarnya, 0, ',', '.') ?></b> </td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 10px;">
                <?php
                if ($statusp == 0) {
                ?>
                    <table style="width: 100%;">
                        <tr>
                            <td class="kiri" style="width: 30%;">Pembayaran Ke-<?= $totalKe[0] ?></td>
                            <td class="kiri" style="width: 5%;">:</td>
                            <td class="kiri" style="width: 25%;">
                                <?= number_format($bayar, 0, ',', '.') . ' | ' . number_format($persen, 1, ',', '.') ?>%
                            </td>
                            <td class="kiri" style="width: 40%;">Kebun Baru, <?= TampilHijri($data->tanggal_pemasukan) ?> H
                            </td>
                        </tr>
                        <tr>
                            <td class="kiri">Jumlah Sisa Pembayaran</td>
                            <td class="kiri">:</td>
                            <td class="kiri"><?= number_format($sisa, 0, ',', '.') ?></td>
                            <td class="kiri">Bendahara I</td>
                        </tr>
                        <tr style="height: 20px;">
                            <td class="kiri"></td>
                            <td class="kiri"></td>
                            <td class="kiri"></td>
                            <td class="kiri"></td>
                        </tr>
                        <tr>
                            <td class="kiri" style="color: red; text-align: center" colspan="3">
                                <i>Simpan slip ini dengan baik!</i>
                            </td>
                            <td class="kiri"> <b><u><?= $bendahara[$tipe] ?></u></b> </td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <table style="width: 100%;">
                        <tr>
                            <td class="kiri" style="width: 30%;">Status Potongan</td>
                            <td class="kiri" style="width: 5%;">:</td>
                            <td class="kiri" style="width: 25%;"> <?= $kataStatus[$statusp] ?></td>
                            <td class="kiri" style="width: 40%;">Kebun Baru, <?= TampilHijri($data->tanggal_pemasukan) ?> H
                            </td>
                        </tr>
                        <tr>
                            <td class="kiri">Nominal Potongan</td>
                            <td class="kiri">:</td>
                            <td class="kiri">
                                <?= number_format($data->nominal_pengurangan, 0, ',', '.') ?>
                            </td>
                            <td class="kiri">Bendahara I</td>
                        </tr>
                        <tr>
                            <td class="kiri">Jumlah Biaya Tahunan</td>
                            <td class="kiri">:</td>
                            <td class="kiri"><?= number_format($data->tarif_jadi, 0, ',', '.') ?></td>
                            <td class="kiri"></td>
                        </tr>
                        <tr>
                            <td class="kiri">Pembayaran Ke-<?= $totalKe[0] ?></td>
                            <td class="kiri">:</td>
                            <td class="kiri">
                                <?= number_format($bayar, 0, ',', '.') . ' | ' . number_format($persen, 1, ',', '.') ?>%
                            </td>
                            <td class="kiri"><b><u><?= $bendahara[$tipe] ?></u></b></td>
                        </tr>
                        <tr>
                            <td class="kiri">Jumlah Sisa Pembayaran</td>
                            <td class="kiri">:</td>
                            <td class="kiri"><?= number_format($sisa, 0, ',', '.') ?></td>
                            <td class="kiri"><i>Simpan slip ini dengan
                                    baik!</i></td>
                        </tr>
                    </table>
                <?php } ?>

            </div>
        </div>


        <div style="margin: 30px 0px 10px 0px">
            <table style="width: 100%;">
                <tr>
                    <th class="potong">--------------------------------------------------------------</th>
                    <th class="potong">Potong di sini</th>
                    <th class="potong">--------------------------------------------------------------</th>
                </tr>
            </table>
        </div>



        <div>
            <div class="header">
                <img class="logo" src="<?= base_url() ?>assets/images/logo-slip.png" alt="">
                <div class="barcode"><?= $barcode ?></div>
            </div>

            <div class="divjudul">
                <div>
                    <h2 class="judul" style="float: left">SLIP PEMBAYARAN</h2>
                    <h2 class="judul" style="float: right">NO. INVOICE : <?= $data->id_pemasukan ?></h2>
                </div>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 8%;">ID P2K</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 12%;"><?= $data->id_santri ?></td>
                        <td style="width: 7%;">NAMA</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 40%; text-align: left"><?= $data->nama_santri ?></td>
                        <td style="width: 7%;">KELAS</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 20%;"><?= $data->kelas_diniyah . ', ' . $data->tingkat_diniyah ?></td>
                    </tr>
                </table>
            </div>
            <div class="divisi">
                <img class="slip" src="<?= base_url() ?>assets/images/2.png" alt="">
                <table style="width: 100%;">
                    <tr>
                        <th style="width: 10%; border-bottom: 1px dashed black;">NO</th>
                        <th style="width: 60%; border-bottom: 1px dashed black;" class="kiri">URAIAN</th>
                        <th style="width: 30%; border-bottom: 1px dashed black;" class="kanan">JUMLAH</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($detail as $key => $dd) {
                    ?>
                        <tr>
                            <td style="text-align: center; border-bottom: 1px dashed black"><?= $no++ ?></td>
                            <td class="kiri" style="border-bottom: 1px dashed black"><?= $dd->nama_akunkeuangan ?></td>
                            <td class="kanan" style="border-bottom: 1px dashed black">
                                <?= number_format($dd->nominal_detail, 0, ',', '.') ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td class="tengah" colspan="2">
                            <b>BIAYA TAHUNAN YANG WAJIB DIBAYAR : Rp.
                                <?= number_format($data->tarif_pemasukan, 0, ',', '.') ?></b>
                        </td>
                        <td class="kanan"> <b>TOTAL :<?= number_format($bayarnya, 0, ',', '.') ?></b> </td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 10px;">
                <?php
                if ($statusp == 0) {
                ?>
                    <table style="width: 100%;">
                        <tr>
                            <td class="kiri" style="width: 30%;">Pembayaran Ke-<?= $totalKe[0] ?></td>
                            <td class="kiri" style="width: 5%;">:</td>
                            <td class="kiri" style="width: 25%;">
                                <?= number_format($bayar, 0, ',', '.') . ' | ' . number_format($persen, 1, ',', '.') ?>%
                            </td>
                            <td class="kiri" style="width: 40%;">Kebun Baru, <?= TampilHijri($data->tanggal_pemasukan) ?> H
                            </td>
                        </tr>
                        <tr>
                            <td class="kiri">Jumlah Sisa Pembayaran</td>
                            <td class="kiri">:</td>
                            <td class="kiri"><?= number_format($sisa, 0, ',', '.') ?></td>
                            <td class="kiri">Bendahara I</td>
                        </tr>
                        <tr style="height: 20px;">
                            <td class="kiri"></td>
                            <td class="kiri"></td>
                            <td class="kiri"></td>
                            <td class="kiri"></td>
                        </tr>
                        <tr>
                            <td class="kiri" style="color: red; text-align: center" colspan="3">
                                <i>Simpan slip ini dengan baik!</i>
                            </td>
                            <td class="kiri"> <b><u><?= $bendahara[$tipe] ?></u></b> </td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <table style="width: 100%;">
                        <tr>
                            <td class="kiri" style="width: 30%;">Status Potongan</td>
                            <td class="kiri" style="width: 5%;">:</td>
                            <td class="kiri" style="width: 25%;"> <?= $kataStatus[$statusp] ?></td>
                            <td class="kiri" style="width: 40%;">Kebun Baru, <?= TampilHijri($data->tanggal_pemasukan) ?> H
                            </td>
                        </tr>
                        <tr>
                            <td class="kiri">Nominal Potongan</td>
                            <td class="kiri">:</td>
                            <td class="kiri">
                                <?= number_format($data->nominal_pengurangan, 0, ',', '.') ?>
                            </td>
                            <td class="kiri">Bendahara I</td>
                        </tr>
                        <tr>
                            <td class="kiri">Jumlah Biaya Tahunan</td>
                            <td class="kiri">:</td>
                            <td class="kiri"><?= number_format($data->tarif_jadi, 0, ',', '.') ?></td>
                            <td class="kiri"></td>
                        </tr>
                        <tr>
                            <td class="kiri">Pembayaran Ke-<?= $totalKe[0] ?></td>
                            <td class="kiri">:</td>
                            <td class="kiri">
                                <?= number_format($bayar, 0, ',', '.') . ' | ' . number_format($persen, 1, ',', '.') ?>%
                            </td>
                            <td class="kiri"><b><u><?= $bendahara[$tipe] ?></u></b></td>
                        </tr>
                        <tr>
                            <td class="kiri">Jumlah Sisa Pembayaran</td>
                            <td class="kiri">:</td>
                            <td class="kiri"><?= number_format($sisa, 0, ',', '.') ?></td>
                            <td class="kiri"><i>Simpan slip ini dengan
                                    baik!</i></td>
                        </tr>
                    </table>
                <?php } ?>

            </div>
        </div>
    </div>

    <script>
        window.print()
        setTimeout(function() {
            window.close()
        }, 2000);
    </script>
</body>





</html>