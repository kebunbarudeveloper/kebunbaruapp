<?php
if ($datanya[1] == '') {
    $kata = 'semua daerah';
} else {
    $kata = $datanya[1];
}
$status = ['Tidak kembali tanpa ijin', 'Ijin tidak kembali', 'Telat', ''];
?>
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

        .row {
            margin-left: auto;
            margin-right: auto;
            width: 800px;
            /* background-color: aqua; */
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

    <?php if ($datanya[0]) { ?>
        <div class="row">
            <h5>DAFTAR SANTRI INDISIPLINER KEMBALI</h5>
            <h6>DOMISILI : <?= strtoupper($kata) ?></h6>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">NO</th>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 25%;">NAMA</th>
                        <th style="width: 10%;">ALAMAT</th>
                        <th style="width: 15%;" colspan="2">DOMISILI</th>
                        <th style="width: 17%;">STATUS</th>
                        <th style="width: 18%;">KET</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($datanya[0] as $ddd) {
                        $s = $ddd->status;
                        if ($s == 1) {
                            $alasan = $ddd->alasan;
                        } elseif ($s == 2) {
                            $alasan = selisihWaktuprintkembali($ddd->tanggal, $ddd->kembali);
                        } else {
                            $alasan = '';
                        }


                    ?>
                        <tr>
                            <td class="tengah"><?= $no++ ?></td>
                            <td class="tengah"><?= $ddd->id_santri ?></td>
                            <td><?= $ddd->nama_santri ?></td>
                            <td><?= $ddd->desa_santri ?></td>
                            <td class="tengah"><?= $ddd->domisili_santri ?></td>
                            <td class="tengah"><?= $ddd->nomor_kamar_santri ?></td>
                            <td><?= $status[$s] ?></td>
                            <td><?= $alasan ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- <script>
            window.print()
            setTimeout(function() {
                window.close()
            }, 2000);
        </script> -->
    <?php } else {
        echo 'Data tak ditemukan';
    ?>
        <!-- <script>
            window.close()
        </script> -->
    <?php } ?>

</body>

</html>
