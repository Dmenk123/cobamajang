<!-- Gallery Section Starts -->
<section id="team" class="team">
    <!-- Container Starts -->
    <div class="container">
        <!-- Gallery for desktop view -->
        <div class="row team-members magnific-popup-gallery foto-talent">
            <!-- Team Member Starts -->
            <?php foreach ($galeri as $key => $value) { ?>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="team-member">
                        <!-- Team Member Picture Starts -->
                        <a title="Saras Davina" class="team-member-img-wrap"><img src="<?php echo base_url().$value->path_file;?>" alt="team member"></a>
                    </div>
                </div>
            <?php } ?>
            <!-- Team Member Ends -->
        </div>

        <!-- Gallery for mobile view -->
        <div class="col-md-4 foto" style="margin-bottom:-120px; margin-top:-70px;">
            <div id="gallery-1" class="gallery galleryid-7 gallery-columns-3 gallery-size-full" style="padding-right: 0px;">
                <?php foreach ($galeri as $key => $value) { ?>
                    <figure class="gallery-item">
                        <div class="gallery-icon landscape">
                            <a href="<?=base_url().$value->path_file;?>"><img src="<?php echo base_url().$value->path_file;?>" class="attachment-full size-full" alt=""></a>
                        </div>
                    </figure>
                <?php } ?>
            </div>
        </div>
        <!-- Gallery Ends -->
    </div>
    <!-- Container Ends -->
</section>
<!-- Gallery Section Ends -->