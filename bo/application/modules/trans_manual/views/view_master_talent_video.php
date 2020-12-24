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
          <form class="kt-form" id="form_video" action="<?= base_url('master_talent/simpan_video_talent'); ?>" method="post" enctype="multipart/form-data">
            <div class="kt-portlet__body">
              <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Upload Video </label>
                    <div></div>
                    <div class="custom-file col-lg-9 col-xl-6">
                      <input type="hidden" class="form-control" name="id_talent" value="<?= $data_talent->id; ?>">
                      <input type="file" class="custom-file-input" id="video" name="video" accept=".mp4,.mpg">
                      <label class="custom-file-label" id="label_foto" for="customFile">Pilih Video yang akan diupload</label>
                      <span class="form-text text-muted">Video tersimpan akan ditampilkan pada tabel gallery dibawah.</span>
                    </div>
                  </div>

                  <div class="progress hidden">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                      <span class="persen">0%</span>
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
                    <button type="button" class="btn btn-success" onclick="save_video()">Simpan</button>&nbsp;
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <h3>Gallery Video Talent</h3>
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_talent_det">
          <thead>
            <tr>
              <th style="width: 5%;">No</th>
              <th>Path File</th>
              <th style="width: 5%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_video as $key => $value) {?>
              <tr>
                <td><?= $key += 1; ?></td>
                <td><?= $value->path_video; ?></td>
                <td>
                  <button class="btn btn-danger btn-sm" onclick="delete_video('<?=$value->id; ?>')">Hapus</button>
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



