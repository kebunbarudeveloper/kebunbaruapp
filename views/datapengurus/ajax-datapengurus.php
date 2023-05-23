<div class="card" style="height: 70vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover text-nowrap table-sm">
            <thead>
                <tr>
                    <th class="py-2">NO</th>
                    <th class="py-2">ID PENGURUS</th>
                    <th class="py-2">NAMA</th>
                    <th class="py-2">J. KELAMIN</th>
                    <th class="py-2">TMP. LAHIR</th>
                    <th class="py-2">TGL. LAHIR</th>
                    <th class="py-2">UMUR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($datapengurus) {
                    $no = 1;
                    foreach ($datapengurus as $ds) {
                        $kataKelamin = [1 => 'Laki-laki', 'Perempuan'];
                ?>
                <tr style="cursor: pointer;" class="detaildatapengurus" data-id="<?= $ds->induk_pengurus ?>"
                    data-toggle="tooltip" data-placement="top" title="Klik untuk lihat detail">
                    <td><?= $no++ ?></td>
                    <td><?= $ds->induk_pengurus ?></td>
                    <td><?= $ds->nama_pengurus ?></td>
                    <td><?= $kataKelamin[$ds->kelamin_pengurus] ?></td>
                    <td><?= $ds->tempat_pengurus; ?></td>
                    <td><?= tanggalIndo($ds->tanggal_pengurus); ?></td>
                    <td><?= $ds->umur ?></td>
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
    <div class="card-footer">
        Total : <?= $totalpengurus->total ?> orang
    </div>
    <!-- /.card-body -->
</div>