<div class="modal-header py-2">
    <h6 class="modal-title" id="title">Detail Transaksi</h6>
    <i class="fas fa-times-circle mt-2" style="cursor: pointer" data-dismiss="modal"></i>
</div>
<?php
if ($data) {
    $fotoc = FCPATH . 'assets/fotosantri/';
    $foto = base_url('assets/fotosantri/');
    $image = $data->tipe_santri . '/' . $data->id_santri . '.jpg';

    if (file_exists($fotoc . $image) === FALSE || $image == NULL) {
        $fotoj = $foto . $data->tipe_santri . '.jpg';
    } else {
        $fotoj = $foto . $image;
    }
?>
    <div class="modal-body">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <img alt="Foto <?= $data->nama_santri ?>" src="<?= $fotoj ?>" style="width: 130px; border-radius: 3px;">
                        </div>
                        <p class="profile-username text-center"><?= $data->nama_santri ?></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b><?= $data->domisili_santri ?></b>
                                <a class="float-right"><?= $data->nomor_kamar_santri ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?= $data->kelas_diniyah ?></b>
                                <a class="float-right"><?= $data->tingkat_diniyah ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?= $data->kelas_formal ?></b>
                                <a class="float-right"><?= $data->tingkat_formal ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td style="width: 60%">Nomor</td>
                                        <td style="width: 40%"><?= $data->id ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td><?= TampilHijri($data->hijriah) ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table>
                                    <tr>
                                        <td style="width: 68%">Nominal</td>
                                        <td style="width: 2%">Rp. </td>
                                        <td style="width: 30%" class="text-right">
                                            <?= number_format($data->nominal, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pengurangan</td>
                                        <td>Rp. </td>
                                        <td class="text-right"><?= number_format($data->diskon, 0, ',', '.') ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6" style="max-height: 50vh; overflow-y: auto">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td colspan="3"><b>DETAIL PEMBAYARAN</b></td>
                                        </tr>
                                        <?php
                                        $id = $data->id;
                                        $detail = $this->pm->getdetailpayment($id);
                                        if ($detail) {
                                            foreach ($detail as $d) {
                                        ?>
                                                <tr>
                                                    <td style="width: 78%"><?= $d->nama_akunkeuangan ?></td>
                                                    <td style="width: 2%">Rp.</td>
                                                    <td style="width: 20%" class="text-right">
                                                        <?= number_format($d->nominal, 0, ',', '.') ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="3" class="text-center text-danger">Tidak ada data</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td colspan="3"><b>DETAIL PENGURANGAN</b></td>
                                        </tr>
                                        <?php
                                        $diskon = $data->diskon;
                                        if ($diskon > 0) {
                                            $diskonId = $data->diskon_id;
                                            $detaildiskon = $this->pm->getdiskondetail($diskonId);
                                            if ($detaildiskon) {
                                                foreach ($detaildiskon as $dis) {
                                        ?>
                                                    <tr>
                                                        <td style="width: 78%"><?= $dis->nama_akunkeuangan ?></td>
                                                        <td style="width: 2%">Rp.</td>
                                                        <td style="width: 20%" class="text-right">
                                                            <?= number_format($dis->nominal, 0, ',', '.') ?>
                                                        </td>
                                                    </tr>
                                        <?php
                                                }
                                            } else {
                                                echo '<tr><td colspan="3" class="text-center text-danger">Tidak ada data</td></tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="3" class="text-center text-danger">Tidak ada data</td></tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>
                                <hr>
                                <div class="float-right mt-5">
                                    <button type="button" onclick="deletepayment(<?= $id ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Transaksi</button>
                                    <form action="<?= base_url() ?>payment/print" target="_blank" method="post" class="d-inline-block">
                                        <input type="hidden" name="invoice" value="<?= $id ?>">
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print Kuitansi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>