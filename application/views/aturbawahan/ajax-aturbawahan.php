<div class="card" style="height: 71.5vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;">
        <table class="table table-head-fixed text-nowrap table-sm table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA PENGURUS</th>
                    <th>JABATAN</th>
                    <th>BAGIAN</th>
                    <?php
                    if ($datajabatan) {
                        $idkategori = '';
                        $no = 1;
                        $bagian = [1 => 'Putra', 'Putri', 'Umum'];
                        foreach ($datajabatan as $ddjx) {
                            $kategorihasil = $ddjx->kategori_jabatanpengurus;
                            if ($kategorihasil == 6) {
                                $idkategori = $kategorihasil;
                            }
                        }
                        if ($idkategori == 6) {
                    ?>
                    <th>INSTANSI</th>
                    <?php
                        }
                    }
                    ?>
                    <th>TGL. SK</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datajabatan) {
                    $no = 1;
                    $bagian = [1 => 'Putra', 'Putri', 'Umum'];
                    foreach ($datajabatan as $ddj) {
                        $idkategorilagi = $ddj->kategori_jabatanpengurus;

                ?>
                <tr class="detailjabatanpengurus" style="cursor: pointer;" data-id="<?= $ddj->induk_jabatanpengurus ?>"
                    data-toggle="tooltip" data-placement="bottom" title="Klik untuk melihat detail">
                    <td><?= $no++ ?></td>
                    <td><?= $ddj->nama_pengurus ?></td>
                    <td><?= $ddj->nama_jabatan ?></td>
                    <td><?= $bagian[$ddj->bagian_jabatanpengurus] ?></td>
                    <?php
                            if ($idkategorilagi == 6) {
                            ?>
                    <td><?= $ddj->instansi_jabatanpengurus ?></td>
                    <?php } ?>
                    <td><?= TampilHijri($ddj->tanggal_jabatanpengurus) ?></td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr class="text-center text-danger"><td colspan="6">Tak ada data untuk ditampilkan</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">Total 10 Orang</div>
    <!-- /.card-body -->
</div>