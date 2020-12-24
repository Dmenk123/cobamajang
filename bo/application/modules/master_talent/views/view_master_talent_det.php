<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content Head -->
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          <?= $this->template_view->nama('judul').' - '.$title; ?>
        </h3>
      </div>
    </div>
  </div>
  <!-- end:: Content Head -->

  <!-- begin:: Content -->
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions row">
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">
        <div class="col-12">
          <div class="col-12">
            <p style="font-size:26px;">Biodata Talent</p>
          </div>
          <div class="col-12">
            <div class="form-group row">
              <img id="preview_img" src="<?= 'data:image/jpeg;base64,'.$foto_encode; ?>" alt="Preview Foto" height="200" width="200"/>
              <span class="help-block"></span>
            </div>
            <div class="row form-group">
              <div class="col-lg-3 col-xl-3">Nama</div>
              <div class="col-lg-9 col-xl-9"><?=$data_talent->nama; ?></div>
            </div>
            <div class="row form-group">
              <div class="col-lg-3 col-xl-3">Deskripsi</div>
              <div class="col-lg-9 col-xl-9"><?=$data_talent->deskripsi; ?></div>
            </div>
            <div class="row form-group">
              <div class="col-lg-3 col-xl-3">Facebook</div>
              <div class="col-lg-9 col-xl-9"><?=$data_talent->akun_fb; ?></div>
            </div>
            <div class="row form-group">
              <div class="col-lg-3 col-xl-3">Instagram</div>
              <div class="col-lg-9 col-xl-9"><?=$data_talent->akun_ig; ?></div>
            </div>
            <div class="row form-group">
              <div class="col-lg-3 col-xl-3">Twitter</div>
              <div class="col-lg-9 col-xl-9"><?=$data_talent->akun_tw; ?></div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <form class="kt-form" id="form_file_det">
            <div class="kt-portlet__body">
              <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Upload gambar </label>
                    <div></div>
                    <div class="custom-file col-lg-9 col-xl-6">
                      <input type="hidden" class="form-control" name="id_talent" value="<?= $data_talent->id; ?>">
                      <input type="file" class="custom-file-input" id="foto_det" name="foto_det" accept=".jpg,.jpeg,.png">
                      <label class="custom-file-label" id="label_foto" for="customFile">Pilih gambar yang akan diupload</label>
                      <span class="form-text text-muted">Gambar tersimpan akan ditampilkan pada tabel gallery dibawah.</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="kt-portlet__foot">
              <div class="kt-form__actions">
                <div class="row">
                  <div class="col-lg-3 col-xl-3">
                  </div>
                  <div class="col-lg-9 col-xl-9">
                    <button type="button" class="btn btn-success" onclick="save_detail()">Simpan</button>&nbsp;
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <h3>Gallery Foto Talent</h3>
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_talent_det">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th style="width: 10%;">Foto</th>
              <th>Path File</th>
              <th style="width: 5%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_gallery as $key => $value) {?>
              <tr>
                <td><?= $key += 1; ?></td>
                <td><?= '<div class="kt-widget__media"><img src="../../../'.$value->path_file_thumb.'"/></div>'; ?></td>
                <td><?= $value->path_file; ?></td>
                <td>
                  <button class="btn btn-danger btn-sm" onclick="delete_gallery('<?=$value->id; ?>')">Hapus</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



