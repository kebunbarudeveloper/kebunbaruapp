<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->
    <input type="hidden" id="urlprofilranting" value="<?= base_url() ?>profilranting/loaddataranting">
    <input type="hidden" id="urldataajaxranting" value="<?= base_url() ?>profilranting/GetDataRanting">
    <input type="hidden" id="urldataprovinsi" value="<?= base_url() ?>profilranting/GetProvinsi">
    <input type="hidden" id="urldatakab" value="<?= base_url() ?>profilranting/GetKab">
    <input type="hidden" id="urldatakec" value="<?= base_url() ?>profilranting/GetKec">
    <input type="hidden" id="urldatadesa" value="<?= base_url() ?>profilranting/GetDesa">
    <input type="hidden" id="urleditranting" value="<?= base_url() ?>profilranting/simpaneditranting">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row" id="ajaxprofilranting">
          
        </div>
        
        <!-- /.row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
</div>




<div class="modal fade" id="modal-xl" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Sunting Data Ranting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="formeditranting" autocomplete="off">
      <div class="modal-body ui-front">
        <div class="row">
          <div class="col-6">
            <div class="form-group row">
              <label for="nostatistik" class="col-sm-4 col-form-label">No. Statistik</label>
              <div class="col-sm-8">
                <input type="text" tabindex="0" class="form-control inputeditranting" id="nostatistik" name="nostatistik">
              </div>
            </div>
            <div class="form-group row">
              <label for="noidentitas" class="col-sm-4 col-form-label">No. Identitas</label>
              <div class="col-sm-8">
                <input type="text" tabindex="1" class="form-control inputeditranting" id="noidentitas" name="noidentitas">
              </div>
            </div>
            <div class="form-group row">
              <label for="noperanting" class="col-sm-4 col-form-label">Nomor HP</label>
              <div class="col-sm-8">
                <input type="text" tabindex="2" class="form-control inputeditranting" id="noperanting" name="noperanting" data-inputmask="'mask' : '999-999-999-999'" data-mask="">
              </div>
            </div>
            <div class="form-group row">
              <label for="namayayasan" class="col-sm-4 col-form-label">Nama Yayasan</label>
              <div class="col-sm-8">
                <input type="text" tabindex="3" class="form-control inputeditranting" id="namayayasan" name="namayayasan">
              </div>
            </div>
            <div class="form-group row">
              <label for="akteyayasan" class="col-sm-4 col-form-label">No. Akte Yayasan</label>
              <div class="col-sm-8">
                <input type="text" tabindex="4" class="form-control inputeditranting" id="akteyayasan" name="akteyayasan">
              </div>
            </div>
            <div class="form-group row">
              <label for="pengasuh" class="col-sm-4 col-form-label">Pengasuh Yayasan</label>
              <div class="col-sm-8">
                <input type="text" tabindex="5" class="form-control inputeditranting" id="pengasuh" name="pengasuh">
              </div>
            </div>
            <div class="form-group row">
              <label for="tahunberdiriranting" class="col-sm-4 col-form-label">Thn. Berdiri MMU | Yayasan</label>
              <div class="col-sm-4">
                <input type="text" tabindex="6" class="form-control inputeditranting" id="tahunberdiriranting" name="tahunberdiriranting" data-inputmask="'mask' : '9999'" data-mask="">
              </div>
              <div class="col-sm-4">
                <input type="text" tabindex="7" class="form-control inputeditranting" id="tahunberdiriyayasan" name="tahunberdiriyayasan" data-inputmask="'mask' : '9999'" data-mask="">
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row">
              <label for="provinsiranting" class="col-sm-4 col-form-label">Provinsi</label>
              <div class="col-sm-8">
                <input type="text" tabindex="8" class="form-control inputeditranting" id="provinsiranting" name="provinsiranting">
              </div>
            </div>
            <input type="hidden" id="idProvinsi" value="">
            <div class="form-group row">
              <label for="kabranting" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
              <div class="col-sm-8">
                <input type="text" tabindex="9" class="form-control inputeditranting" id="kabranting" name="kabranting">
              </div>
            </div>
            <input type="hidden" id="idKab" value="">
            <div class="form-group row">
              <label for="kecranting" class="col-sm-4 col-form-label">Kecamatan</label>
              <div class="col-sm-8">
                <input type="text" tabindex="10" class="form-control inputeditranting" id="kecranting" name="kecranting">
              </div>
            </div>
            <input type="hidden" id="idKec" value="">
            <div class="form-group row">
              <label for="desaranting" class="col-sm-4 col-form-label">Desa</label>
              <div class="col-sm-8">
                <input type="text" tabindex="11" class="form-control inputeditranting" id="desaranting" name="desaranting">
              </div>
            </div>
            <div class="form-group row">
              <label for="dusunranting" class="col-sm-4 col-form-label">Dusun</label>
              <div class="col-sm-8">
                <input type="text" tabindex="12" class="form-control inputeditranting" id="dusunranting" name="dusunranting">
              </div>
            </div>
            <div class="form-group row">
              <label for="posranting" class="col-sm-4 col-form-label">RT/RW/Kode Pos</label>
              <div class="col-sm-2">
                <input type="text" tabindex="13" class="form-control inputeditranting" id="rtranting" name="rtranting" data-inputmask="'mask' : '999'" data-mask="">
              </div>
              <div class="col-sm-2">
                <input type="text" tabindex="14" class="form-control inputeditranting" id="rwranting" name="rwranting" data-inputmask="'mask' : '999'" data-mask="">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="posranting" name="posranting" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="emailranting" class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-8">
                <input type="text" tabindex="15" class="form-control inputeditranting" id="emailranting" name="emailranting">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary inputeditranting" id="tombolsimpaneditranting">Simpan Perubahan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

