<section class="projectmanager" id="projectmanager">
    <!-- Section Overlay Starts -->
    <div class="section-overlay">
        <!-- Container Starts -->
        <div class="container">
            <div class="row">
                <!-- Image Starts -->
                <!-- Image Ends -->
                <!-- Details Starts -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <h1>Pengaturan Profile Member</h1>
                    <h3> <?php echo 'Username : '.$profile->username; ?></h3>
                    <div class="divider text-center"><span class="outer-line"></span><span class="outer-line"></span></div>
                    <br>
                    <form id="form_update_profil" method="post" enctype="multipart/form-data" class="ps-checkout__form">
						<div class="col-12">
                            <div class="form-group">
                                <img class="img-fluid projectmanagerpicture" src="<?php if($profile->gambar){echo base_url().$profile->gambar; }else{ echo base_url('files/img/user_img/').'user_default.png'; } ?>" style="border-radius: 20%;">
                            </div>
							<div class="ps-checkout__billing">
								<div class="form-group form-group--inline">
									<label>Nama<span></span>
									</label>
									<input type="hidden" id="id" name="id" value="<?=$profile->id;?>">
									<input class="form-control" type="text" name="nama" id="nama" value="<?=$profile->nama_lengkap;?>">
									<span class="help-block"></span>
								</div>
								<div class="form-group form-group--inline">
									<label>Email<span></span>
									</label>
									<input class="form-control" type="email" name="email" id="email" value="<?=$profile->email;?>">
									<span class="help-block"></span>
                                </div>
                                <div class="form-group form-group--inline">
									<label>No. Telepon<span></span>
									</label>
									<input class="form-control numberinput" type="text" name="telp" id="telp" value="<?=$profile->no_telp;?>">
									<span class="help-block"></span>
								</div>
								<div class="form-group form-group--inline">
									<label>Nama Bank<span></span>
									</label>
									<input class="form-control" style="" type="text" name="bank" id="bank" value="<?=$profile->bank;?>">
									<span class="help-block"></span>
								</div>
								<div class="form-group form-group--inline">
									<label>No. Rekening<span></span>
									</label>
									<input class="form-control numberinput" style="" type="text" name="rekening" id="rekening" value="<?=$profile->rekening;?>">
									<span class="help-block"></span>
                                </div>
                                <div class="divider text-center"><span class="outer-line"></span><span class="outer-line"></span></div>
                                <h4 style="color:aqua;">Centang Pilihan ini jika tidak mengganti password</h4>
                                <div class="form-group col-md-12 checkbox">
									<label>
										<input type="checkbox" value="Y" name="ceklistpwd" id="ceklistpwd"> Iya, Saya Tidak Merubah Password
									</label>
								</div>
                                <div class="form-group form-group--inline">
									<label>Password Lama<span></span>
									</label>
									<input class="form-control" type="password" name="password_lama" id="password_lama" autocomplete="off">
									<span class="help-block"></span>
								</div>
								<div class="form-group form-group--inline">
									<label>Password Baru<span></span>
									</label>
									<input class="form-control" type="password" name="password" id="password" autocomplete="off">
									<span class="help-block"></span>
								</div>
								<div class="form-group form-group--inline">
									<label>Tulis Ulang Password Baru<span></span>
									</label>
									<input class="form-control" type="password" name="repassword" id="repassword" autocomplete="off">
									<span class="help-block"></span>
								</div>
                                <div class="divider text-center"><span class="outer-line"></span><span class="outer-line"></span></div>
                                <h4 style="color:aqua;">Abaikan Jika Tidak Ingin Mengganti Foto</h4>
								<div class="form-group form-group--inline">
									<label>Upload Foto Profil</label>
									<div></div>
									<div class="custom-file">
										<input type="file" class="form-control" onchange="readURL(this)" id="foto" name="foto" accept=".jpg,.jpeg,.png">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group" id="div_preview_foto" style="display: none;">
									<label for="" class="form-control-label">Preview Bukti:</label>
									<div></div>
									<img id="preview_img" src="#" alt="Preview Foto" height="200" width="200">
									<span class="help-block"></span>
								</div>
								<div class="form-group">
									<label for="Wajib Diisi"><strong>Keterangan : (*) Wajib diisi.</strong></label>
									<br>
									<label for="">Mohon memasukkan nomor rekening anda dengan valid. Komisi anda akan kami transfer pada rekening yg anda daftarkan</label>
								</div>
							</div>
						</div>
					</form>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary" onclick="update_profile();" title="Edit"> Update Profil</button>
                    <a class="btn btn-sm btn-warning" href="<?php echo base_url('profile'); ?>" title="Kembali"> Kembali</a>
                </div>
            </div>
            <hr>
        </div>
        <!-- Container Ends -->
    </div>
</section>