<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Corbel';
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 15pt;
        }

        .row {
            margin-left: auto;
            margin-right: auto;
            width: 800px;
            /* background-color: aqua; */
        }

        .header {
            display: block;
            /* margin-left: auto;
        margin-right: auto; */
            width: 100%;
        }

        .divjudul {
            margin-top: 130px;
        }

        .judul {
            text-align: center;
            margin-bottom: 0em;
            margin-top: 1em;
            font-weight: bold;
        }

        .noreg {
            text-align: center;
            margin-top: 0em;
        }

        .divisi {
            padding-left: 10px;
            margin-top: 20px;
            text-align: left;
        }

        .tebal {
            font-weight: bold;
        }

        .ttd {
            position: absolute;
            width: 150px;
            float: right;
        }

        .sekum {
            margin-top: 80px;
        }
    </style>
</head>

<body>
    <?php
    $periode = $data->periode_boyong;
    $tipe = $data->tipe_santriboyong;
    $madrasah = $data->tingkat_diniyah;
    $sekolah = $data->tingkat_formal;
    ?>

    <div class="row">
        <!-- <img class="header" src="<?= base_url() ?>assets/images/header.png" alt=""> -->
        <div class="divjudul">
            <h3 class="judul"><u>SURAT KETERANGAN BERHENTI (BOYONG)</u></h3>
            <p class="noreg">Nomor : <?= $data->surat_boyong ?></p>
        </div>
        <div class="divisi">
            <p>Yang bertandatangan di bawah ini, Kami Pengurus Pondok Pesantren Miftahul Ulum Kebun Baru Kacok Palengaan Pamekasan,
                menerangkan dengan sebenarnya bahwa :</p>
            <table border="0" width="100%" style="padding-left: 40px;">
                <tbody>
                    <tr>
                        <td style="width: 30%;">Nama</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;"><b> <?= $data->nama_santri ?></b></td>
                    </tr>
                    <tr>
                        <td>ID P2K</td>
                        <td>:</td>
                        <td><?= $data->id_santri ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Induk</td>
                        <td>:</td>
                        <td><?= $data->induk_santri ?></td>
                    </tr>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= $data->tempat_lahir_santri . ', ' . $this->baseModel->TampilMasehi($data->tanggal_lahir_santri) ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Alamat</td>
                        <td style="vertical-align: top;">:</td>
                        <td><?= $data->desa_santri . ' ' . $data->kecamatan_santri . ' ' . str_replace(['Kabupaten', 'Kota '], '', $data->kabupaten_santri) . '<br>' . $data->provinsi_santri . ', ' . $data->kode_pos_santri; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tahun Masuk</td>
                        <td>:</td>
                        <td><?= $data->tahun_masuk . ' | ' . $this->baseModel->TampilHijri($data->tanggal_masuk) ?></td>
                    </tr>
                    <tr>
                        <td>Domisili</td>
                        <td>:</td>
                        <td><?= $data->domisili_santri . ' - ' . $data->nomor_kamar_santri ?></td>
                    </tr>
                    <tr>
                        <td>Pendidikan Diniyah</td>
                        <td>:</td>
                        <td><?= $data->kelas_diniyah . ', ' . $data->tingkat_diniyah ?></td>
                    </tr>
                    <tr>
                        <td>Pendidikan Formal</td>
                        <td>:</td>
                        <td><?= $data->kelas_formal . ', ' . $data->tingkat_formal ?></td>
                    </tr>
                </tbody>
            </table>
            <p>Telah mengajukan permohonan berhenti dari Pondok Pesantren Miftahul Ulum Kebun Baru dengan alasan :
                <br><b><?= $data->alasan_boyong ? $data->alasan_boyong : 'Tanpa Alasan' ?></b>
            </p>
            <p>
                Maka sejak tanggal dalam surat ini ditetapkan, yang bersangkutan tidak lagi tercatat sebagai santri
                Pondok Pesantren Miftahul Ulum Kebun Baru. <br>
                Oleh karena itu segala bentuk tanggung jawab atas diri yang bersangkutan diserahkan kembali kepada
                walinya, dan apapun yang dilakukan oleh yang bersangkutan bukan merupakan tanggung jawab Pondok Pesantren
                Miftahul Ulum Kebun Baru. <br>
                Yang bersangkutan diminta tetap mengamalkan ilmu yang diperoleh di Pondok Pesantren Miftahul Ulum Kebun Baru
                serta menjaga nama baik almamater.
            </p>
            <p>Demikian surat keterangan ini dibuat, harap maklum dan terima kasih.</p>
            <div>
                <div>
                    Kebun baru, <?= TampilHijri($data->tanggal_boyong) ?> H
                </div>
                <div>
                    Sekretaris Umum
                    <br>PP. Miftahul Ulum Kebun Baru
                </div>
                <div class="ttd">
                    <img src="<?= base_url() ?>assets/ttd/sekum.png" width="150px">
                </div>
                <div class="sekum">
                    <b><u>EDY SUSANTO, S.Pd.</u></b>
                </div>
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