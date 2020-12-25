<section class="projectmanager" id="projectmanager">
    <!-- Section Overlay Starts -->
    <div class="section-overlay">
        <!-- Container Starts -->
        <div class="container">
            <div class="row">
                <!-- Details Starts -->
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <h3>Komisi Anda Yang Belum Diklaim</h3>
					<p class="">Berikut merupakan rincian komisi yang sudah anda dapatkan.</p>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="tabelKomisiHistory" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th style="text-align: center; width:5%">No</th>
											<th style="text-align: center; width:15%">Tanggal</th>
											<th style="text-align: center; width:25%">Laba Agen</th>
											<th style="text-align: center; width:13%">Kode Ref</th>
										</tr>
									</thead>
									<tbody>
                                        <?php 
                                            if(count($data_komisi_belum) > 0) {
                                                foreach ($data_komisi_belum as $keys => $vals) { ?>
                                                    <tr>
                                                        <td><?= $vals[0]; ?></td>
                                                        <td><?= $vals[1]; ?></td>
                                                        <td><?= $vals[2]; ?></td>
                                                        <td><?= $vals[3]; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?> 
                                                <tr>
                                                    <td colspan="4"> Data Kosong ...</td>
                                                </tr>
                                            <?php } ?>
									</tbody>
								</table>
							</div><!-- responsive -->
						</div> <!-- /.col-md-12 -->
					</div><!-- /.row -->
					<br>
					<hr>
					<h3>Klaim Komisi Dalam Tahap Verifikasi</h3>
					<p class="">Berikut merupakan rincian komisi anda yang masuk dalam tahap verifikasi.</p>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="tabelPreKomisiHistory" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th style="text-align: center; width:5%">No</th>
											<th style="text-align: center; width:15%">Tanggal</th>
											<th style="text-align: center; width:25%">Laba Agen</th>
											<th style="text-align: center; width:13%">Kode Ref</th>
										</tr>
									</thead>
									<tbody>
                                        <?php 
                                            if(count($data_komisi_pre) > 0) {
                                                foreach ($data_komisi_pre as $keys => $vals) { ?>
                                                <tr>
                                                    <td><?= $vals[0]; ?></td>
                                                    <td><?= $vals[1]; ?></td>
                                                    <td><?= $vals[2]; ?></td>
                                                    <td><?= $vals[3]; ?></td>
                                                </tr>
                                                <?php } ?>
                                            <?php } else { ?> 
                                                <tr>
                                                    <td colspan="4"> Data Kosong ...</td>
                                                </tr>
                                            <?php } ?>
									</tbody>
								</table>
							</div><!-- responsive -->
						</div> <!-- /.col-md-12 -->
					</div><!-- /.row -->
					<br>
					<hr>
					<h3>Komisi yang Sudah anda Tarik</h3>
					<p class="">Berikut merupakan rincian komisi yang sudah anda ditarik.</p>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="tabelAfterKomisiHistory" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th style="text-align: center; width:5%">No</th>
											<th style="text-align: center; width:15%">Tanggal</th>
											<th style="text-align: center; width:25%">Laba Agen</th>
											<th style="text-align: center; width:13%">Kode Ref</th>
											<th style="text-align: center; width:13%">Bukti</th>
										</tr>
									</thead>
									<tbody>
                                        <?php 
                                            if(count($data_komisi_after) > 0) {
                                                foreach ($data_komisi_after as $keys => $vals) { ?>
                                                <tr>
                                                    <td><?= $vals[0]; ?></td>
                                                    <td><?= $vals[1]; ?></td>
                                                    <td><?= $vals[2]; ?></td>
                                                    <td><?= $vals[3]; ?></td>
                                                    <td><button class="btn btn-primary" onclick="lihatBukti('<?=$vals[4]."'".','."'".$vals[3];?>')">Lihat Bukti</button></td>
                                                </tr>
                                                <?php } ?>
                                            <?php } else { ?> 
                                                <tr>
                                                    <td colspan="5"> Data Kosong ...</td>
                                                </tr>
                                            <?php } ?>
									</tbody>
								</table>
							</div><!-- responsive -->
						</div> <!-- /.col-md-12 -->
					</div><!-- /.row -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('profile'); ?>" title="Edit"> Kembali Ke Profil</a>
                </div>
            </div>
            <!-- Details Ends -->
        </div>
        <!-- Container Ends -->
    </div>
</section>