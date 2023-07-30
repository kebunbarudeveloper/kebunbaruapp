<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->
    <input type="hidden" id="flashdata" value="<?= $this->session->flashdata('hasilaturperiode'); ?>">
    <input type="hidden" id="pesankalender" value="<?= $this->session->flashdata('pesanaturkalender'); ?>">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>PESANTREN</th>
                                        <th>ALAMAT</th>
                                        <th>ACT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($data != 0) {
                                        foreach ($data as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['nama'] ?></td>
                                                <td><?= $row['alamat'] ?></td>
                                                <td>
                                                    <button class="btn btn-success btn-xs salin">
                                                        <i class="fa fa-copy"></i>
                                                        <span class="d-none">
                                                            <?= base_url() . 'peserta/registrasi/' . $row['url'] ?>
                                                        </span>
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <! -- /.content -->
</div>
<!-- /.content-wrapper -->

</div>