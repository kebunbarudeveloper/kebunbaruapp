<div class="card" style="height: 70.5vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <form id="formmutasi">
            <input type="hidden" name="kelasfiks" id="kelasfiks" value="">
            <input type="hidden" name="tingkatfiks" id="tingkatfiks" value="">
            <table class="table table-head-fixed table-hover text-nowrap table-sm">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID P2K</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th colspan="2" class="hideKelas">DOMISILI</th>
                        <th colspan="2" class="hideKelas">DINIYAH</th>
                        <th class="text-center">PILIH</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($data) {
                        $no = 1;
                        foreach ($data as $row) {

                    ?>
                            <tr title="Klik untuk memilih" data-id="<?= $row->id_santri; ?>" style="cursor:pointer" class="tomboltambah">
                                <td><?= $no++ ?></td>
                                <td><?= $row->id_santri ?></td>
                                <td><?= $row->nama_santri ?></td>
                                <td><?= $row->desa_santri . ', ' . str_replace(['Kabupaten', 'Kota '], '', $row->kabupaten_santri) ?></td>
                                <td class="hideKelas"><?= $row->domisili_santri ?></td>
                                <td class="hideKelas"><?= $row->nomor_kamar_santri ?></td>
                                <td class="hideKelas"><?= $row->kelas_diniyah ?></td>
                                <td class="hideKelas"><?= $row->tingkat_diniyah ?></td>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="id<?= $row->id_santri ?>" name="id[]" value="<?= $row->id_santri ?>">
                                        <label for="id<?= $row->id_santri ?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo '<tr class="text-center text-danger"><td colspan="13">Tidak ada data untuk ditampilkan</td></tr>';
                    }
                    ?>

                </tbody>
            </table>
        </form>
    </div>
    <div class="card-footer justify-content-between">
        <span>Total : <b><?= $total; ?></b> Orang</span>
        <span class="float-right bidangtotal" style="display: none;">Total Terpilih : <b id="total"></b> Orang</span>

    </div>
    <!-- /.card-body -->
</div>