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
    $periode = $data->periode_boyong;
    $tipe = $data->tipe_santriboyong;
    $madrasah = $data->tingkat_diniyah;
    $sekolah = $data->tingkat_formal;
    if ($tipe == 1) {
        $ketua = 'LUTHFI MASYHURI';
    } else {
        $ketua = 'RISKIYAH, S.Pd.I';
    }
    ?>

    <div class="row">
        <img class="header" src="<?= base_url() ?>assets/images/header.png" alt="">
        <div class="divjudul">
            <h3 class="judul">ANGKET BERHENTI (BOYONG)</h3>
            <h4 class="noreg">Nomor : <?= $data->nomor_surat ?></h4>
        </div>
        <div class="divisi">
            <p>Yang bertanda tangan di bawah ini :</p>
            <table border="0" width="100%">
                <thead>
                    <tr>
                        <th style="width: 30%;">Nama</th>
                        <th style="width: 5%;">:</th>
                        <th style="width: 65%;"><?= $data->nama_wali ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: top;">Alamat</td>
                        <td style="vertical-align: top;">:</td>
                        <td><?= $data->desa_wali . ' ' . $data->kec_wali . ' ' . str_replace(['Kabupaten', 'Kota '], '', $data->kab_wali) . ' ' . $data->pro_wali . ', ' . $data->pos_wali; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td><?= $data->pekerjaan_wali ?></td>
                    </tr>
                    <tr>
                        <?php
                        $kata = [1 => 'wali', 'wakil wali'];
                        $status = $data->status_wali;
                        ?>
                        <td>Sebagai <?= $kata[$status]; ?> dari</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $data->nama_santri ?></td>
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
                        <td><?= $data->desa_santri . ' ' . $data->kecamatan_santri . ' ' . str_replace(['Kabupaten', 'Kota '], '', $data->kabupaten_santri) . ' ' . $data->provinsi_santri . ', ' . $data->kode_pos_santri; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tahun Masuk</td>
                        <td>:</td>
                        <td><?= $data->tahun_masuk . ' | ' . $this->baseModel->TampilHijri($data->tanggal_masuk) ?></td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td>Alasan Berhenti</td>
                        <td>:</td>
                        <td><?= $data->alasan_boyong ? $data->alasan_boyong : 'Tanpa Alasan' ?></td>
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
            <p>Menyatakan dengan sebenarnya permohonan berhenti dari Pondok Pesantren Miftahul Ulum Kebun baru,
                Kacok Palengaan Kabupaten Pamekasan Jawa Timur</p>
            <table width="100%">
                <tbody>
                    <tr>
                        <td style="width: 30%;"></td>
                        <td style="width: 30%;"></td>
                        <td style="width: 30%;">
                            Kebun baru, <?= $this->baseModel->TampilHijri($data->tanggal_angket) ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><i>Pemohon</i></td>
                    </tr>
                    <tr style="height: 80px;">
                        <td></td>
                        <td></td>
                        <td style="vertical-align: bottom;"><b><?= $data->nama_wali; ?></b></td>
                    </tr>
                </tbody>
            </table>
            <h3 class="judul">PENGURUS PONDOK PESANTREN</h3>
            <h3 class="judul" style="margin-top: 1px;">MIFTAHUL ULUM KEBUN BARU</h3>
            <table width="100%" style="margin-top: 5px;">
                <tbody>
                    <tr>
                        <td colspan="3" style="height: 10px;"></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width: 30%;"> <i>Ketua I</i> </td>
                        <td style="width: 30%;"><i>Ketua II</i></td>
                        <td style="width: 30%;"><i>Ketua Umum</i></td>
                    </tr>
                    <tr style="height: 80px; text-align: center;">
                        <td style="vertical-align: bottom;">
                            <!-- <b><u><?= $this->sbm->getKetua($periode, $tipe, $jabatan = 20); ?></u></b> -->
                            <b><u><?= $ketua; ?></u></b>
                        </td>
                        <td style="vertical-align: bottom;">
                            <!-- <b><u><?= $this->sbm->getKetua($periode, $tipe, $jabatan = 23); ?></u></b> -->
                            <b><u>H. MOH. WADUD, S.Pd.I.</u></b>
                        </td>
                        <td style="vertical-align: bottom;">
                            <!-- <b><u><?= $this->sbm->getKetua($periode, $tipe, $jabatan = 40); ?></u></b> -->
                            <b><u>H. MOH. ALI WAFA, S.Pd.I.</u></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="height: 10px;"></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width: 100%;" colspan="3"> <i>Mengetahui</i> </td>
                    </tr>
                    <tr style="text-align: center;">
                        <?php
                        if ($tipe == 1) {
                            $tpengasuh = 'Pengasuh';
                        } else {
                            $tpengasuh = 'Pengasuh';
                        }
                        ?>
                        <td style="width: 100%;" colspan="3"> <i><?= $tpengasuh ?></i> </td>
                    </tr>
                    <tr style="height: 80px; text-align: center;">
                        <?php
                        if ($tipe == 1) {
                            $pengasuh = 'KH. MISBAHOL MUNIR ASARI, Lc.';
                        } else {
                            $pengasuh = 'KH. MISBAHOL MUNIR ASARI, Lc.';
                        }
                        ?>
                        <td colspan="3" style="width: 100%; vertical-align: bottom;"><b><u><?= $pengasuh ?></u></b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- <script>
        window.print()
        setTimeout(function() {
            window.close()
        }, 2000);
    </script> -->
</body>

</html>