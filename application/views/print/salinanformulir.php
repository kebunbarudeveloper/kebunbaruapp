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
            font-size: 13pt;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
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

    <?php if ($datanya) { ?>
        <div class="row">
            <img class="header" src="<?= base_url() ?>assets/images/header.png" alt="">
            <div class="divjudul">
                <table border="0" style="width: 100%;">
                    <tr>
                        <td style="width: 50%">
                            <h3 class="judul">SALINAN FORMULIR PENDAFTARAN</h3>
                            <h5 class="noreg"><i>No. Registrasi : <?= $datanya->no_reg_santri ?></i></h5>
                        </td style="width: 50%">
                        <td><?= $barcode; ?> </td>
                    </tr>
                </table>

            </div>
            <div class="divisi">
                <table border="0">
                    <thead>
                        <tr>
                            <th style="width: 30%;">NOMOR ID | INDUK</th>
                            <th style="width: 10%; text-align:center">:</th>
                            <th style="width: 60%;"><?= $datanya->id_santri . ' | ' . $datanya->induk_santri ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td style="text-align:center">:</td>
                            <td><?= $this->baseModel->TampilHijri($datanya->tanggal_masuk) ?></td>
                        </tr>
                        <tr>
                            <td>Nomor KK</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->kk_santri ?></td>
                        </tr>
                        <tr>
                            <td>Nomor NIK</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->nik_santri ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td style="text-align:center">:</td>
                            <td class="tebal"><?= $datanya->nama_santri ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td style="text-align:center">:</td>
                            <td>
                                <?php
                                $kataKelamin = [1 => 'Laki-laki', 'Perempuan'];
                                echo $kataKelamin[$datanya->tipe_santri]
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->tempat_lahir_santri . ', ' . $this->baseModel->TampilMasehi($datanya->tanggal_lahir_santri) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->dusun_santri . ', RT ' . $datanya->rt_santri . '/RW ' . $datanya->rt_santri ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?= $datanya->desa_santri . ' ' . $datanya->kecamatan_santri . ' ' . str_replace(['Kabupaten', 'Kota '], '', $datanya->kabupaten_santri) ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?= $datanya->provinsi_santri . ', ' . $datanya->kode_pos_santri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pendidikan Akhir</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->pendidikan_akhir_santri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Status Domisili</td>
                            <td style="text-align:center">:</td>
                            <td>
                                <?php
                                $statusDom = $datanya->status_domisili_santri;
                                echo $statusDom;
                                echo ($statusDom == 'P2K') ? ' (Asrama)' : ' (Non-Asrama)';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Domisili</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->domisili_santri . ' ( ' . $datanya->nomor_kamar_santri . ' )' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Rencana Diniyah</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->kelas_diniyah . ', ' . $datanya->tingkat_diniyah ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Rencana Ammiyah</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->kelas_formal . ', ' . $datanya->tingkat_formal ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->ayah_santri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->ibu_santri ?>
                            </td>
                        </tr>
                        <tr style="height: 15px;">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>NIK Wali</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->nik_walisantri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Wali</td>
                            <td style="text-align:center">:</td>
                            <td class="tebal"><?= $datanya->nama_walisantri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->nomor_hp_walisantri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->dusun_walisantri . ', RT ' . $datanya->rt_walisantri . '/RW ' . $datanya->rt_walisantri ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?= $datanya->desa_walisantri . ' ' . $datanya->kecamatan_walisantri . ' ' . str_replace(['Kabupaten', 'Kota '], '', $datanya->kabupaten_walisantri) ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?= $datanya->provinsi_walisantri . ', ' . $datanya->kode_pos_walisantri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pendidikan Akhir</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->pendidikan_akhir_walisantri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->pekerjaan_walisantri ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Hubungan Perwalian</td>
                            <td style="text-align:center">:</td>
                            <td><?= $datanya->hubungan_wali ?>
                            </td>
                        </tr>
                        <tr style="height: 25px;">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Diterima di Kebun baru</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tanggal : <?= $this->baseModel->TampilHijri($datanya->tanggal_masuk) ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><i>Panitia P2SMB</i></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><i>Ketua</i></td>
                        </tr>
                        <tr style="height: 65px;">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><b><u><?= $datanya->panitia_santri ?></u></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            window.print()
            setTimeout(function() {
                window.close()
            }, 2000);
        </script>
    <?php } else {
        echo 'Data tak ditemukan';
    ?>
        <script>
            window.close()
        </script>
    <?php } ?>

</body>

</html>