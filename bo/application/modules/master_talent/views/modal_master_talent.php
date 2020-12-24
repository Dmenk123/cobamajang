
<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_talent_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-talent" name="form-talent">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_talent" name="id_talent">
            <label for="lbl_talent" class="form-control-label">Nama Talent:</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label>Foto Utama</label>
            <div></div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg,.jpeg,.png">
              <label class="custom-file-label" id="label_foto" for="customFile">Pilih gambar yang akan diupload</label>
            </div>
          </div>
          <div class="form-group" id="div_preview_foto" style="display: none;">
            <label for="lbl_password_lama" class="form-control-label">Preview Foto:</label>
            <div></div>
            <img id="preview_img" src="#" alt="Preview Foto" height="200" width="200"/>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_deskripsi" class="form-control-label">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Akun Facebook Talent:</label>
            <input type="text" class="form-control" id="akun_fb" name="akun_fb" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Akun Instagram Talent:</label>
            <input type="text" class="form-control" id="akun_ig" name="akun_ig" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_talent" class="form-control-label">Akun Twitter Talent:</label>
            <input type="text" class="form-control" id="akun_tw" name="akun_tw" autocomplete="off">
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
