<section class="projectmanager" id="projectmanager">
    <!-- Section Overlay Starts -->
    <div class="section-overlay">
        <!-- Container Starts -->
        <div class="container">
            <div class="row">
                <!-- Image Starts -->
                <div class="col-md-12 col-lg-12 col-xl-4">
                    <img class="img-fluid projectmanagerpicture" src="<?php if($profile->gambar){echo base_url().$profile->gambar; }else{ echo base_url('files/img/user_img/').'user_default.png'; } ?>" style="border-radius: 20%; height: 60%; width: 70%;">
                </div>
                <!-- Image Ends -->
                <!-- Details Starts -->
                <div class="col-md-12 col-lg-12 col-xl-6 offset-xl-1">
                    <h1>Profile Member</h1>
                    <h3> <?php echo $profile->nama_lengkap; ?></h3>
                    <p>
                        Berikut merupakan data profil anda, anda dapat mengatur profil anda dengan menekan tombol <strong>Edit</strong>.
                    </p>
                    <?php if($profile->status_confirm == 'diterima'){ ?>
                        <blockquote>
                            <strong>Link Affiliate :</strong> <?php echo base_url('home/aff/') . $profile->kode_affiliate; ?>
                        </blockquote>
                    <?php }else{ ?>
                        <blockquote>
                            "Link Affiliate akan ditampilkan setelah pembayaran dikonfirmasi. Terimakasih"
                        </blockquote>
                    <?php } ?>
                    <p><strong>Nama Lengkap :</strong> <?php echo $profile->nama_lengkap; ?>
                        <br><strong>Email :</strong> <?php echo $profile->email; ?>
                        <br><strong>Nomor Telp :</strong> <?php echo $profile->no_telp; ?>
                        <br><strong>No Rekening :</strong> <?php echo $profile->rekening; ?>
                        <br><strong>Bank :</strong> <?php echo $profile->bank; ?>
                        <br><strong>Terakhir Login :</strong> <?php echo $profile->last_login; ?>                        
                        <hr>
                    </p>
                </div>
                <div class="col-md-12">
                    <?php $link = base_url('profile/edit_profil/'); ?>
                    <a class="btn btn-sm btn-primary" href="<?php echo $link; ?>" title="Edit"> Edit Profil</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h3>Data Komisi</h3>
                    <br><strong>Jumlah Komisi <span style="color:blue;">(Sudah Ditarik)</span> :</strong> <strong>Rp. <?php echo number_format($data_laba_agen['komisi_sudah'], 2, ",", "."); ?></strong>
                    <br>
                    <br><strong>Jumlah Komisi <span style="color:green;">(Tunggu Verifikasi)</span> :</strong> <strong>Rp. <?php echo number_format($data_laba_agen['komisi_pending'], 2, ",", "."); ?></strong>
                    <br>
                    <br><strong>Jumlah Komisi <span style="color:red;">(Belum Ditarik)</span> :</strong> <strong>Rp. <?php echo number_format($data_laba_agen['komisi_belum'], 2, ",", "."); ?></strong>
                    <br><br>
                    <button type="button" class="btn btn-sm btn-success" onclick="prosesKlaim()" title="Tarik Komisi"> Tarik Komisi</button>
                    <a class="btn btn-sm btn-warning" title="Detail Komisi" href="<?= base_url('profile/rincian_komisi'); ?>"> Detail Komisi</a>
                </div>

            </div>
            <!-- Details Ends -->
        </div>
        <!-- Container Ends -->
    </div>
</section>