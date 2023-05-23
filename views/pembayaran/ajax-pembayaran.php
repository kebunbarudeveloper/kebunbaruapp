<div class="card" style="height: 70.5vh;">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 100%;" id="cardScroll">
        <table class="table table-head-fixed table-hover text-nowrap table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>INVOICE</th>
                    <th>ID P2K</th>
                    <th>NAMA</th>
                    <th class="hideKelas">TANGGAL</th>
                    <th class="hideKelas">NOMINAL</th>
                    <th colspan="2" class="hideKelas">DOMISILI</th>
                    <th colspan="2" class="hideKelas">DINIYAH</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
				if ($data[0]) {
					$no = 1;
					foreach ($data[0] as $row) {
						$biaya = $row->tarif_pemasukan;
						$nominal = $row->nominal_pemasukan;
						$a = $biaya - $nominal;
						if ($a <= 0) {
							$status = 'Lunas';
						} else {
							$status = 'Belum Lunas';
						}

				?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->id_pemasukan ?></td>
                    <td><?= $row->id_santri_pemasukan ?></td>
                    <td><?= $row->nama_santri ?></td>
                    <td><?= TampilHijri($row->tanggal_pemasukan) ?></td>
                    <td><?= number_format($row->nominal_pemasukan, 0, ',', '.') ?></td>
                    <td class="hideKelas"><?= $row->domisili_santri ?></td>
                    <td class="hideKelas"><?= $row->nomor_kamar_santri ?></td>
                    <td class="hideKelas"><?= $row->kelas_diniyah ?></td>
                    <td class="hideKelas"><?= $row->tingkat_diniyah ?></td>
                    <td class="text-info"><?= $status ?></td>
                    <td><a href="<?= base_url() ?>pembayaran/getlinkangket/<?= $row->id_pemasukan ?>" style="padding: 0px 5px 0px 5px;"
                        class="btn btn-xs btn-success" target="_blank"><span style="font-size: 10px">Print</span></a>
					</td>
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
		<div style="display: inline-block; margin-right: 50px">Total : <b><?= $data[1]->total; ?></b> Orang</div>
        <div style="display: inline-block; margin-right: 50px" class="text-info">Pembayaran Hari Ini: <b>Rp. <?= number_format($data[2]->total, 0, ',', '.'); ?></b></div>
		<div style="display: inline-block" class="text-info">Total Pembayaran: <b>Rp. <?= number_format($data[3]->total, 0, ',', '.'); ?></b></div>
    </div>
    <!
 -- /.card-body -->
</div>