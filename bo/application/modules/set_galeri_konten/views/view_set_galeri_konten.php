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
      <div class="kt-portlet__body">
        <form class="kt-form" id="form_galeri">
          <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
              <div class="kt-section__body">
                
                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Urutan</label>
                  <div class="col-lg-9 col-xl-6">
                    <input class="form-control numberinput" type="text" value="" name="urutan" autocomplete="off">
                    <span class="help-block"></span>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-xl-3 col-lg-3 col-form-label">Pilih Galeri</label>
                  <div class="col-lg-9 col-xl-6">
                    <select class="form-control kt-select2" id="sel_galeri" name="sel_galeri" style="width: 100%;">
                      <option value="">Silahkan Pilih Galeri</option>
                    </select>
                    <span class="help-block"></span>
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
                  <button id="btnSave" type="button" class="btn btn-success" onclick="save()">Simpan</button>&nbsp;
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_galeri">
          <thead>
            <tr>
              <th style="width: 5%;">Urut</th>
              <th style="width: 5%;">Foto</th>
              <th>Nama Talent</th>
              <th>Path Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_galeri as $key => $value) {
              echo '<tr>';
              echo '<td>'.$value->urutan.'</td>';
              echo '<td><span><img src="../'.$value->path_file_thumb.'"/></td>';
              echo '<td>'.$value->nama_talent.'</td>';
              echo '<td>'.$value->path_file.'</td>';
              echo '<td><button type="button" class="btn btn-danger btn-sm" onclick="delete_galeri(\''.$value->id.'\')">hapus</button></td>';
              echo '</tr>';
            } ?>
          </tbody>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



