<div class="card" style="height: 70.5vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover text-nowrap table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID P2K</th>
                    <th>NAMA</th>
                    <th>ALASAN</th>
                    <th colspan="2" class="hideKelas">DOMISILI</th>
                    <th colspan="2" class="hideKelas">DINIYAH</th>
                    <th colspan="2" class="hideKelas">FORMAL</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($data) {
                    $no = 1;
                    foreach ($data as $row) {
                        $status = ['Dalam proses', 'Resmi boyong'];
                        $statusx = $row->status_angket;

                        $alasan = $row->alasan_boyong;
                        if ($alasan == '') {
                            $alasanx = 'Tanpa Alasan';
                        } else {
                            $alasanx = $alasan;
                        }

                ?>
                        <tr id="kelas<?= $row->id_datasantriboyong; ?>" class="posisimouse" data-id="<?= $row->id_datasantriboyong; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail" style="cursor:pointer">
                            <td><?= $no++ ?></td>
                            <td><?= $row->id_santriboyong ?></td>
                            <td><?= $row->nama_santri ?></td>
                            <td><?= $alasanx ?></td>
                            <td class="hideKelas"><?= $row->domisili_santri ?></td>
                            <td class="hideKelas"><?= $row->nomor_kamar_santri ?></td>
                            <td class="hideKelas"><?= $row->kelas_diniyah ?></td>
                            <td class="hideKelas"><?= $row->tingkat_diniyah ?></td>
                            <td class="hideKelas"><?= $row->kelas_formal ?></td>
                            <td class="hideKelas"><?= $row->tingkat_formal ?></td>
                            <td class="text-info"><?= $status[$statusx] ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr class="text-center text-danger"><td colspan="13">Tidak ada data untuk ditampilkan</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        Total : <b><?= $total; ?></b> Orang
    </div>
    <!-- /.card-body -->
</div>