<style>


.wrap {
  position: absolute;
  bottom: 0;
  top: 0;
  left: 0;
  right: 0;
  margin: auto;
  height: 310px;
}

a {
  text-decoration: none;
  color: #1a1a1a;
}

/*h1 {*/
/*  margin-bottom: 60px;*/
/*  text-align: center;*/
/*  font: 300 2.25em "Lato";*/
/*  text-transform: uppercase;*/
/*}*/
/*h1 strong {*/
/*  font-weight: 400;*/
/*  color: #ea4c4c;*/
/*}*/

/*h2 {*/
/*  margin-bottom: 80px;*/
/*  text-align: center;*/
/*  font: 300 0.7em "Lato";*/
/*  text-transform: uppercase;*/
/*}*/
/*h2 strong {*/
/*  font-weight: 400;*/
/*}*/

.countdown {
  width: 720px;
  margin: 0 auto;
}
.countdown .bloc-time {
  float: left;
  margin-right: 45px;
  text-align: center;
}
.countdown .bloc-time:last-child {
  margin-right: 0;
}
.countdown .count-title {
  display: block;
  margin-bottom: 15px;
  font: normal 0.94em "Lato";
  color: #1a1a1a;
  text-transform: uppercase;
}
.countdown .figure {
  position: relative;
  float: left;
  height: 110px;
  width: 100px;
  margin-right: 10px;
  background-color: #fff;
  border-radius: 8px;
  -moz-box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2), inset 2px 4px 0 0 rgba(255, 255, 255, 0.08);
  -webkit-box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2), inset 2px 4px 0 0 rgba(255, 255, 255, 0.08);
  box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.2), inset 2px 4px 0 0 rgba(255, 255, 255, 0.08);
}
.countdown .figure:last-child {
  margin-right: 0;
}
.countdown .figure > span {
  position: absolute;
  left: 0;
  right: 0;
  margin: auto;
  font: normal 5.94em/107px "Lato";
  font-weight: 700;
  color: #de4848;
}
.countdown .figure .top:after,
.countdown .figure .bottom-back:after {
  content: "";
  position: absolute;
  z-index: -1;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.countdown .figure .top {
  z-index: 3;
  background-color: #f7f7f7;
  transform-origin: 50% 100%;
  -webkit-transform-origin: 50% 100%;
  -moz-border-radius-topleft: 10px;
  -webkit-border-top-left-radius: 10px;
  border-top-left-radius: 10px;
  -moz-border-radius-topright: 10px;
  -webkit-border-top-right-radius: 10px;
  border-top-right-radius: 10px;
  -moz-transform: perspective(200px);
  -ms-transform: perspective(200px);
  -webkit-transform: perspective(200px);
  transform: perspective(200px);
}
.countdown .figure .bottom {
  z-index: 1;
}
.countdown .figure .bottom:before {
  content: "";
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 50%;
  background-color: rgba(0, 0, 0, 0.02);
}
.countdown .figure .bottom-back {
  z-index: 2;
  top: 0;
  height: 50%;
  overflow: hidden;
  background-color: #f7f7f7;
  -moz-border-radius-topleft: 10px;
  -webkit-border-top-left-radius: 10px;
  border-top-left-radius: 10px;
  -moz-border-radius-topright: 10px;
  -webkit-border-top-right-radius: 10px;
  border-top-right-radius: 10px;
}
.countdown .figure .bottom-back span {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  margin: auto;
}
.countdown .figure .top,
.countdown .figure .top-back {
  height: 50%;
  overflow: hidden;
  -moz-backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.countdown .figure .top-back {
  z-index: 4;
  bottom: 0;
  background-color: #fff;
  -webkit-transform-origin: 50% 0;
  transform-origin: 50% 0;
  -moz-transform: perspective(200px) rotateX(180deg);
  -ms-transform: perspective(200px) rotateX(180deg);
  -webkit-transform: perspective(200px) rotateX(180deg);
  transform: perspective(200px) rotateX(180deg);
  -moz-border-radius-bottomleft: 10px;
  -webkit-border-bottom-left-radius: 10px;
  border-bottom-left-radius: 10px;
  -moz-border-radius-bottomright: 10px;
  -webkit-border-bottom-right-radius: 10px;
  border-bottom-right-radius: 10px;
}
.countdown .figure .top-back span {
  position: absolute;
  top: -100%;
  left: 0;
  right: 0;
  margin: auto;
}

     .gallery {
                margin: -16px -25px 43px;
                display: flex;
                flex-wrap: wrap;
                padding-right: 30px;
            }

            .gallery .gallery-item {
                padding: 0 12px;
                margin-top: 10px;
                margin-bottom: 0
            }

            .gallery.gallery-columns-2 .gallery-item {
                width: 50%
            }

            .gallery.gallery-columns-3 .gallery-item {
                width: 33.33%
            }

            .gallery.gallery-columns-4 .gallery-item {
                width: 25%
            }

            .gallery.gallery-columns-5 .gallery-item {
                width: 20%
            }

            .widget_media_gallery .gallery-item {
                padding: 0 5px;
                margin-top: 10px;
                margin-bottom: 0
            }

            .widget_media_gallery .gallery {
                margin: -10px -5px 0
            }

            @media (min-width: 768px) {

                .foto {
                    display: none;
                }

            }

            @media (max-width: 768px) {
                .slotholder {
                    height: 50%!important;
                }

                .mainslider {
                    height: 300px!important;
                }

                .foto {
                    display: block;
                }
                
                 .foto-talent {
                    display: none;
                }
                
                .hermes {
                    top:25%!important;
                }


            }

figure img {
    width: auto;
    height: auto;
    max-width: 100%;
    max-height: 100%;
}

.img-tombol {
    width: auto;
    height: auto;
    max-width: 100%;
    max-height: 90%;
}

video {
    max-width: 100%;
}
</style>
<!-- Main Slider Section Starts -->
        <section class="mainslider" id="mainslider">
            <article class="content">
                <div id="rev_slider_6_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                    <ul>
                        <!-- SLIDE  -->
                        <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="<?php echo base_url();?>assets/images/content-tabs1.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="WE ARE SALIMOOO" data-param1="May 24, 2015" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="<?php echo base_url();?>assets/images/Slider1a.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-24-layer-6" data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']" data-y="['top','top','top','top']" data-voffset="['250','250','250','250']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeIn;s:1000;e:Power2.easeIn;" data-start="500" data-splitin="chars" data-splitout="none" data-basealign="slide" data-responsive_offset="on" data-elementdelay="0.03" style="z-index: 5; white-space: nowrap; font-size: 40px; line-height: 40px; color:yellow!important;">SARAS DAVINA
                            </div>
                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption Photography-Textblock   tp-resizeme" id="slide-24-layer-8" data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']" data-y="['top','top','top','top']" data-voffset="['320','320','320','320']" data-width="350" data-height="150" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeIn;s:1000;e:Power2.easeIn;" data-start="500" data-splitin="chars" data-splitout="none" data-basealign="slide" data-responsive_offset="on" data-elementdelay="0.01" style="z-index: 7; min-width: 350px; max-width: 350px; max-width: 150px; max-width: 150px; white-space: normal; font-size: 15px; line-height: 20px; color:yellow!important;"><strong>Milenial Sensual</strong> yang <strong>Meledakkan Bisnis Anda,</strong> mengajarkan Ilmu Algoritma untuk Bisnis.
                            </div>
                            <!-- LAYER NR. 3 -->
                            <!-- <div class="tp-caption" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['180','97','90','90']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);" data-transform_in="y:100px;sX:1;sY:1;opacity:0;s:2000;e:Power3.easeInOut;" data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" data-start="750" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 11; white-space: nowrap;text-transform:left;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;"><a href="#about" class="custom-button slider-button scroll-to-target">learn more about us</a></div> -->
                        </li>
                        <!-- SLIDE  -->
                        <li data-index="rs-2" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="img/revolution-slider/content-tabs/thumb1.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="WE ARE CREATIVE" data-param1="May 24, 2015" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="<?php echo base_url();?>assets/images/Slider2a.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-24-layer-66" data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']" data-y="['top','top','top','top']" data-voffset="['250','250','250','250']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeIn;s:1000;e:Power2.easeIn;" data-start="500" data-splitin="chars" data-splitout="none" data-basealign="slide" data-responsive_offset="on" data-elementdelay="0.03" style="z-index: 5; white-space: nowrap; font-size: 40px; line-height: 40px; color:yellow!important;">SARAS DAVINA
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption Photography-Textblock   tp-resizeme" id="slide-24-layer-88" data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']" data-y="['top','top','top','top']" data-voffset="['320','320','320','320']" data-width="350" data-height="150" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeIn;s:1000;e:Power2.easeIn;" data-start="500" data-splitin="chars" data-splitout="none" data-basealign="slide" data-responsive_offset="on" data-elementdelay="0.01" style="z-index: 7; min-width: 350px; max-width: 350px; max-width: 150px; max-width: 150px; white-space: normal; font-size: 15px; line-height: 25px;">Milenial Sensual yang <strong>Meledakkan Bisnis Anda, mengajarkan Ilmu Algoritma untuk Bisnis</strong>
                            </div>
                            <!-- LAYER NR. 3 -->
                            <!-- <div class="tp-caption" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['180','97','90','90']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);" data-transform_in="y:100px;sX:1;sY:1;opacity:0;s:2000;e:Power3.easeInOut;" data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" data-start="750" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 11; white-space: nowrap;text-transform:left;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;"><a href="#about" class="custom-button slider-button scroll-to-target">learn more about us</a></div> -->
                        </li>
                        <!-- SLIDE  -->
                        <li data-index="rs-3" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="img/revolution-slider/content-tabs/thumb1.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="WE ARE LEADERS" data-param1="May 24, 2015" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="<?php echo base_url();?>assets/images/Slider4.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-24-layer-666" data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']" data-y="['top','top','top','top']" data-voffset="['250','250','250','250']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeIn;s:1000;e:Power2.easeIn;" data-start="500" data-splitin="chars" data-splitout="none" data-basealign="slide" data-responsive_offset="on" data-elementdelay="0.03" style="z-index: 5; white-space: nowrap; font-size: 40px; line-height: 40px; color:yellow!important;">SARAS DAVINA
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption Photography-Textblock   tp-resizeme" id="slide-24-layer-888" data-x="['left','left','left','left']" data-hoffset="['50','50','50','50']" data-y="['top','top','top','top']" data-voffset="['320','320','320','320']" data-width="350" data-height="150" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeIn;s:1000;e:Power2.easeIn;" data-start="500" data-splitin="chars" data-splitout="none" data-basealign="slide" data-responsive_offset="on" data-elementdelay="0.01" style="z-index: 7; min-width: 350px; max-width: 350px; max-width: 150px; max-width: 150px; white-space: normal; font-size: 15px; line-height: 25px;">Milenial Sensual yang <strong>Meledakkan Bisnis Anda, mengajarkan Ilmu Algoritma untuk Bisnis</strong>
                            </div>
                            <!-- LAYER NR. 3 -->
                            <!-- <div class="tp-caption" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['180','97','90','90']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);" data-transform_in="y:100px;sX:1;sY:1;opacity:0;s:2000;e:Power3.easeInOut;" data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" data-start="750" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 11; white-space: nowrap;text-transform:left;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;"><a href="#about" class="custom-button slider-button scroll-to-target">learn more about us</a></div> -->
                        </li>
                    </ul>
                    <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                </div>
                <!-- END REVOLUTION SLIDER -->
                <script type="text/javascript">
                </script>
            </article>
        </section>
        <!-- Main Slider Section Ends -->
        
        <!-- About Section Starts -->
        <section id="about" class="about" style="background-image: url('assets/images/pink6.jpg');background-repeat: no-repeat;
  background-size: 1400px 1600px;">
            <!-- Container Starts -->
            <div class="container">
                <!-- Main Heading Starts -->
                <div class="text-center top-text" style="margin-bottom:-80px;">
                    <p style="font-size:24px; font-family:arial; color:blue; line-height:24px;"><strong>Akibat pandemi, orang terbiasa berjauhan, sehingga bisnis pun harus berjauhan, karena itu anda harus punya Bisnis Online, tidak bisa hanya Bisnis Offline.<br><br><span style="font-size:24px; font-family:arial; color:black; line-height:20px;">7 milyar umat manusia di dunia perlu mencari uang, karena itu sebaiknya anda secepatnya perlu punya Bisnis Online.</span></strong><br><br><span style="font-size:24px; font-family:arial; color:indigo; line-height:24px;">Agar bisnis online anda bisa Meledak, <strong>maka membutuhkan Ilmu Algoritma Instagram</strong></span></p>
                    <br><br>
                    <p style="font-size:18px; font-family: arial; color: black; line-height:20px;"><strong>PENDERITAAN JIKA TIDAK MENGUASAI <br> ILMU ALGORITMA INSTAGRAM</p>
                    <p style="font-size:14px; font-family: arial; color: yellow; line-height:20px;"><strong>Fakta-faktanya sudah sering kita lihat, antara lain:</strong></p>
                             <table width="90%" style="margin-left:20px!important;">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: baseline;">1.</td>
                                        <td style="text-align:justify">Merek / bisnis yang sudah besar saja seperti Pizza Hut, KFC pun harus <span style=color:blue;><strong>rela turun ke jalan untuk jualan,</strong></span> apalagi merek yang masih kecil dan belum dikenal luas oleh masyarakat.</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: baseline;">2.</td>
                                        <td style="text-align:justify"><span style=color:blue;><strong>Produk tidak meledak,</strong></span> yang membeli hanya kenalan-kenalan sendiri saja, bukan masyarakat luas, akibat cara promosi kita hanya sedangkal mengupload foto-foto, post-post ke medsos kita dan teman. Padahal Ilmu Instagram Algoritma jauh lebih dalam daripada itu.</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: baseline;">3.</td>
                                        <td style="text-align:justify">Jika promosi dengan broadcast-broadcast  di whatsapp, <span style=color:blue;><strong>hanya sedikit yang mau menyebarkan,</strong></span> kalau pun banyak maka akan diblokir FB karena  dianggap mengganggu. Ingat Whatsapp miliknya Facebook.</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: baseline;">4.</td>
                                        <td style="text-align:justify">Akibatnya mengandalkan Giveaway yaitu memberi produk gratisan untuk orang mencoba. <span style=color:blue;><strong>Malah tekor, kuat sampai kapan seperti itu ?</strong></span></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: baseline;">5.</td>
                                        <td style="text-align:justify"><span style=color:blue;><strong>Tidak jago menghasilkan uang</strong></span> karena tidak punya Bisnis Online atau Bisnis Online tidak meledak akibat tidak menguasai ilmu Instagram Algoritma.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
            </div>
            <!-- Container Ends -->
        </section>
        <!-- About Section Ends -->

        <!-- Project Manager Section Starts -->
        <section class="projectmanager" id="projectmanager">
            <!-- Section Overlay Starts -->
            <div class="section-overlay">
                <!-- Container Starts -->
                <div class="container" style="margin-bottom:-80px; margin-top:-120px;">
                    <div class="row">
                        <!-- Image Starts -->
                        <!--<div class="col-md-12 col-lg-12 col-xl-5">
                            <img class="img-fluid projectmanagerpicture" src="<?php echo base_url();?>assets/images/projectmanager.jpg" alt="project manager">
                        </div>-->
                        <!-- Image Ends -->
                        <!-- Details Starts -->
                        <div class="col-md-12 col-lg-12 col-xl-12 offset-xl-1">
                            <div class="text-center top-text">
                            
                    <p style="font-size:20px; font-family: arial; color: Yellow; line-height:22px;"><strong>Kalau tidak menguasai Ilmu Algoritma Instagram,</strong></span> maka Bisnis anda tidak meledak.</p>
                    <p style="font-size:20px; font-family: arial; color:orchid; line-height:22px;"><strong>Ayo "Pacaran" dengan Saras Davina, <span style="color:white;">LIVE</span></strong> <span style="font-size:20px; font-family: arial; color:orange; line-height:22px;">yaitu nyetrum belajar Ilmu Algoritma Instagram untuk Bisnis.</span></p>
                    <p style="font-size:18px; line-height:20px; text-align:left;">Saras Davina adalah milenial atraktif, sensual, cerdas yang mengajarkan Ilmu Algoritma Instagram.<br><br>Mulai dari nol sampai yang canggih, Saras akan mengajari anda sebagaimana Saras terbiasa membimbing 180 RIBU followersnya.</p>
                    
                    <p style="font-size:18px; text-align:left; color:White;">"Pacarannya" ada 2 macam :</p>
                    <table width="90%" style="margin-left:20px!important;">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align:baseline; font-size:20px;">1.</td>
                                        <td style="text-align:justify; font-size:20px;">Pertemuan/kelas <span style=color:yellow;><strong>Ramai-ramai.</strong></span></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:baseline; font-size:20px;">2.</td>
                                        <td style="text-align:justify; font-size:20px;">Pertemuan/kelas <span style=color:red;><strong>Lebih Privat.</strong></span></td>
                                    </tr>
                                </tbody>
                            </table>
                    <!--<p style="font-size:18px;">1. Pertemuan/kelas <span style=color:orange;><strong>Ramai-ramai.</strong></span></p>-->
                    <!--<p style="font-size:18px;">2. Pertemuan/kelas <span style=color:red;><strong>Lebih Privat.</strong></span></p>-->
                    
                    
                </div>
                            <!--<h1>Ayo Pacaran dengan Saras Davina, kalau tidak pacaran mana mungkin bisnis anda bisa Meledak </h1>-->
                            <!--<h2>PENDERITAAN JIKA TIDAK MENGUASAI <br> ILMU ALGORITMA INSTAGRAM</h2>-->
                            <!--<p style="font-size:20px; font-family: arial; color: white; line-height:26px;"><strong>PENDERITAAN JIKA TIDAK MENGUASAI <br> ILMU ALGORITMA INSTAGRAM</p>-->
                            
                            <!--<p style="font-size:14px; font-family: arial; color: yellow; line-height:20px;"><strong>Fakta-faktanya sudah sering kita lihat, antara lain:</strong></p>-->
                             <!--<table width="90%" style="margin-left:20px!important;">
                                <tbody>-->
                                    <!--<tr>
                                        <td style="vertical-align: baseline;">1.</td>
                                        <td style="text-align:justify">Merek / bisnis yang sudah besar saja seperti Pizza Hut, KFC pun harus rela turun ke jalan untuk jualan, apalagi merek yang masih kecil dan belum dikenal luas oleh masyarakat.</td>
                                    </tr>-->
                                    <!--<tr>
                                        <td style="vertical-align: baseline;">2.</td>
                                        <td style="text-align:justify">Produk tidak meledak, yang membeli hanya kenalan-kenalan sendiri saja, bukan masyarakat luas, akibat cara promosi kita hanya sedangkal mengupload foto-foto, post-post ke medsos kita dan teman. Padahal Ilmu Instagram Algoritma jauh lebih dalam daripada itu.</td>
                                    </tr>-->
                                    <!--<tr>
                                        <td style="vertical-align: baseline;">3.</td>
                                        <td style="text-align:justify">Jika promosi dengan broadcast-broadcast  di whatsapp, hanya sedikit yang mau menyebarkan, kalau pun banyak maka akan diblokir FB karena  dianggap mengganggu. Ingat Whatsapp miliknya Facebook.</td>
                                    </tr>-->
                                    <!--<tr>
                                        <td style="vertical-align: baseline;">4.</td>
                                        <td style="text-align:justify">Akibatnya mengandalkan Giveaway yaitu memberi produk gratisan untuk orang mencoba. Malah tekor, kuat sampai kapan seperti itu ?</td>
                                    </tr>-->
                                    <!--<tr>
                                        <td style="vertical-align: baseline;">5.</td>
                                        <td style="text-align:justify">Tidak jago menghasilkan uang karena tidak punya Bisnis Online atau Bisnis Online tidak meledak akibat tidak menguasai ilmu Instagram Algoritma.</td>
                                    </tr>-->
                                    <!--<tr>
                                        <td>&nbsp;</td>
                                        <td style="text-align:justify">Ayo Pacaran dgn Saras Davina, kl tidak pacaran mana mungkin bisnis anda bisa Meledak
                                    </td>
                                    </tr>-->
                                </tbody>
                            </table>
                            <!--<h3>1. Pertemuan / kelas Bersama</h3>-->
                            <!--<h3>2. Pertemuan / kelas Personal</h3>-->
                             <!--<p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus obcaecati pariatur officiis molestias eveniet harum laudantium sed optio iste. Iste, alias, non libero recusandae fugiat praesentium delectus inventore accusamus veniam!
                            </p>-->
                            <!-- <blockquote>
                                " Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia "
                            </blockquote> -->
                            <!-- Social Media Starts -->
                            <!-- <div class="social-icons">
                                <ul class="social">
                                    <li>
                                        <a class="twitter" href="#" title="twitter"></a>
                                    </li>
                                    <li>
                                        <a class="facebook" href="#" title="facebook"></a>
                                    </li>
                                    <li>
                                        <a class="skype" href="#" title="skype"></a>
                                    </li>
                                    <li>
                                        <a class="instagram" href="#" title="instagram"></a>
                                    </li>
                                    <li>
                                        <a class="linkedin" href="#" title="linkedin"></a>
                                    </li>
                                    <li>
                                        <a class="youtube" href="#" title="youtube"></a>
                                    </li>
                                </ul>
                            </div> -->
                            <!-- Social Media Ends -->
                        </div>
                    </div>
                    <!-- Details Ends -->
                </div>
                <!-- Container Ends -->
            </div>
        </section>
        <!-- Project Manager Section Ends -->
        
        
                <!-- About Content Starts -->
    <!-- Team Section Starts -->
        <section id="team" class="team">
            <!-- Container Starts -->
            <div class="container">
                <!-- Main Heading Starts -->
                <!--<div class="text-center top-text">
                    <h1><span>Our</span> Gallery</h1>
                    <h4>Keep in touch</h4>
                </div>-->
                <!-- Main Heading Ends -->
                <!-- Divider Starts -->
                <!--<div class="divider text-center">
                    <span class="outer-line"></span>
                    <span class="fa fa-users" aria-hidden="true"></span>
                    <span class="outer-line"></span>
                </div>-->
                <!-- Divider Ends -->
                <!-- Team Members Starts -->
                <div class="row team-members magnific-popup-gallery foto-talent">
                    <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar1.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar2.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar3.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar4.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar5.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar6.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar10.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar8.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                                        <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar12.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Maryana Mori</h4>
                                <p>Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Starts -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                    <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar9.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Marco Verratti</h4>
                                <p>Co Founder</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Ends -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                    <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <!-- Team Member-->
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar7.jpg" alt=""></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Emilia Bella</h4>
                                <p>Sales Manager</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Ends -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                    <!-- Team Member Starts -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar11.jpg" alt="team member"></a>
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <!--<div class="team-member-caption social-icons">
                                <h4>Antonio Conte</h4>
                                <p>Director</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <!-- Team Member Details Ends -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                </div>
                <!-- Team Members Ends -->
                 <!-- Gallery Start -->
                <div class="col-md-4 foto" style="margin-bottom:-120px; margin-top:-70px;">
                    <div id="gallery-1" class="gallery galleryid-7 gallery-columns-3 gallery-size-full" style="padding-right: 0px;">
                        <figure class="gallery-item">
                            <div class="gallery-icon landscape">
                                <a href="assets/images/gambar1.jpg"><img src="<?php echo base_url();?>assets/images/gambar1.jpg" class="attachment-full size-full" alt=""></a>
                            </div>
                        </figure>
                        <figure class="gallery-item">
                            <div class="gallery-icon landscape">
                                <a href="assets/images/gambar2.jpg"><img src="<?php echo base_url();?>assets/images/gambar2.jpg" class="attachment-full size-full" alt=""></a>
                            </div>
                        </figure>
                        <figure class="gallery-item">
                            <div class="gallery-icon landscape">
                                <a href="assets/images/gambar3.jpg"><img src="<?php echo base_url();?>assets/images/gambar3.jpg" class="attachment-full size-full" alt=""></a>
                            </div>
                        </figure> 
                        <figure class="gallery-item">
                        <div class="gallery-icon landscape">
                            <a href="assets/images/gambar4.jpg"><img src="<?php echo base_url();?>assets/images/gambar4.jpg" class="attachment-full size-full" alt=""></a>
                        </div></figure><figure class="gallery-item">
                        <div class="gallery-icon landscape">
                            <a href="assets/images/gambar5.jpg"><img src="<?php echo base_url();?>assets/images/gambar5.jpg" class="attachment-full size-full" alt="" ></a>
                        </div></figure><figure class="gallery-item">
                            <div class="gallery-icon landscape">
                            <a href="assets/images/gambar6.jpg"><img src="<?php echo base_url();?>assets/images/gambar6.jpg" class="attachment-full size-full" alt="" ></a>
                        </div></figure><figure class="gallery-item">
                            <div class="gallery-icon landscape">
                            <a href="assets/images/gambar10.jpg"><img src="<?php echo base_url();?>assets/images/gambar10.jpg" class="attachment-full size-full" alt="" ></a>
                        </div></figure><figure class="gallery-item">
                            <div class="gallery-icon landscape">
                            <a href="assets/images/gambar8.jpg"><img src="<?php echo base_url();?>assets/images/gambar8.jpg" class="attachment-full size-full" alt="" ></a>
                        </div></figure><figure class="gallery-item">
                            <div class="gallery-icon landscape">
                            <a href="assets/images/gambar12.jpg"><img src="<?php echo base_url();?>assets/images/gambar12.jpg" class="attachment-full size-full" alt="" ></a>
                        </div></figure><figure class="gallery-item">
                            <div class="gallery-icon landscape">
                            <a href="assets/images/gambar9.jpg"><img src="<?php echo base_url();?>assets/images/gambar9.jpg" class="attachment-full size-full" alt="" ></a>
                        </div></figure><figure class="gallery-item">
                            <div class="gallery-icon landscape">
                            <a href="assets/images/gambar7.jpg"><img src="<?php echo base_url();?>assets/images/gambar7.jpg" class="attachment-full size-full" alt="" ></a>
                        </div></figure><figure class="gallery-item">
                        <div class="gallery-icon landscape">
                            <a href="assets/images/gambar11.jpg"><img src="<?php echo base_url();?>assets/images/gambar11.jpg" class="attachment-full size-full" alt=""></a>
                        </div></figure>
                    </div>
                </div>
                <!-- Gallery Ends -->
            </div>
            <!-- Container Ends -->
        </section>
        <!-- Team Section Ends -->
        

        <!-- Testimonials Section Starts -->
        <section class="videopromotion">
            <div class="section-overlay">
                <!-- Container Starts -->
                <div class="container">
                    <!-- Main Heading Starts -->
                    <div class="text-center top-text">
                        <h1><span>Video</span> Saras Davina</h1>
                    </div>
                    <!-- Main Heading Starts -->
                    <!-- Blockquotes Starts -->
                    <div class="video-content" style="text-align:center;">
                        <video width="720" height="480" controls>
                            <source src="<?=base_url('files/img/talent_img/1/video_talent.mp4');?>" type=video/mp4>
                        </video>
                    </div>
                    <!-- Blockquotes Ends -->
                </div>
                <!-- Container Ends -->
            </div>
        </section>
        <!-- Testimonials Section Ends -->

        <!-- Portfolio Section Starts -->
        <section id="portfolio" class="portfolio" style="background-image: url('assets/images/ice2.jpg');background-repeat: no-repeat;
  background-size: 1350px 1700px;">
            <!-- Container Starts -->
            <div class="container" style="margin-bottom:-60px;">
                <!-- Main Heading Starts -->
                <div class="text-center top-text">
                  <p style="font-size:24px; font-family: arial; color: Red; line-height:26px;"><span style="font-size:24px; font-family: arial; color: blue;"><strong>Kalau tidak menguasai Ilmu Algoritma Instagram,</strong></span> maka Bisnis anda tidak meledak.</p>
                    <p style="font-size:20px; font-family: arial; color:orchid; line-height:22px;"><strong>Ayo "Pacaran" dengan Saras Davina, <span style="color:blue;">LIVE</span></strong> <span style="font-size:20px; font-family: arial; color:darkslategray; line-height:22px;">yaitu nyetrum belajar Ilmu Algoritma Instagram untuk Bisnis.</span></p>
                    <p style="font-size:20px; font-family: arial; color:blue; line-height:22px;"><strong>Harga di bawah hanya untuk masa promosi.</strong> <br><span style="font-size:20px; font-family: arial; color:darkslategray; line-height:22px;">Anda hanya memiliki waktu 2 hari, setelah timer kembali ke angka 0, maka harga akan kembali Normal.</span></p>
                    
                </div>
                
                <!-- Main Heading Starts -->
                <!-- Divider Starts -->
                <!-- <div class="divider text-center">
                    <span class="outer-line"></span>
                    <span class="fa fa-image" aria-hidden="true"></span>
                    <span class="outer-line"></span>
                </div>
                <!-- Divider Ends -->
                <!-- Filter Wrapper Starts -->
                <div class="fact-badges text-center top-text">
                        
                            <div class="flipcountercss" align="center">
                                <h1>Buruan Pesan Sekarang</h1>
                                <div id="flipdown" class="flipdown"></div>
                            </div>
                      
                    <div align="center" style="position:relative;top:30px;">
                        <div class="col-md-12 row no-gutters" align="center">
                            <div class="col-sm-6">
                                <a href="<?= base_url('/');?>">
                                    <img src="<?php echo base_url();?>assets/images/T 400rb.png" class="img-tombol">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="<?= base_url('/');?>">
                                    <img src="<?php echo base_url();?>assets/images/T 1Jt.png" class="img-tombol">
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                
                <div class="row team-members magnific-popup-gallery">
                    <!-- Team Member Starts -->
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url();?>assets/images/gambar1.jpg" alt="team member"></a>
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                </div>
                <br>
                <p style="font-size:24px; font-family: arial; color: Red; line-height:26px;"><strong><span style="color:blue;">Jadwal LIVE</span> langsung diberikan kepada anda, setelah anda transfer.</strong></p>
                </div>
                <!-- Filter Wrapper Ends -->
                <div>
                    <div class="filtr-container">
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="1">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap" href="http://via.placeholder.com/700x470" data-gal="magnific-pop-up[image]" title="Image project"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-1.jpg" alt="Image Project" /><span class="zoom-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Single Image</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="2">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap mfp-youtube" href="https://www.youtube.com/watch?v=0gv7OC9L2s8"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-2.jpg" alt="Gallery project" /><span class="zoom-icon video-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Youtube Video</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="1">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap" href="http://via.placeholder.com/700x470" data-gal="magnific-pop-up[gallery]" title="Gallery project"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-3.jpg" alt="Gallery project" /><span class="zoom-icon gallery-icon"></span></a>
                                </figure>
                                <a href="http://via.placeholder.com/700x470" title="Gallery project" data-gal="magnific-pop-up[gallery]" style="display:none;"></a>
                                <a href="http://via.placeholder.com/700x470" title="Gallery project" data-gal="magnific-pop-up[gallery]" style="display:none;"></a>
                                <a href="http://via.placeholder.com/700x470" title="Gallery project" data-gal="magnific-pop-up[gallery]" style="display:none;"></a>
                                <a href="http://via.placeholder.com/700x470" title="Gallery project" data-gal="magnific-pop-up[gallery]" style="display:none;"></a>
                                <a href="http://via.placeholder.com/700x470" title="Gallery project" data-gal="magnific-pop-up[gallery]" style="display:none;"></a>
                                <a href="http://via.placeholder.com/700x470" title="Gallery project" data-gal="magnific-pop-up[gallery]" style="display:none;"></a>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Gallery Photos</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="3">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap" href="#" title="portfolio"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-4.jpg" alt="portfolio" /><span class="zoom-icon external-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>External Link</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="1">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap" href="http://via.placeholder.com/700x470" data-gal="magnific-pop-up[image]" title="Image project"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-5.jpg" alt="Image Project" /><span class="zoom-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Single Image</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="2">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap mfp-youtube" href="https://www.youtube.com/watch?v=O_C5CN1L3Xo"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-6.jpg" alt="Gallery project" /><span class="zoom-icon video-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Youtube Video</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="1">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap" href="http://via.placeholder.com/700x470" data-gal="magnific-pop-up[image]" title="Image project"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-7.jpg" alt="Image Project" /><span class="zoom-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Single Image</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="2">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap mfp-vimeo" href="https://vimeo.com/23534361"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-8.jpg" alt="Gallery project" /><span class="zoom-icon video-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Vimeo Video</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                        <!--<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 filtr-item" data-category="1">
                            <div class="magnific-popup-gallery">
                                <!-- Thumbnail Starts -->
                                <!--<figure class="thumbnail thumbnail__portfolio">
                                    <a class="image-wrap" href="http://via.placeholder.com/700x470" data-gal="magnific-pop-up[image]" title="Image project"><img class="img-fluid" src="<?php echo base_url();?>assets/images/project-9.jpg" alt="Image Project" /><span class="zoom-icon"></span></a>
                                </figure>
                                <!-- Thumbnail Ends -->
                                <!-- Caption Starts -->
                                <!--<div class="caption">
                                    <h3>Single Image</h3>
                                    <p>dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi</p>
                                </div>
                                <!-- Caption Ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container Ends -->
        </section>
        <!-- Portfolio Section Ends -->