<table class="table table-head-fixed table-hover">
    <thead>
        <tr>
            <th>NO</th>
            <th></th>
            <th>NAMA</th>
            <th>DOMISILI</th>
            <th>PENDIDIKAN</th>
            <th>ALAMAT</th>
            <th>STATUS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 1; $i < 60; $i++) {
        ?>
            <tr style="cursor: pointer;">
                <td class="align-middle"><?= $i ?></td>
                <td class="align-middle">
                    <img src="<?= base_url() ?>assets/fotosantri/1/27070707.jpg" style="width: 40px; border-radius: 5px;" class="table-avatar">
                </td>
                <td class="align-middle">
                    <b>RAHMAN FARUQ</b>
                    <br>
                    <small>27070707</small>
                </td>
                <td class="align-middle">Bahasa Jawa - 1</td>
                <td class="align-middle">1 - Ibtidaiyah</td>
                <td class="align-middle">Larangan Slampar</td>
                <td class="align-middle">Aktif</td>
            </tr>
        <?php
        }
        ?>

    </tbody>
</table>