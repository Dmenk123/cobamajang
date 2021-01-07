<section class="team" id="team">
    <!-- Section Overlay Starts -->
    <div class="section-overlay">
        <!-- Container Starts -->
        <div class="container">
            <!-- flashdata -->
            <?php if ($this->session->flashdata('feedback_success')) { ?>
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
            <?= $this->session->flashdata('feedback_success') ?>
            </div>

            <?php } elseif ($this->session->flashdata('feedback_failed')) { ?>
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-remove"></i> Gagal!</h4>
            <?= $this->session->flashdata('feedback_failed') ?>
            </div>
            <?php } ?>

            <!-- Main Heading Starts -->
            <div class="text-center top-text">
                <h1><span>Login</span> Form</h1>
                <h4>Silakan Masukkan Username dan Password anda yang sudah kami kirimkan melalui email.</h4>
            </div>
            <!-- Main Heading Ends -->
            <div class="form-container">
                <!-- Contact Form Starts -->
                <form class="form" method="post" action="<?=base_url('auth/login');?>">
                    <div class="row form-inputs">
                        <!-- First Name Field Starts -->
                        <div class="col-md-12 form-group custom-form-group">
                            <span class="input custom-input">
                                <input placeholder="Silahkan Masukkan Username Anda" class="input-field custom-input-field" id="username" name="username" type="text" required="" data-error="NEW ERROR MESSAGE" autocomplete="off" value="">
                                <label class="input-label custom-input-label">
                                    <i class="fa fa-user icon icon-field"></i>
                                </label>
                            </span>
                        </div>
                        <!-- Message Field Ends -->
                        <!-- Email Name Field Starts -->
                        <div class="col-md-12 form-group custom-form-group">
                            <span class="input custom-input">
                                <input placeholder="Silahkan Masukkan Password Anda" class="input-field custom-input-field" id="password" name="password" type="password" required="" value="">
                                <label class="input-label custom-input-label">
                                    <i class="fa fa-envelope icon icon-field"></i>
                                </label>
                            </span>
                        </div>
                        <!-- Email Name Field Ends -->
                        <!-- Submit Button Starts -->
                        <div class="col-md-12 submit-form">
                            <button id="form-submit" name="submit" type="submit" class="custom-button" title="Send"><span data-hover="Send Message">Login</span></button>
                        </div>
                        <!-- Submit Button Ends -->
                        <!-- Form Submit Message Starts -->
                        <div class="col-sm-12 text-center output_message_holder d-none">
                            <p class="output_message"></p>
                        </div>
                        <!-- Form Submit Message Ends -->
                    </div>
                </form>
                <!-- Contact Form Ends -->
            </div>
        </div>
        <!-- Container Ends -->
    </div>
</section>