<div class="card" style="height: 71vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed text-nowrap table-sm table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>INDUK</th>
                    <th>KOMISI</th>
                    <th>NAMA PENGURUS</th>
                    <th>JABATAN</th>
                    <th>BAGIAN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datajabatan) {
                    $no = 1;
                    $bagian = [1 => 'Putra', 'Putri', 'Umum'];
                    foreach ($datajabatan as $ddj) {


                ?>
                <tr class="detailjabatanpengurus" style="cursor: pointer;" data-id="<?= $ddj->id_jabatanpengurus ?>"
                    data-toggle="tooltip" data-placement="bottom" title="Klik untuk melihat detail">
                    <td><?= $no++ ?></td>
                    <td><?= $ddj->induk_pengurus ?></td>
                    <td><?= $ddj->nama_kategori ?></td>
                    <td><?= $ddj->nama_pengurus ?></td>
                    <td><?= $ddj->nama_jabatan ?></td>
                    <td><?= $bagian[$ddj->bagian_jabatanpengurus] ?></td>
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
    <!-- /.card-body -->
</div>