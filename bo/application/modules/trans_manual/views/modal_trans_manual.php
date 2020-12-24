<div class="modal fade modal_add_form" tabindex="-1" role="dialog" aria-labelledby="add_menu" aria-hidden="true" id="modal_trans_form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form id="form-transaksi" name="form-transaksi">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id_checkout" name="id_checkout">
            <label for="lbl_talent" class="form-control-label">Nama Lengkap:</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_email" class="form-control-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_telp" class="form-control-label">telp/hp:</label>
            <input type="text" class="form-control" id="telp" name="telp" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_alamat" class="form-control-label">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_type" class="form-control-label">Jenis Kelas:</label>
            <select name="jenis" id="jenis" class="form-control">
              <option value="">Pilih Jenis Kelas</option>
              <option value="reg">Reguler</option>
              <option value="vip">Eksklusif</option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_harga" class="form-control-label">Harga :</label>
            <input type="text" class="form-control" id="harga" name="harga" readonly>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="lbl_bayar" class="form-control-label">Jumlah Bayar :</label>
            <input type="text" class="form-control" id="bayar" name="bayar">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label>Bukti Transfer</label>
            <div></div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg,.jpeg,.png">
              <label class="custom-file-label" id="label_foto" for="customFile">Pilih gambar yang akan diupload</label>
            </div>
          </div>
          <div class="form-group" id="div_preview_foto" style="display: none;">
            <label for="" class="form-control-label">Preview Bukti:</label>
            <div></div>
            <img id="preview_img" src="#" alt="Preview Foto" height="200" width="200"/>
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
