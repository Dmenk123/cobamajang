<!-- Testimonials Section Starts -->
<section class="videopromotion">
    <div class="section-overlay">
        <!-- Container Starts -->
        <div class="container">
            <!-- Main Heading Starts -->
            <div class="text-center top-text">
                <h1><span>Video</span> Saras Davina</h1>
            </div>

            <div class="video-content">
                <!-- Video Play Starts -->
                <!-- <div class="magnific-popup-gallery">
                    <div class="btn-wrapper text-center"><a class="image-wrap mfp-youtube" href="https://www.youtube.com/watch?v=0gv7OC9L2s8"></a></div>
                </div> -->
                
                <!-- <div class="magnific-popup-gallery">
                    <div class="btn-wrapper text-center" style="text-align:center;">
                        <a href="#video-01" class="openVideo">
                            <div id="video-01" class="video-popup mfp-hide" style="text-align: center;">
                                <video preload="false" poster="">
                                    <source src="" type="video/mp4">
                                </video>
                            </div>
                        </a>
                    </div>
                </div> -->  

                 <!-- Video Play Starts -->
                <video width="720" height="480" poster="<?=base_url('assets/images/thumbnail_video/gambar1.jpg')?>" controls>
                    <source src="<?=base_url().$video[0]->path_video;?>" type=video/mp4>
                </video>
                <!-- Video Play Ends -->
            </div>
            <!-- Blockquotes Ends -->
        </div>
        <!-- Container Ends -->
    </div>
</section>
<!-- Testimonials Section Ends -->