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
              <?= $this->template_view->getAddButton();?>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="tabel_email" style="width: 100%;">
          <thead>
            <tr>
              <th style="width:5%">Tanggal</th>
              <th style="width:10%">Order ID</th>
              <th style="width: 40%;">Pesan</th>
              <th>Email</th>
              <th>Nama</th>
              <th style="width:5%">Tipe</th>
            </tr>
          </thead>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>
  
</div>



