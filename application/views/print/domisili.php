<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Corbel', Courier, monospace;
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 12pt;
        }

        .tebal {
            font-weight: bold;
        }

        table {
            width: 100%;
            border: solid 1px black;
        }

        table,
        th,
        td {
            border: solid 1px black;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .tengah {
            text-align: center;
        }

        h5,
        h6 {
            text-align: center;
            margin: 0px;
        }
    </style>
</head>

<body>

    <?php if ($datanya) { ?>
        <div class="row">
            <h5>DATA SANTRI</h5>
            <h6>DOMISILI : <?= strtoupper($judul) ?></h6>
            <h6 style="text-align: left;">
                <span>KETUA KAMAR : USTADZ MISBAHUL MUNIR A.</span>
                <span style="float: right;">NOMOR HP: 0852-3202-0005</span>
            </h6>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 2%;">NO</th>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 20%;">NAMA</th>
                        <th style="width: 20%;">ALAMAT</th>
                        <th style="width: 15%;">TETALA</th>
                        <th style="width: 8%;" colspan="2">DOMISILI</th>
                        <th style="width: 8%;" colspan="2">FORMAL</th>
                        <th style="width: 8%;" colspan="2">DINIYAH</th>
                        <th style="width: 12%;">WALI</th>
                        <!-- <th style="width: 10%;">NO HP</th>
                        <th style="width: 10%;">NO HP BARU</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($datanya as $ddd) {
                    ?>
                        <tr>
                            <td class="tengah"><?= $no++ ?></td>
                            <td class="tengah"><?= $ddd->id_santri ?></td>
                            <td><?= $ddd->nama_santri ?></td>
                            <td><?= $ddd->desa_santri . ' ' . str_replace(['Kabupaten', 'Kota '], '', $ddd->kabupaten_santri) ?></td>
                            <td><?= $ddd->tempat_lahir_santri . '<br>' . tanggalIndoShort($ddd->tanggal_lahir_santri) ?></td>
                            <td class="tengah"><?= $ddd->domisili_santri ?></td>
                            <td class="tengah"><?= $ddd->nomor_kamar_santri ?></td>
                            <td class="tengah"><?= $ddd->tingkat_formal ?></td>
                            <td class="tengah"><?= $ddd->kelas_formal ?></td>
                            <td class="tengah"><?= $ddd->tingkat_diniyah ?></td>
                            <td class="tengah"><?= $ddd->kelas_diniyah ?></td>
                            <td><?= $ddd->nama_walisantri ?></td>
                            <!-- <td class="tengah"><?= $ddd->nomor_hp_walisantri ?></td>
                            <td></td> -->
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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