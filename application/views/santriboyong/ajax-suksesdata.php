<div class="col-sm-12">
    <table style="width: 100%;">
        <thead>
            <th colspan="3">IDENTITAS SANTRI</th>
        </thead>
        <tbody>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $data->nama_santri; ?></td>
            </tr>
            <tr>
                <td>Domisili</td>
                <td>:</td>
                <td><?= $data->domisili_santri . ' - ' . $data->nomor_kamar_santri; ?></td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>:</td>
                <td><?= $data->kelas_diniyah . ', ' . $data->tingkat_diniyah . ' | ' . $data->kelas_formal . ', ' . $data->tingkat_formal; ?>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Alamat</td>
                <td style="vertical-align: top;">:</td>
                <td><?= $data->desa_santri . ' ' . $data->kecamatan_santri . ' ' . $data->kabupaten_santri . ' ' . $data->provinsi_santri . ', ' . $data->kode_pos_santri; ?>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table style="width: 100%;">
        <thead>
            <th colspan="3">IDENTITAS WALI SANTRI</th>
        </thead>
        <tbody>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $data->nama_wali; ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Alamat</td>
                <td style="vertical-align: top;">:</td>
                <td><?= $data->desa_wali . ' ' . $data->kec_wali . ' ' . $data->kab_wali . ' ' . $data->pro_wali . ', ' . $data->pos_wali; ?>
                </td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><?= $data->pekerjaan_wali; ?></td>
            </tr>
        </tbody>
    </table>
</div>