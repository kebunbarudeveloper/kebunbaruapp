<div class="card-body table-responsive p-0" style="height: 480px;">
    <table class="table table-head-fixed text-nowrap table-sm">
        <thead>
            <tr>
                <th style="width: 10%;">INDUK</th>
                <th>NAMA</th>
                <th>STATUS</th>
                <th>DAERAH</th>
                <th>KAMAR</th>
                <th>ALAMAT</th>
                <th>PENDIDIKAN</th>
                <th>WALI</th>
            </tr>
        </thead>

        <tbody>
            <?php
            //var_dump($posts);
            if ($posts) {
                foreach ($posts as $datasantri) {
            ?>
            <tr>
                <td><span data-id="<?= $datasantri['id_santri'] ?>"
                        class="badge badge-btn badge-success detaildatasantri" data-toggle="modal"
                        data-target="#modal-xl" style="cursor: pointer;"><?= $datasantri['induk_santri']; ?></span></td>
                <td><?= $datasantri['nama_santri']; ?></td>
                <td><?= $datasantri['status_domisili_santri']; ?></td>
                <td><?= $datasantri['domisili_santri']; ?></td>
                <td><?= $datasantri['nomor_kamar_santri']; ?></td>
                <td><?= $datasantri['desa_santri'] . ' ' . $datasantri['kecamatan_santri'] . ' ' . $datasantri['kabupaten_santri']; ?>
                </td>
                <td><?= $datasantri['tingkat_diniyah']; ?></td>
                <td><?= $datasantri['nama_walisantri']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo '<tr class="text-center"><td colspan="8">Tak ada data untuk ditampilkan</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<!-- /.card-body -->
<div class="card-footer">
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>