<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

<!-- begin:: Header Menu -->

<!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
   <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
      
   </div>
</div>
<!-- end:: Header Menu -->

<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">

   <!--begin: Notifications -->
   <div class="kt-header__topbar-item dropdown">
      <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
         <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24" />
                  <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                  <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
               </g>
            <!-- pulse if any message unread  -->
            </svg> <span class="kt-pulse__ring"></span>
         </span>

         <!--
         Use dot badge instead of animated pulse effect:
         <span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span>
         -->
      </div>
      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
         <form>
            <?php 
               $datane = get_notifikasi_helper(); 
               $counter_notif = 0;

               if($datane){
                  $counter_notif = count($datane);
               }

               // echo "<pre>";
               // print_r ($datane);
               // echo "</pre>";
               // exit;
            ?>
            <!--begin: Head -->
            <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-image: url(assets/template/assets/media/misc/bg-1.jpg)">
               <h3 class="kt-head__title">
                  Notifikasi
                  &nbsp;
                  <span class="btn btn-success btn-sm btn-bold btn-font-md"><?= $counter_notif; ?> Baru</span>
               </h3>
               <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-success kt-notification-item-padding-x" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Penjualan</a>
                  </li>
               </ul>
            </div>

            <!--end: Head -->
            <div class="tab-content">
               <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                  <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                     <?php if($datane) { ?>
                        <?php foreach ($datane as $key => $value) { ?>
                           <a href="<?= base_url('confirm_jual/detail/').$value->id; ?>" class="kt-notification__item">
                              <div class="kt-notification__item-icon">
                                 <i class="flaticon2-shopping-cart-1 kt-font-success"></i>
                              </div>
                              <div class="kt-notification__item-details">
                                 <div class="kt-notification__item-title">
                                    <?= 'Order ID : '.$value->order_id.' - '.$value->email.' ['.number_format($value->harga,0,',','.').']'; ?>
                                 </div>
                                 <div class="kt-notification__item-time">
                                    <?= timeAgo(strtotime($value->transaction_time)); ?>
                                 </div>
                              </div>
                           </a>
                        <?php } ?>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
   <!--end: Notifications -->

   <!--begin: User Bar -->
   <div class="kt-header__topbar-item kt-header__topbar-item--user">
      <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
         <div class="kt-header__topbar-user">
            <span class="kt-header__topbar-welcome kt-hidden-mobile">Selamat Datang,</span>
            <span class="kt-header__topbar-username kt-hidden-mobile"><?= $this->session->userdata('username'); ?></span>

            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?= strtoupper($this->session->userdata('username')[0]); ?></span>
         </div>
      </div>

      <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
         <!--begin: Navigation -->
         <div class="kt-notification">
            <a href="<?= base_url('/'); ?>" class="kt-notification__item">
               <div class="kt-notification__item-icon">
                  <i class="flaticon2-calendar-3 kt-font-success"></i>
               </div>
               <div class="kt-notification__item-details">
                  <div class="kt-notification__item-title kt-font-bold">
                     Profil Saya
                  </div>
                  <div class="kt-notification__item-time">
                     Pengaturan Akun dan Lainnya
                  </div>
               </div>
            </a>
            <div class="kt-notification__custom kt-space-between">
               <a href="<?= base_url('login/logout_proc'); ?>" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
            </div>
         </div>

         <!--end: Navigation -->
      </div>
   </div>

   <!--end: User Bar -->
</div>
<!-- end:: Header Topbar -->

</div>
<!-- end:: Header -->