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
            font-size: 12pt;
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
    </style>
</head>

<body>
    <?php
    $alasan = $data->alasan;
    $tipe = $data->tipe;
    $madrasah = $data->tingkat_diniyah;
    $sekolah = $data->tingkat_formal;
    if ($tipe == 1) {
        $ketua = 'LUTHFI MASYHURI';
        $kesehatan = 'SUDI YADI, M.Pd.';
        $keamanan = 'MOH. MOHLAS';
    } else {
        $ketua = 'RISKIYAH, S.Pd.I';
        $kesehatan = 'AISIYAH';
        $keamanan = 'MUSLIMAH';
    }
    ?>

    <div class="row">
        <img class="header" src="<?= base_url() ?>assets/images/header.png" alt="">
        <div class="divjudul">
            <h3 class="judul"> <u>SURAT IZIN PULANG</u></h3>
            <h4 class="noreg" style="font-weight: normal; font-style: italic">Nomor : <?= $data->registrasi ?></h4>
        </div>
        <div class="divisi">
            <p>Diberikan kepada :</p>
            <table border="0" width="100%" style="margin-left: 50px">
                <tr style="font-weight: bold">
                    <td style="height: 30px">Nama</td>
                    <td>:</td>
                    <td><?= $data->nama_santri ?></td>
                </tr>
                <tr>
                    <td style="height: 30px">ID P2K</td>
                    <td>:</td>
                    <td><?= $data->id_santri ?></td>
                </tr>
                <tr>
                    <td style="height: 30px">Nomor Induk</td>
                    <td>:</td>
                    <td><?= $data->induk_santri ?></td>
                </tr>
                <tr>
                    <td style="height: 30px">Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $data->tempat_lahir_santri . ', ' . $this->baseModel->TampilMasehi($data->tanggal_lahir_santri) ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; height: 30px">Alamat</td>
                    <td style="vertical-align: top;">:</td>
                    <td><?= $data->desa_santri . ' ' . $data->kecamatan_santri . ' ' . str_replace(['Kabupaten', 'Kota '], '', $data->kabupaten_santri) . ' ' . $data->provinsi_santri . ', ' . $data->kode_pos_santri; ?>
                    </td>
                </tr>
                <tr>
                    <td style="height: 30px">Pendidikan Diniyah</td>
                    <td>:</td>
                    <td><?= $data->kelas_diniyah . ', ' . $data->tingkat_diniyah ?></td>
                </tr>
                <tr>
                    <td style="height: 30px">Pendidikan Formal</td>
                    <td>:</td>
                    <td><?= $data->kelas_formal . ', ' . $data->tingkat_formal ?></td>
                </tr>
                <tr style="font-weight: bold; height: 30px">
                    <td><?= ($data->alasan == 'Sakit') ? 'Dikarenakan' : 'Keperluan' ?></td>
                    <td>:</td>
                    <td><?= @$data->alasan ?></td>
                </tr>
                <tr>
                    <td style="height: 30px">Berlaku s.d. tanggal</td>
                    <td>:</td>
                    <td>___________________________________________________ ( ____ hari )</td>
                </tr>
                </tbody>
            </table>
            <p>Demikian, agar dipergunakan sebagaimana mestinya.</p>
            <p>Diberikan di Kebun baru, tanggal ______________________________________________ H.</p>
            <p style="text-align: center; font-style: italic; margin-top: 50px">Diketahui oleh,</p>
            <table width="100%" style="margin-top: 5px;">
                <tbody>
                    <tr>
                        <td colspan="2" style="height: 10px;"></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width: 30%;"> <i><?= ($alasan == 'Sakit') ? 'Kabag. Kesehatan' : 'Kabag. Kamtib' ?></i> </td>
                        <td style="width: 30%;"><i>Kabid. Ma'hadiyah</i></td>
                    </tr>
                    <tr style="height: 80px; text-align: center;">
                        <td style="vertical-align: bottom;">
                            <b><u><?= ($alasan == 'Sakit') ? $kesehatan : $keamanan ?></u></b>
                        </td>
                        <td style="vertical-align: bottom;">
                            <b><u><?= $ketua; ?></u></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 40px;"></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width: 100%;" colspan="3"> <i><?= ($tipe != 1) ? 'a.n. ' : '' ?> Pengasuh</i> </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width: 100%;" colspan="3"> <i>Pondok Pesantren Miftahul Ulum Kebun baru</i> </td>
                    </tr>
                    <tr style="height: 80px; text-align: center;">
                        <?php
                        if ($tipe == 1) {
                            $pengasuh = 'KH. MISBAHOL MUNIR ASARI, Lc.';
                        } else {
                            $pengasuh = 'NYAI IMROATUS SOLEHA';
                        }
                        ?>
                        <td colspan="3" style="width: 100%; vertical-align: bottom;"><b><u><?= $pengasuh ?></u></b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div>
                <?= $barcode ?>
            </div>
            <div style="margin-top: 220px">
                <i>No. Reg. <?= $data->id ?></i>
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