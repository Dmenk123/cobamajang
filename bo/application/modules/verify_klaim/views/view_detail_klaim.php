<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul'); ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="col-12">

      <!--begin::Portlet-->
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Formulir verifikasi Klaim</h3>
          </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form" id="form_verify">
          <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
              <h3 class="kt-section__title">1. Info Klaim oleh Member:</h3>
              <div class="kt-section__body">
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Nama Member:</label>
                  <div class="col-lg-6">
                    <input type="hidden" class="form-control" name="id_klaim_agen" readonly value="<?=$data_klaim->id;?>">
                    <input type="text" class="form-control" name="nama_agen" readonly value="<?=$data_klaim->nama_agen;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Email:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=$data_klaim->email;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">No Telp:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=$data_klaim->no_telp;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Kode Member:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=$data_klaim->kode_agen;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Kode Klaim:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=$data_klaim->kode_klaim;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Bank:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=$data_klaim->bank;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Rekening:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=$data_klaim->rekening;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Total Klaim:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=number_format($data_klaim->jumlah_klaim,0,',','.');?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Tanggal Klaim:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" readonly value="<?=$data_klaim->datetime_klaim;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <h3 class="kt-section__title">2. Info Verifikasi Klaim oleh Admin:</h3>
              <?php if($data_klaim->id_user_verify != null) { 
                echo '<span style="font-size: 20px;color:blue;"><strong>Sudah Diverifikasi</strong></span>';
                echo '<br>';
                echo '<span style="font-size: 14px;"><strong>Tanggal Verifikasi : '.$data_klaim->datetime_verify.'</strong></span>';
                echo '<hr>';
              } ?>
              
              <div class="kt-section__body">
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Bank (Verifikasi):</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" name="bank" value="<?=$data_klaim->bank_verify;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Rekening:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control" name="rekening" value="<?=$data_klaim->rek_verify;?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label">Jumlah Transfer:</label>
                  <div class="col-lg-6">
                    <input type="text" class="form-control numberinput" name="jml_transfer" value="<?=(int)$data_klaim->nilai_transfer?>">
                    <span class="help-block"></span>
                  </div>
                </div>
                <?php if($data_klaim->id_user_verify == null) { ?>
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Upload Bukti Transfer Verifikasi </label>
                  <div></div>
                  <div class="custom-file col-lg-9 col-xl-6">
                    <input type="file" class="custom-file-input" id="foto" name="foto" accept=".jpg,.jpeg,.png">
                    <label class="custom-file-label" id="label_foto" for="customFile">Pilih gambar yang akan diupload</label>
                    <span class="help-block"></span>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group" id="div_preview_foto" style="<?php if($foto_encoded == false){echo 'display: none;'; } ?>">
                  <label for="" class="form-control-label">Preview Bukti Transfer:</label>
                  <div></div>
                  <img id="preview_img" src="<?php if($foto_encoded !== false) { echo 'data:image/jpeg;base64,'.$foto_encoded;} ?>" alt="Preview Foto" height="400" width="400"/>
                  <span class="help-block"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="kt-portlet__foot">
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                  <?php if($data_klaim->id_user_verify == null) { ?>
                  <button type="submit" class="btn btn-success">Submit</button>
                  <?php } ?>
                  <a type="button" class="btn btn-secondary" href="<?=base_url('verify_klaim');?>">Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </form>

        <!--end::Form-->
      </div>
      <!--end::Portlet-->
    </div>
  </div>
</div>
