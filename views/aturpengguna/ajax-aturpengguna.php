<?php
$katas  = [1 => 'Putra', 'Putri', 'Umum'];
$aktif  = ['Aktif', 'Ditangguhkan', 'Belum Diaktivasi'];
$warnas = ['danger', 'success', 'success'];
$aksi   = ['Tangguhkan', 'Buka Tangguhan', 'Aktivasi'];
$dataaksi = [1, 0, 0];
?>

<div class="col-12">
    <div class="card">
        <div class="card-body table-responsive p-0" style="height: 477px;">
            <table class="table table-head-fixed text-nowrap table-sm">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>KOMISI</th>
                        <th>AKSES JABATAN</th>
                        <th>USERNAME</th>
                        <th>TIPE</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($semua) {
                        $nos = 1;
                        foreach ($semua as $dsemua) {
                            $status = $dsemua->status_pengguna;
                    ?>
                    <tr>
                        <td><?= $nos++; ?></td>
                        <td><?= $dsemua->nama_pengguna; ?></td>
                        <td><?= $dsemua->nama_kategori; ?></td>
                        <td><?= $dsemua->nama_jabatan; ?></td>
                        <td><?= $dsemua->username; ?></td>
                        <td><?= $katas[$dsemua->tipe_pengguna]; ?></td>
                        <td><?= $aktif[$status]; ?></td>
                        <td> <span style="cursor: pointer;" data-id="<?= $dsemua->id_pengguna ?>"
                                data-aksi="<?= $dataaksi[$status]; ?>" data-kategori="<?= $dsemua->kategori_pengguna ?>"
                                data-status="<?= $status ?>"
                                class="badge badge-btn badge-<?= $warnas[$status] ?> aksipengguna"><?= $aksi[$status]; ?></span>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr class="text-center text-danger"><td colspan="8">Tak ada data untuk ditampilkan</td></tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>