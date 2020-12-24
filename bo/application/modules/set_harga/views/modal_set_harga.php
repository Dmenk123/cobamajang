
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
            <label for="lbl_harga" class="form-control-label">Harga :</label>
            <input type="text" class="form-control numberinput" id="harga" name="harga" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Harga Coret :</label>
            <input type="text" class="form-control numberinput" id="harga_coret" name="harga_coret" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Laba Agen :</label>
            <input type="text" class="form-control numberinput" id="laba" name="laba" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Laba Agen (%) :</label>
            <input type="text" class="form-control numberinput" id="laba_persen" name="laba_persen" autocomplete="off">
            <span class="help-block"></span>
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
