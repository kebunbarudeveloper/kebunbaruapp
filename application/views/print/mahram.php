<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <title><?= $title ?></title>
    <style type="text/css">
        * {
            font-family: ebrima;
            font-size: 70pt;
        }

        .back {
            width: 870mm;
            height: 548mm;
            background-image: url(<?= base_url('assets/images/mahrom-front.jpg') ?>);
            background-repeat: no-repeat;
            background-size: cover;
        }


        .belakang {
            width: 870mm;
            height: 547.5mm;
            background-image: url(<?= base_url('assets/images/mahrom-behind.jpg') ?>);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .fotoWali {
            width: 100%;
            height: 100%;
            border-radius: 20px;
        }

        .row {
            width: 70%;
            margin: auto;
        }

        .clear {
            width: 100%;
            height: 770px;
            position: relative;
        }

        .col {
            /* background-color: blue; */
            width: 100%;
            height: 700px;
            display: flex;
        }

        .identitas {
            width: 75.5%;
            height: 100%;
            /* background-color: red; */
            text-align: right;
        }

        .foto {
            width: 24%;
        }

        .nama {
            width: 89%;
            font-weight: bold;
            font-size: 110pt;
            /* font-size: 70pt; */
            color: #1A332A;
            padding-top: 30px;
            /* padding-top: 95px; */
        }

        .alamat {
            margin-top: 75px;
            width: 81%;
            color: #1A332A;
        }

        .nomor {
            margin-top: 10px;
            width: 81%;
            color: #1A332A;
        }

        .rowBawah {
            margin: auto;
            width: 85%;
        }

        .rowSatu {
            padding-top: 260px;
        }

        .rowDua {
            padding-top: 180px;
        }

        .rowTiga {
            padding-top: 100px;
        }

        .data {
            background-color: #fdfdfd;
            padding: 30px;
            border-radius: 25px;
            margin-bottom: 70px;
            -webkit-box-shadow: 0 0 5px #1A332A;
            box-shadow: 0 0 5px #1A332A;
            display: flex;
            align-items: center;
        }

        .dataSatu {
            height: 600px;
        }

        .dataDua {
            height: 400px;
        }

        .dataTiga {
            height: 250px;
        }

        .frame {
            height: 100%;
        }

        .fotoSantri {
            height: 100%;
            border-radius: 20px;
        }

        .nomorID {
            color: #1A332A;
            font-size: 50pt;
            font-weight: normal;
        }

        .namaSantri {
            color: #1A332A;
            font-weight: bold;
            padding-left: 70px;
            width: 45%;
        }

        .domisili {
            color: #1A332A;
            width: 35%;
            text-align: center;
        }

        .rowbawah {
            width: 80%;
            margin: 0 auto;
        }

        .barcode {
            float: right;
            width: 33%;
            text-align: center;
            font-size: 40pt;
            color: #1A332A;
        }

        .wrapperbarcode {
            padding: 200px 30px 10px 70px;
        }

        .wrapperbawah {
            float: right;
            width: 33%;
            text-align: center;
            font-size: 35pt;
            color: #1A332A;
            clear: both;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="back">
        <div class="row">
            <div class="clear"></div>
            <div class="col">
                <div class="identitas">
                    <div class="nama">
                        <?= $data->nama ?>
                    </div>
                    <div class="alamat">
                        <?= $data->desa . ', ' . str_replace(['Kabupaten', 'Kota '], '', $data->kab) ?>
                    </div>
                    <div class="nomor">
                        <?= $data->nope ?>
                    </div>
                </div>
                <div class="foto">
                    <img src="<?= base_url() ?>assets/fotowali/<?= $data->foto ?>.jpg" alt="" class="fotoWali">
                </div>
            </div>
        </div>
        <div class="rowbawah">
            <div class="bacrode">
                <div class="wrapperbarcode">
                    <?= $barcode ?>
                </div>
            </div>
            <div class="wrapperbawah">
                <?php
                echo $data->id;
                ?>
            </div>
        </div>
    </div>
    <div class="belakang">
        <?php
        if ($total > 0 && $total <= 3) {
            $row = [1 => 'rowSatu', 'rowDua', 'rowTiga'];
            $data = [1 => 'dataSatu', 'dataDua', 'dataTiga'];
        ?>
            <div class="rowBawah <?= $row[$total] ?>">
                <?php
                if ($santri) {

                    foreach ($santri as $d) {

                        $fotoc = FCPATH . 'assets/fotosantri/';
                        $foto = base_url('assets/fotosantri/');
                        $image = $d->tipe_santri . '/' . $d->id_santri . '.jpg';

                        if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
                            $fotoj = $foto . $d->tipe_santri . '.jpg';
                        } else {
                            $fotoj = $foto . $image;
                        }
                ?>
                        <div class="data <?= $data[$total] ?>">
                            <div class="frame">
                                <img src="<?= $fotoj ?>" alt="" class="fotoSantri">
                            </div>
                            <div class="namaSantri">
                                <?= $d->nama_santri ?>
                                <br>
                                <small class="nomorID"><?= $d->id_santri ?></small>
                            </div>
                            <div class="domisili">
                                <?= str_replace('Khusus', '', $d->domisili_santri) ?> - <?= $d->nomor_kamar_santri ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>
    <script>
        window.print()
        setTimeout(function() {
            window.close()
        }, 2000);
    </script>
</body>

</html>