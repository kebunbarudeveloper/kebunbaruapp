<div class="col-12">
    <div class="card card-primary card-outline card-tabs" style="min-height: 500px;">
        <div class="row">
        <div class="col-10">
            <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Profil MMU</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Struktur Pimpinan</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Statistik Data</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Statistik Nilai</a>
                </li>
            </ul>
            </div>
        </div>
        <div class="col-2">
            <button type="submit" id="tombolmodaledit" data-toggle="modal" data-target="#modal-xl" class="btn btn-xs btn-primary float-right mt-2 mr-2">
            <i class="fas fa-plus-circle"></i> Sunting Data
            </button>
        </div>
        </div>
        
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <div class="row">
                        <div class="col-6">
                            <table border="0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="padding:8px; width: 35%; border-bottom: 1px solid #ddd;">Kode Ranting</th>
                                        <th style="padding:8px; width: 5%; border-bottom: 1px solid #ddd;">:</th>
                                        <th style="padding:8px; width: 60%; border-bottom: 1px solid #ddd;"><?= $dataranting->kode_ranting; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Status Ranting</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= ucwords($dataranting->status_ranting); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Tahun Meranting</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->tahun_meranting; ?> H</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Nama Ranting</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">MMU <?= $dataranting->nama_ranting; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">No. Statistik</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->no_statistik; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">No. Identitas</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->no_identitas; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Tahun Berdiri</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->tahun_berdiri; ?> H</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Status Akreditasi</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?php if($dataranting->status_akreditasi == '0'){ echo 'Belum Terakreditasi'; }else{echo $dataranting->status_akreditasi; } ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Tahun Akreditasi</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->tahun_akreditasi ?> H</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table border="0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="padding:8px; width: 35%; border-bottom: 1px solid #ddd;">Nama Yayasan</th>
                                        <th style="padding:8px; width: 5%; border-bottom: 1px solid #ddd;">:</th>
                                        <th style="padding:8px; width: 60%; border-bottom: 1px solid #ddd;"><?= $dataranting->nama_yayasan ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Nomor Akte</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->akte_yayasan ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Tahun Berdiri</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->tahun_berdiri_yayasan ?> H</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Pengasuh</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->pengasuh_yayasan ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px;">Alamat</td>
                                        <td style="padding:8px;">:</td>
                                        <td style="padding:8px;"><?= $dataranting->dusun_ranting.', RT '.$dataranting->rt_ranting.'/RW '.$dataranting->rw_ranting; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px;"></td>
                                        <td style="padding:8px;"></td>
                                        <td style="padding:8px;"><?= $dataranting->desa_ranting.' '.$dataranting->kec_ranting.', '.$dataranting->kab_ranting; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"></td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"></td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->pro_ranting.', '.$dataranting->pos_ranting; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Nomor HP</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->nope_ranting; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">Email</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;">:</td>
                                        <td style="padding:8px; border-bottom: 1px solid #ddd;"><?= $dataranting->email_ranting; ?></td>
                                    </tr>
                                </tbody>    
                            </table>
                        </div>
                        <div class="col-12 mt-5">
                            <p class="text-info mb-0"> <i>* Lengkapi data ranting dengan klik button <b>Sunting Data</b> di pojok kanan atas </i> </p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    Dalam tahap pengembangan
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                    Dalam tahap pengembangan
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                    Dalam tahap pengembangan
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
</div>