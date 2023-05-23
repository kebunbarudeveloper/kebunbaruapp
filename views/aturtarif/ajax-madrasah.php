<table class="table table-hover text-nowrap table-sm">
    <thead>
        <tr>
            <th>NO</th>
            <th>URAIAN</th>
            <th>SEGMEN</th>
            <th>NOMINAL</th>
            <th>TINDAKAN</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($data) {
            $no = 1;
            $text = [1 => 'Putra', 'Putri'];
            foreach ($data as $d) {
        ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d->nama_akunkeuangan ?></td>
                    <td><?= $text[$d->tipe] ?></td>
                    <td><?= $d->nominal ?></td>
                    <td>
                        <button <?= ($pengaturan > 0) ? 'disabled' : '' ?> class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-umum" data-table="<?= $table ?>" onclick="editumum(<?= $d->id ?>, this)" data-akun="<?= $d->nama_akunkeuangan ?>" data-nominal="<?= $d->nominal ?>">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5" class="text-danger text-center font-weight-bold">Data tidak ditemukan</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>