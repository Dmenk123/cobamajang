<style>
.tag-primary {
  color: #fff;
  background-color: #007bff;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 2px solid rgba(0, 70, 147, 0.75);
}
.tag-success {
  color: #fff;
  background-color: #28a745;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 1px solid rgba(21, 87, 36, 0.75);
}
.tag-secondary {
  color: #fff;
  background-color: #868e96;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 1px solid rgba(134, 142, 150, 0.75);
}
.tag-info {
  color: #fff;
  background-color: #17a2b8;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 1px solid rgba(23, 162, 184, 0.75);  
}
.tag-dark {
  color: #fff;
  background-color: #343a40;
  border-color: #343a40;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 1px solid rgba(52, 58, 64, 0.75);    
}
.tag-danger {
  color: #fff;
  background-color: #dc3545;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 1px solid rgba(220, 53, 69, 0.75);      
}
.tag-warning {
  color: #212529;
  background-color: #ffc107;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 1px solid rgba(255, 193, 7, 0.75);    
}
.tag-light {
  color: #212529;
  background-color: #f8f9fa;
  border-color: #f8f9fa;
  border-radius: 35px;
  padding-left:5px;
  padding-right:5px;
  border: 1px solid rgba(248, 249, 250, 0.75);     
}
</style>
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
        <div class="row" style="padding-bottom: 20px;">
          <div class="col-md-3 row">
            <label class="col-form-label col-lg-2">Mulai</label>
            <div class="col-lg-9">
              <input type="text" class="form-control kt_datepicker" id="tgl_filter_mulai" readonly placeholder="Tanggal Awal" value="<?= DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->modify('-10 day')->format('d/m/Y'); ?>"/>
            </div>
          </div>
          <div class="col-md-3 row">
            <label class="col-form-label col-lg-2">Akhir</label>
            <div class="col-lg-9">
              <input type="text" class="form-control kt_datepicker" id="tgl_filter_akhir" readonly placeholder="Tanggal Akhir" value="<?= DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('d/m/Y'); ?>"/>
            </div>
          </div>
          <div class="col-md-3 row">
            <label class="col-form-label col-lg-2">Status</label>
            <div class="col-lg-9">
              <!-- <input type="text" class="form-control kt_datepicker" id="status_filter" readonly/> -->
              <select name="status_filter" id="status_filter" class="form-control">
                <option value="all">All</option>
                <option value="capture">Capture</option>
                <option value="manual">Manual</option>
                <option value="pending">pending</option>
                <option value="deny">Deny</option>
                <option value="cancel">Cancel</option>
                <option value="expire">Expire</option>
                <option value="refund">refund</option>
              </select>
            </div>
          </div>
          <div class="col-md-3 row">
            <div>
              <button type="button" class="btn btn-brand" onclick="filter_tabel()">Cari</button>
            </div>
          </div>
        </div>
        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_confirm_jual" style="width: 100%;">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Order ID</th>
              <th>Email</th>
              <th>Nama</th>
              <th>Telp</th>
              <th>Harga</th>
              <th>Status</th>
              <th style="width: 5%;">Aksi</th>
            </tr>
          </thead>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



