
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_harga_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-harga" name="form-harga">
          <input type="hidden" class="form-control" id="id_harga" name="id_harga">
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Nama Talent :</label>
            <select class="form-control kt-select2" id="talent" name="talent" style="width: 100%;">
              <option value="">Silahkan Pilih Talent</option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Jenis Harga :</label>
            <select class="form-control" id="jenis_harga" name="jenis_harga" style="width: 100%;">
              <option value="1">Reguler</option>
              <option value="2">Eksklusif</option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_harga" class="form-control-label">Harga :</label>
            <input type="text" class="form-control numberinput" id="harga" name="harga" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Diskon / Tidak :</label>
            <select class="form-control" id="is_diskon" name="is_diskon" style="width: 100%;">
              <option value="">Harga Normal</option>  
              <option value="1">Diskon</option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="hidden" id="div_diskon_area">
            <div class="form-group">
              <label for="lbl_talent" class="form-control-label">Nama Diskon :</label>
              <select class="form-control kt-select2" id="diskon" name="diskon" style="width: 100%;">
                <option value="">Silahkan Pilih Diskon</option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="form-group">
              <label for="lbl_masa" class="form-control-label">Masa Berlaku Diskon: (Dalam Satuan Hari)</label>
              <input type="text" class="form-control numberinput" id="masa_berlaku" name="masa_berlaku" autocomplete="off">
              <span class="help-block"></span>
            </div>
            <div class="form-group">
              <label for="lbl_masa" class="form-control-label">tgl Mulai Diskon: </label>
              <input type="text" class="form-control kt_datepicker" id="tgl_mulai_disc" name="tgl_mulai_disc" autocomplete="off">
              <span class="help-block"></span>
            </div>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>
