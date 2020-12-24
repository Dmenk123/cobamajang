<section class="checkout" id="checkout">
    <div class="container" style="margin-top:50px;">
        <!-- flashdata -->
        <!-- end flashdata -->
        <form id="form_proses_checkout" method="post" enctype="multipart/form-data" class="ps-checkout__form">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__billing">
                        <h3>Contoh Form Checkout</h3>
                        <div class="form-group form-group--inline">
                            <label>Nama<span>*</span>
                            </label>
                            <input class="form-control" style="background-color: #e8f0fe;" type="text" name="nama" id="nama">
                            <input type="hidden" name="keterangan" id="keterangan" value="<?= $type; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Email<span>*</span>
                            </label>
                            <input class="form-control" style="background-color: #e8f0fe;" type="email" name="email" id="email" placeholder="anda@domain.com">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group form-group--inline">
                            <label>No. Telepon<span>*</span>
                            </label>
                            <input class="form-control numberinput" style="background-color: #e8f0fe;" type="text" name="telp" id="telp">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__order">
                        <!-- <header></header> -->
                        <footer>
                            <h3>Metode Pembayaran dengan Transfer</h3>
                            <div class="form-group cheque">
                                <div class="">
                                    <p>Transfer Rp. 3.000.000 Ke Rekening Dibawah Ini Serta Melampirkan Upload Bukti Transfer.</p>
                                    <p>Rekening BCA : 464-177-2458 <br> a.n Cipto Junaidi</p>
                                </div>
                            </div>
                            <div class="form-group paypal">
                                <button type="button" class="btn btn-md btn-primary" id="btn_bayar" onclick="proses_checkout()">Kirim &amp; Segera Mulai<i class="ps-icon-next"></i></button>
                            </div>
                        </footer>
                    </div>
                    <div class="ps-shipping">
                        <!--<h3>PERLU ANDA KETAHUI</h3>-->
                        <p>Setelah anda membayar, maka Program LANGSUNG DIMULAI bagi yang sudah genap biayanya untuk Workshop Online 12w sessions itu,dan bulan ini juga ketularan jadi Teladan, jago menghasilkan Cash Banyak <br><br>Kuota Terbatas. Yang duluan kirim bukti konfirmasi, dilayani duluan.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>