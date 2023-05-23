<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <style>
        * {
            font-family: 'Segoe UI';
            /* font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; */
            font-size: 12pt;
        }

        .row {
            width: 19cm;
            padding: 5px;
            display: flex;
            margin-bottom: 12px;
        }

        .card {
            /* background-color: red; */
            width: 100%;
            border: 1px solid black;
            border-radius: 5px;
            padding: 15px;
        }

        .header {
            display: flex;
            border-bottom: 1px dashed black;
            padding-bottom: 10px;
        }

        .kiri {
            width: 55%;
        }

        img {
            width: 250px;
        }

        .kanan {
            width: 45%;
        }

        .footer {
            display: flex;
            margin-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed black;
        }

        .bio {
            width: 50%;
            border-right: 1px solid #4a4a4a;
        }

        h5 {
            margin: 5px 0px 1px 0px;
        }

        ul {
            margin: 0px;
        }

        .warning {
            width: 50%;
        }

        .font-warning {
            font-size: 10pt;
            font-style: italic;
        }

        .address {
            text-align: center;
            padding-top: 5px;
        }

        .address span {
            font-size: 8pt;
        }
    </style>
</head>

<body>


    <?php
    // var_dump($data);
    foreach ($data as $row) {
        $ala = strtolower($row['alamat']);
    ?>
        <div class="row">
            <div class="card">
                <div class="header">
                    <div class="kiri">
                        <img src="<?= base_url() ?>assets/images/milad.png" alt="">
                    </div>
                    <div class="kanan">
                        <?= $row['barcode'] ?>
                    </div>
                </div>
                <div class="footer">
                    <div class="bio">
                        <h5><?= $row['nama'] ?></h5>
                        <small> <i> - <?= ucwords($ala) ?></i></small>
                    </div>
                    <div class="warning">
                        <ul>
                            <li class="font-warning">Harap mengkonfirmasi kehadiran kepada panitia via SMS/WA ke nomor +62 8191 1818 800</li>
                            <li class="font-warning">Kartu ini harap dibawa untuk proses registrasi yang cepat dan praktis</li>
                        </ul>
                    </div>
                </div>
                <div class="address">
                    <span>Pondok Pesantren Miftahul Ulum Kebun baru, Kacok Palengaan Pamekasan Jatim</span>
                </div>
            </div>
        </div>
    <?php
    }
    ?>


    <!-- <script>
        window.print()
        setTimeout(function() {
            window.close()
        }, 2000);
    </script> -->
</body>

</html>