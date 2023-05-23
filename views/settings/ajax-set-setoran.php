<h6 class="text-success text-center">Saat ini : Setoran ke-<?= ($setoran[1]) ? $setoran[1]->list : '--' ?></h6>
<h6 class="text-success text-center">Batas Akhir : <?= ($setoran[1]) ? tanggalIndo($setoran[1]->batas) : '' ?></h6>
<hr>
<div class="row mt-3">
    <label for="inputEmail3" class="col-sm-4 col-form-label pl-0">Pilih Setoran</label>
    <div class="col-sm-8 pr-0">
        <select class="form-control form-control-sm" id="setoran">
            <option value="111">.:Setoran.:</option>
            <?php
            foreach ($setoran[0] as $rowsetoran) {
                $statusSetoran = $rowsetoran->status;
            ?>
                <option value="<?= $rowsetoran->list ?>" <?= ($statusSetoran == 1) ? 'disabled' : '' ?>><?= $rowsetoran->list ?></option>
            <?php
            }
            ?>

        </select>
    </div>
</div>
<div class="row mt-3">
    <label for="batas" class="col-sm-4 col-form-label pl-0">Batas Akhir</label>
    <div class="col-sm-8 pr-0">
        <input type="date" class="form-control form-control-sm" id="batas">
    </div>
</div>