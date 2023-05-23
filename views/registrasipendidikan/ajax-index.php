<div class="col-6">
    <div class="card">
        <div class="card-body py-2 text-center">
            <h6 class="mb-0">DINIYAH</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-sm text-left">
                <thead>
                    <tr>
                        <th>Tingkat</th>
                        <th>:</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data[0]) {
                        foreach ($data[0] as $d) {
                    ?>
                            <tr>
                                <td><?= $d->tingkat ?></td>
                                <td>:</td>
                                <td><?= $d->total ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="<?= base_url() ?>registrasipendidikan/export/1" class="btn btn-sm btn-primary btn-block">
                Export Excel
            </a>
        </div>
    </div>
</div>
<div class="col-6">
    <div class="card">
        <div class="card-body py-2 text-center">
            <h6 class="mb-0">FORMAL</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-sm text-left">
                <thead>
                    <tr>
                        <th>Tingkat</th>
                        <th>:</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data[1]) {
                        foreach ($data[1] as $d) {
                    ?>
                            <tr>
                                <td><?= $d->tingkat ?></td>
                                <td>:</td>
                                <td><?= $d->total ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="<?= base_url() ?>registrasipendidikan/export/2" class="btn btn-sm btn-primary btn-block">
                Export Excel
            </a>
        </div>
    </div>
</div>