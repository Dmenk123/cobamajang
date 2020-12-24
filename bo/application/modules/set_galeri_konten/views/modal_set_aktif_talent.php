
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_talent_aktif_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-talent-aktif" name="form-talent-aktif">
          <input type="hidden" class="form-control" id="id_talent_aktif" name="id_talent_aktif">
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Nama Talent :</label>
            <select class="form-control kt-select2" id="talent" name="talent" style="width: 100%;">
              <option value="">Silahkan Pilih Talent</option>
            </select>
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
