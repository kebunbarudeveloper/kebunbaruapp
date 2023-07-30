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
            font-size: 11pt;
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
    $madrasah = $data->tingkat_diniyah;
    $sekolah = $data->tingkat_formal;
    ?>

    <div class="row">
        <img class="header" src="<?= base_url() ?>assets/images/header.png" alt="">
        <div class="divjudul">
            <h3 class="judul"><u>SURAT KETERANGAN</u></h3>
            <p class="noreg"> <i>Nomor : 001/Skt.P2K/IV/1443</i> </p>
        </div>
        <div class="divisi">
            <p>Yang bertandatangan di bawah ini, Kami Pengurus Pondok Pesantren Miftahul Ulum Kebun Baru Kacok Palengaan Pamekasan,
                menerangkan dengan sebenarnya bahwa :</p>
            <table border="0" width="100%" style="padding-left: 40px;">
                <thead>
                    <tr>
                        <th style="width: 30%;">Nama</th>
                        <th style="width: 5%;">:</th>
                        <th style="width: 65%;"><?= $data->nama_santri ?></th>
                    </tr>
                </thead>
                <tbody>
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
                        <td><?= $data->desa_santri . ' ' . $data->kecamatan_santri . ' ' . str_replace(['Kabupaten', 'Kota '], '', $data->kabupaten_santri) . ' ' . $data->provinsi_santri . ', ' . $data->kode_pos_santri; ?>
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
            <p>
                Yang bersangkutan benar-benar santri aktif dan sudah tercatat dalam <i>Database</i> Pondok Pesantren Miftahul Ulum Kebun baru.
            </p>
            <p>Demikian surat keterangan ini dibuat sebagai pengganti KTS dan dapat dipergunakan sebagaimana mestinya.</p>
            <p>Surat keterangan ini berlaku selama 15 hari sejak diterbitkan.</p>
            <div>
                <div>
                    Kebun baru, 20 Jumadal Ula 1443 H
                </div>
                <div>
                    Sekretaris I
                    <br>PP. Miftahul Ulum Kebun Baru
                </div>

                <div class="sekum">
                    <b><u>MUHAMMAD SUPANDI</u></b>
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