<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Brand Ambassador - Hasilkan Ratusan Juta per Bulan.">
    <meta name="keywords" content="Brand-Ambassador-Hasilkan-Ratusan-Juta-per-Bulan.">
    <meta name="description" content="Brand Ambassador - Belajar Menjadi Teladan">
    <meta property="og:site_name" content="Brand Ambassador">
    <meta property="og:title" content="Brand Ambassador - Hasilkan Ratusan Juta per Bulan."/>
    <meta property="og:description" content="Brand Ambassador - Belajar Menjadi Teladan." />
    <meta property="og:image" itemprop="image" content="<?= base_url('assets/images/meta/meta-thumb.jpeg'); ?>"/> 
    <meta property="og:type" content="website" />

    <title>Belajar Menjadi Teladan</title>

	<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/flipdown.css'); ?>" />
    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="http://via.placeholder.com/30x30">

    <!-- Template CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/font-awesome.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/magnific-popup.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/style.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/css/skins/red.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/js/sweetalert/sweetalert.css'); ?>" />

    <!-- Revolution Slider CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/js/plugins/revolution/css/settings.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/js/plugins/revolution/css/layers.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/template/js/plugins/revolution/css/navigation.css'); ?>" />

    <!-- button css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/button-style/css/base.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/button-style/css/buttons.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/button-style/css/normalize.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/button-style/css/vicons-font.css'); ?>" />
    <style>
        .spinftw {
            border-radius: 100%;
            display: inline-block;
            height: 30px;
            width: 30px;
            top: 50%;
            position: absolute;
            -webkit-animation: loader infinite 2s;
            -moz-animation: loader infinite 2s;
            animation: loader infinite 2s;
            box-shadow: 25px 25px #3498db, -25px 25px #c0392b, -25px -25px #f1c40f, 25px -25px #27ae60;
            background-size: contain;
        }

        @-webkit-keyframes loader {
            0%,
            100% {
                box-shadow: 25px 25px #3498db, -25px 25px #c0392b, -25px -25px #f1c40f, 25px -25px #27ae60;
            }
            25% {
                box-shadow: -25px 25px #3498db, -25px -25px #c0392b, 25px -25px #f1c40f, 25px 25px #27ae60;
            }
            50% {
                box-shadow: -25px -25px #3498db, 25px -25px #c0392b, 25px 25px #f1c40f, -25px 25px #27ae60;
            }
            75% {
                box-shadow: 25px -25px #3498db, 25px 25px #c0392b, -25px 25px #f1c40f, -25px -25px #27ae60;
            }
        }

        @-moz-keyframes loader {
            0%,
            100% {
                box-shadow: 25px 25px #3498db, -25px 25px #c0392b, -25px -25px #f1c40f, 25px -25px #27ae60;
            }
            25% {
                box-shadow: -25px 25px #3498db, -25px -25px #c0392b, 25px -25px #f1c40f, 25px 25px #27ae60;
            }
            50% {
                box-shadow: -25px -25px #3498db, 25px -25px #c0392b, 25px 25px #f1c40f, -25px 25px #27ae60;
            }
            75% {
                box-shadow: 25px -25px #3498db, 25px 25px #c0392b, -25px 25px #f1c40f, -25px -25px #27ae60;
            }
        }

        @keyframes loader {
            0%,
            100% {
                box-shadow: 25px 25px #3498db, -25px 25px #c0392b, -25px -25px #f1c40f, 25px -25px #27ae60;
            }
            25% {
                box-shadow: -25px 25px #3498db, -25px -25px #c0392b, 25px -25px #f1c40f, 25px 25px #27ae60;
            }
            50% {
                box-shadow: -25px -25px #3498db, 25px -25px #c0392b, 25px 25px #f1c40f, -25px 25px #27ae60;
            }
            75% {
                box-shadow: 25px -25px #3498db, 25px 25px #c0392b, -25px 25px #f1c40f, -25px -25px #27ae60;
            }
        }

        body {
            /*padding: 80px 0;*/
        }
        #CssLoader
        {
            text-align: center;
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(49, 58, 56, 0.85);
            z-index: 9999;
        }

        /* responsive video css */
        #video-meta-content {
            width: 100%;
            height: 500px;
            margin:0;
            padding:0;
            border: 3px solid grey;
        }

        video {
            max-width: 100%;
        }
        
         #loader-payment {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            text-align: center;
            background: url('https://i.imgur.com/Cn9MC39.gif') 50% 50% no-repeat rgba(0,0,0,0.8);
            vertical-align: middle;
        color: #fff;
        
        }
        #loader-payment:before{
            content: attr(data-wordLoad);
            color: #fff;
            position: absolute;
            top: calc(50% + 150px); /* gif圖片的高度一半 */
            left: calc(50% - 90px); /* 設定文字寬度的 一半 */
                width: 180px;
                display: table-cell;
                text-align: center;
                vertical-align: middle;
            font-size: 1.5rem;
        }
        
         #lock-modal {
  display: none;
  background-color: black;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: inherit;
}

#loading-circle {
  display: none;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  width: 40px;
  height: 40px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  animation: spin 0.6s ease-in infinite;
  z-index: 9999;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
    </style>
    
    <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '1618433944985320'); 
fbq('track', 'PageView');
fbq('track', 'AddPaymentInfo');
fbq('track', 'AddToCart');
fbq('track', 'CompleteRegistration');
fbq('track', 'Contact');
fbq('track', 'Search');
fbq('track', 'ViewContent');
fbq('track', 'InitiateCheckout');
fbq('track', 'Lead');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=1618433944985320&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
    
</head>

<body>
	<!-- Preloader Starts -->
    <div class="preloader" id="preloader">
        <!--<div class="logopreloader">-->
        <!--    <img src="<?= base_url('assets/images/aily.png'); ?>" alt="logo-white">-->
        <!--</div>-->
        <div class="loader" id="loader"></div>
	</div>

	<div class="wrapper">

    <!-- *** HEADER ***
 _________________________________________________________ -->

    <?php $this->load->view('v_header'); ?>
    <!-- *** HEADER END *** -->

    
    <?php 
    if($this->uri->segment(1) == 'snap') {    
        $this->load->view('checkout_snap');    
    }elseif($this->uri->segment(1) == 'profile'){
        if($this->uri->segment(2) == 'rincian_komisi'){
            $this->load->view('v_detail_komisi'); 
        }elseif($this->uri->segment(2) == 'edit_profil'){
            $this->load->view('v_edit_profil'); 
        }else{
            $this->load->view('v_profile'); 
        }
    }elseif($this->uri->segment(1) == 'auth'){
        $this->load->view('v_auth'); 
    }else{
        $this->load->view('v_content'); 
    }
    ?>
		
<!-- _________________________________________________________ -->
    <!-- *** FOOTER *** -->
    <?php 
    if($this->uri->segment(2) == 'rincian_komisi'){
        $this->load->view('v_footer2'); 
    }else if($this->uri->segment(2) == 'edit_profil'){
        $this->load->view('v_footer2');
    }else{
        $this->load->view('v_footer');
    }
    ?>
    <!-- /#footer -->
    <!-- *** FOOTER END *** -->

    </div>
    <!-- Wrapper Ends -->

    <!-- load modal per module -->
	<?php if(isset($modal)) { $this->load->view($modal); }?>
	
	
	<!-- Template JS Files -->
	<script src="<?= base_url('assets/template/js/modernizr.js');?>"></script>
	<!-- Template JS Files -->
    <script src="<?= base_url('assets/template/js/jquery-2.2.4.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/jquery.easing.1.3.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/bootstrap.bundle.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/jquery.bxslider.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/jquery.filterizr.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/jquery.magnific-popup.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/jquery.singlePageNav.min.js');?>"></script>

    <!-- Revolution Slider Main JS Files -->
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/jquery.themepunch.tools.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/jquery.themepunch.revolution.min.js');?>"></script>

    <!-- Revolution Slider Extensions -->
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.actions.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.migration.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/plugins/revolution/js/extensions/revolution.extension.video.min.js');?>"></script>
    <script src="<?= base_url('assets/template/js/sweetalert/sweetalert.min.js');?>"></script>

     <!-- Main JS Initialization File -->
     <script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script> -->
     <script src="<?=base_url('assets/template/js/flipdown.js'); ?>"></script>
     <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<CLIENT-KEY>"></script>
    <!--<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=jKmLEIlC4jCcTP0a0U1AUF5mKEIcf9imsrfHl8jniMX3ngdhbOIFzg8SBkFj"></script></span>-->



        
	<!-- Revolution Slider Initialization Starts -->
	<script>
		(function() {
			"use strict";
			var tpj = jQuery;
			var revapi6;
			tpj(document).ready(function() {
				if (tpj("#rev_slider_6_1").revolution == undefined) {
					revslider_showDoubleJqueryError("#rev_slider_6_1");
				} else {
					revapi6 = tpj("#rev_slider_6_1").show().revolution({
						sliderType: "standard",
						jsFileLocation: "../../revolution/js/",
						sliderLayout: "fullscreen",
						dottedOverlay: "none",
						delay: 9000,
						navigation: {
							keyboardNavigation: "off",
							keyboard_direction: "horizontal",
							mouseScrollNavigation: "off",
							onHoverStop: "off",
							touch: {
								touchenabled: "on",
								swipe_threshold: 75,
								swipe_min_touches: 1,
								swipe_direction: "horizontal",
								drag_block_vertical: false
							},
							bullets: {
								enable: true,
								hide_onmobile: false,
								style: "hermes",
								hide_onleave: false,
								direction: "vertical",
								h_align: "right",
								v_align: "center",
								h_offset: 30,
								v_offset: 0,
								space: 10,
								tmp: ''
							}
						},
						responsiveLevels: [1240, 1024, 778, 480],
						gridwidth: [1024, 850, 778, 480],
						gridheight: [600, 500, 450, 400],
						lazyType: "none",
						shadow: 0,
						spinner: "off",
						stopLoop: "on",
						stopAfterLoops: 0,
						stopAtSlide: 1,
						shuffle: "off",
						autoHeight: "off",
						disableProgressBar: "on",
						hideThumbsOnMobile: "off",
						hideSliderAtLimit: 0,
						hideCaptionAtLimit: 0,
						hideAllCaptionAtLilmit: 0,
						debugMode: false,
						fallbacks: {
							simplifyAll: "off",
							nextSlideOnWindowFocus: "off",
							disableFocusListener: false,
						}
					});
				}
			});
		})(jQuery);
	</script>
    <!-- Revolution Slider Initialization Ends -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        // Unix timestamp (in seconds) to count down to
        // var unixRemaining = (new Date().getTime() / 1000) + (86400 * 2) + 1;
        var unixRemaining = (new Date().getTime() / 1000) + (90000 * 4) + 1;
        console.log(unixRemaining);
        // console.log(twoDaysFromNow);
        // Set up FlipDown
        //var flipdown = new FlipDown(unixRemaining)
        var flipdown = new FlipDown(unixRemaining,
            {
                headings: ["Dino", "Jam", "Menit", "Detik"],
            }
        )

            // Start the countdown
            .start()

            // Do something when the countdown ends
            .ifEnded(() => {
            console.log("The countdown has ended!");
            });

        // Toggle theme
        var interval = setInterval(() => {
            let body = document.body;
            body.classList.toggle("light-theme");
            body.querySelector("#flipdown").classList.toggle("flipdown__theme-dark");
            body.querySelector("#flipdown").classList.toggle("flipdown__theme-light");
        }, 5000);

        var ver = document.getElementById("ver");
        ver.innerHTML = flipdown.version;
        });
        
        function proses_checkout(){
            var form = $('#form_proses_checkout')[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?=base_url('checkout/proses_checkout')?>",
                data: data,
                dataType: "JSON",
                processData: false, // false, it prevent jQuery form transforming the data into a query string
                contentType: false, 
                cache: false,
                timeout: 600000,
                success: function (data) {
                    if(data.status) {
                        swal("Sukses", "Proses Checkout Sukses", "success");
                        $("#btn_bayar").prop("disabled", false);
                        $('#btn_bayar').text('Simpan');
                        window.location = "<?= base_url('/');?>";
                    }else {
                        swal("Gagal!!", "Proses Checkout Gagal", "danger");
                        $("#btn_bayar").prop("disabled", false);
                        $('#btn_bayar').text('Simpan');
                        window.location = "<?= base_url('/');?>";   
                    }
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                    $("#btnSave").prop("disabled", false);
                    $('#btnSave').text('Simpan');

                    reset_modal_form();
                    $(".modal").modal('hide');
                }
            });
        }
    </script>

    <script type="text/javascript">
    
    function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#div_preview_foto').css("display","block");
            $('#preview_img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        } else {
            $('#div_preview_foto').css("display","none");
            $('#preview_img').attr('src', '');
        }
    }
  
        function aksi_payment(){
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        const lockModal = $("#lock-modal");
        const loadingCircle = $("#loading-circle");
    
        var id            = $("#id").val();
        var email         = $("#email").val();
        var price         = $("#keterangan").val();
        var quantity      = 1;
        var first_name    = $("#nama_depan").val();
        var last_name     = $("#nama_belakang").val();
        var username      = $("#username").val();
        var telp          = $("#telp").val();
        var pass          = $("#password").val();
        var repass        = $("#repassword").val();
        var bank          = $("#bank").val();
        var norek         = $("#norek").val();

        $.ajax({
            method : "POST",
            url: '<?=site_url()?>/snap/token2',
            data : {
                    email: email, 
                    first_name: first_name, 
                    last_name: last_name,
                    username: username,
                    price: price, 
                    quantity: quantity, 
                    telp: telp,
                    pass: pass,
                    repass: repass,
                    bank: bank,
                    norek: norek
                    },
            cache: false,

            success: function(data) {

                
                     //location = data;
                    // if(data.status == false){
                    //     location.reload();
                    //     return;
                    // }
                    console.log('token = '+data);
                    
                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');
        
                    function changeResult(type,data){
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {
                
                        onSuccess: function(result){
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            // location.reload();
                            lockModal.css("display", "block");
                            loadingCircle.css("display", "block");
                            setTimeout(function(){
                                lockModal.css("display", "none");
                                loadingCircle.css("display", "none");
                                $("#payment-form").submit();
                            }, 20000);
                        },
                        onPending: function(result){
                            changeResult('pending', result);
                            console.log(result.status_message);
                            // location.reload();
                            lockModal.css("display", "block");
                            loadingCircle.css("display", "block");
                            setTimeout(function(){
                                lockModal.css("display", "none");
                                loadingCircle.css("display", "none");
                                $("#payment-form").submit();
                            }, 20000);
                        },
                        onError: function(result){
                            changeResult('error', result);
                            console.log(result.status_message);
                            // location.reload();
                            lockModal.css("display", "block");
                            loadingCircle.css("display", "block");
                            setTimeout(function(){
                                lockModal.css("display", "none");
                                loadingCircle.css("display", "none");
                                $("#payment-form").submit();
                            }, 20000);
                        }
                        
                    });
               
               
            },
            statusCode: {
                303: function() {
                   location.reload();
                }
            }
        });
    }
    
    function aksi_transfer()
    {
        var form = $('#form_proses_transfer')[0];
        var data = new FormData(form);

        $("#pay-button").prop("disabled", true);
        $('#pay-button').text('Menyimpan Data'); //change button text
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?=base_url('snap/trans_manual')?>",
            data: data,
            dataType: "JSON",
            processData: false, // false, it prevent jQuery form transforming the data into a query string
            contentType: false, 
            cache: false,
            timeout: 600000,
            success: function (data) {
                if(data.status) {
                    swal("Sukses!!", "Pembayaran Transfer Berhasil", "success");
                    $("#pay-button").prop("disabled", false);
                    $('#pay-button').text('Proses Data Pembayaran');
                    window.location = data.redirect;
                }else {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        if (data.inputerror[i] != 'pegawai') {
                            $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                        }else{
                            //ikut style global
                            $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                        }
                    }

                    $("#pay-button").prop("disabled", false);
                    $('#pay-button').text('Proses Data Pembayaran');
                }
            },
            error: function (e) {
                console.log("ERROR : ", e);
                $("#pay-button").prop("disabled", false);
                $('#pay-button').text('Proses Data Pembayaran');

                reset_modal_form();
                $(".modal").modal('hide');
            }
        });
    }
    
    function prosesKlaim() {
		swal({
			title: "Tarik Komisi",
			text: "Anda Yakin Ingin Melakukan Penarikan Komisi ?? ",
			icon: "warning",
			buttons: [
				'Tidak',
				'Ya'
			],
			//dangerMode: true,
		}).then(function(isConfirm) {
			if (isConfirm) {
				$.ajax({
                    url: "<?=base_url('profile/tarik_komisi')?>",
					type: 'POST',
					dataType: "JSON",
					success: function(data) {
						if (data.status) {
							swal("Sukses, Komisi kode : " + data.kode_klaim + "", 'Selengkapnya bisa diihat pada rincian Penarikan', "success").then(function() {
								location.reload(true);
							});
						} else {
							swal("Gagal", data.pesan, "error").then(function() {
								location.reload(true);
							});
						}
					}
				});
			} else {
				swal("Batal", "Aksi dibatalkan", "error");
			}
		});
    }

    function update_profile(){
        swal({
			title: "Update Profile",
			text: "Anda Yakin Ingin Melakukan Update Profile ?? ",
			icon: "warning",
			buttons: [
				'Tidak',
				'Ya'
			],
			//dangerMode: true,
		}).then(function(isConfirm) {
			if (isConfirm) {
                var form = $('#form_update_profil')[0];
                var data = new FormData(form);
				$.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "<?=base_url('profile/update_profile')?>",
                    data: data,
                    dataType: "JSON",
                    processData: false, // false, it prevent jQuery form transforming the data into a query string
                    contentType: false, 
                    cache: false,
                    timeout: 600000,
					success: function(data) {
						if (data.status) {
							swal("Sukses", 'Sukses Update Profile', "success").then(function() {
								window.location = data.redirect;
							});
						} else {
							for (var i = 0; i < data.inputerror.length; i++) 
                            {
                                if (data.inputerror[i] != 'pegawai') {
                                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback'); //select span help-block class set text error string
                                }else{
                                    //ikut style global
                                    $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                                }
                            }
						}
					}
				});
			} else {
				swal("Batal", "Aksi dibatalkan", "error");
			}
		});
    }

    function lihatBukti(imgfile, kodeVerify) {
		var urlBukti = "<?=base_url();?>"+imgfile;
		$('#modalBukti').modal('show');
		$('#imageArea').attr('src', urlBukti);
		$('#judul').text('Bukti Transfer Kode  : '+kodeVerify);
	}

    
    $('.tombol_method_bayar').click(function (e) { 
        e.preventDefault();
        
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#main-form-bayar").offset().top-50
        }, 2000);
        
        var file_inc = $(this).attr("href");
        $.ajax({
            type: "get",
            url: "<?=base_url('snap/get_html_form')?>",
            data: {file_inc:file_inc},
            dataType: "json",
            success: function (response) {
                $('#main-form-bayar').html(response);
            }
        });
    });

    $('#ceklistpwd').change(function() {
        if (this.checked) {
            $('#password').attr('readonly', true).css('background-color', "#8a8991");
            $('#repassword').attr('readonly', true).css('background-color', "#8a8991");
            $('#password_lama').attr('readonly', true).css('background-color', "#8a8991");
        } else {
            $('#password').attr('readonly', false).css('background-color', "#e8f0fe");
            $('#repassword').attr('readonly', false).css('background-color', "#e8f0fe");
            $('#password_lama').attr('readonly', false).css('background-color', "#e8f0fe");

        }
    });

    </script>
        
    <!-- load js per modul -->
    <?php if(isset($js)) { $this->load->view($js); }?>
    
</body>

</html>