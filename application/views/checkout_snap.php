<style>
    .divider .outer-line {
        width: 40%;
        border-bottom: 2px solid #a99b9b;
    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(1.5em + 1.3rem + 2px);
        margin: 0;
        opacity: 0;
    }

    .custom-file {
        width: 100%;
    }

    .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
        height: calc(1.5em + 1.3rem + 2px);
        margin-bottom: 0;
    }

</style>
<section class="checkout" id="checkout" style="padding-top:40px;">
        <form class="ps-checkout__form" id="payment-form" method="post" action="<?=site_url()?>snap/finish">
          <input type="hidden" name="result_type" id="result-type" value=""></div>
          <input type="hidden" name="result_data" id="result-data" value=""></div>
          <input type="hidden" name="formulir-data" id="formulir-data" value=""></div>
        </form>
    <div class="container" style="margin-top:50px;">
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
        <!-- end flashdata -->
        <div class="text-center top-text">
            <h1><span>Pilih Metode</span> Pembayaran</h1>
            <!--<h4>Silahkan Pilih Metode Pembayaran</h4>-->
        </div>

         <div class="row">
            <div class="col-sm-12 col-md-6 col-xs-12">
                <div class="latest-post">
                    <a class="img-thumb tombol_method_bayar" href="transfer"><img style="max-width: 80%;" src="<?= base_url('assets/images/transfer1a.png')?>" alt="img" width="460" height="250"></a>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xs-12">
                <div class="latest-post">
                    <a class="img-thumb tombol_method_bayar" href="payment"><img style="max-width: 80%;" src="<?= base_url('assets/images/transfer2a.png')?>" alt="img" width="460" height="250"></a>
                </div>
            </div>
        </div>
        
         <div id="lock-modal"></div>
        <div id="loading-circle"></div>
        
        

        <div class="col-12" id="main-form-bayar">
        
        </div>

    </div>
</section>