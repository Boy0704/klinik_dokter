<?php 
$this->db->where('id_pasien', $this->uri->segment(3));
$dt_pasien = $this->db->get('pasien')->row();
 ?>
<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">INFO PASIEN</a></li>
              <li><a href="#tab_2" data-toggle="tab">KUNJUNGAN</a></li>
              <li><a href="#tab_3" data-toggle="tab">GAMBAR</a></li>
              <li><a href="#tab_4" data-toggle="tab">TABEL IMUNISASI</a></li>
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
              	<form action="rekam_medis/aksi_simpan/1/<?php echo $dt_pasien->id_pasien ?>" method="POST">
              	<table class="table table-bordered">
              		<thead>
              			<tr>
              				<td>Nama Pasien</td>
              				<td><?php echo $dt_pasien->nama ?></td>
              			</tr>
              			<tr>
              				<td>Jenis Kelamin</td>
              				<td><?php echo ($dt_pasien->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
              			</tr>
              			<tr>
              				<td>Nama Pasien</td>
              				<td><?php echo hitung_umur($dt_pasien->tanggal_lahir) ?></td>
              			</tr>
              			<tr>
              				<td>Riwayat Penyakit</td>
              				<td>
              					<input type="text" class="form-control" name="riwayat_penyakit" value="<?php echo get_data('rekam_medis','id_pasien',$dt_pasien->id_pasien,'riwayat_penyakit') ?>">
              				</td>
              			</tr>
              			<tr>
              				<td>Alergi</td>
              				<td>
              					<input type="text" class="form-control" name="alergi" value="<?php echo get_data('rekam_medis','id_pasien',$dt_pasien->id_pasien,'alergi') ?>">
              				</td>
              			</tr>
              			<tr>
              				<td></td>
              				<td>
              					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
              				</td>
              			</tr>
              		</thead>
              	</table>
              	</form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                	
              	<div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
	                <?php
	                $this->db->where('id_pasien', $dt_pasien->id_pasien);
	                $this->db->order_by('tgl_kunjungan', 'desc');
	                $data_kunjungan = $this->db->get('antrian');
	                 foreach ($data_kunjungan->result() as $rw): ?>
	                	
	                

	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                  	<form action="rekam_medis/aksi_simpan/2/<?php echo $dt_pasien->id_pasien ?>?tgl_kunjungan=<?php echo $rw->tgl_kunjungan ?>" method="POST">

	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $rw->id_antrian ?>">
	                        Tgl Kunjungan : <?php echo tanggal_indo($rw->tgl_kunjungan) ?> <input type="text" name="tujuan_kunjungan" value="<?php echo $rw->tujuan_kunjungan ?>">
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="<?php echo $rw->id_antrian ?>" class="panel-collapse collapse">
	                    <div class="box-body">
	                    	
	                    	
	                    		<div class="row">
	                    			<div class="col-md-12">
	                    				<a href="rekam_medis/cetak_resep/<?php echo $rw->id_antrian ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Cetak Resep</a><br>
	                    			</div>
	                    			<div class="col-md-6">
	                    				<div class="form-group">
			                    			<label>Clinical Notes</label>
			                    			<textarea class="form-control editor" name="clinical_notes"><?php echo $rw->clinical_notes ?></textarea>
			                    		</div>
	                    			</div>
	                    			<div class="col-md-6">
	                    				<div class="form-group">
			                    			<label>Medications</label>
			                    			<textarea class="form-control editor" name="medications"><?php echo $rw->medications ?></textarea>
			                    		</div>
	                    			</div>
	                    		</div>
	                    		<div class="row">
	                    			<div class="col-md-12">
	                    				<button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
	                    			</div>
	                    		</div>
	                    		
	                    	</form>

	                    </div>
	                  </div>
	                </div>

	                <?php endforeach ?>
	                
	              </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">


				<link href="<?php echo base_url(); ?>assets/dropzone/dist/dropzone.css" type="text/css" rel="stylesheet" />
				<script src="<?php echo base_url(); ?>assets/dropzone/dist/min/dropzone.min.js"></script>

				<?php 
				$id = $this->uri->segment(3);
				 ?>
				<h1>Upload </h1>
				<form action="<?php echo base_url('app/dropzone/'.$id); ?>" class="dropzone" >
				</form>

				<br><br>

				<div id="list_image">
					
				</div>

				<script type="text/javascript">
					$(document).ready(function() {
						setInterval(function() {
							cek_data();
							console.log('berhasil');
						}, 1000);

						function cek_data()
						{
							$.ajax({
								url: 'app/image/<?php echo $id ?>',
								type: 'GET',
								dataType: 'html',
							})
							.done(function(a) {
								console.log("success");
								$('#list_image').html(a);
							})
							.fail(function() {
								console.log("error");
							})
							.always(function() {
								console.log("complete");
							});
						}


					});
					

				</script>

            	<!-- <div class="row">
            		<div class="col-md-12">
            			<div class="row">
            				<div class="col-md-5">
            					<form action="" method="POST">
		                		<div class="form-group">
		                			<label>Upload</label>
		                			<input type="file" class="form-control" name="gambar"><br>
		                			<button type="submit" class="btn btn-primary">Upload</button>
		                		</div>
		                		
		                		</form>
            				</div>
            			</div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-12">
            			<h4>Daftar Gambar</h4>
            			<div class="row">
            				<div class="col-md-2">
            					<a href="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" target="_blank">
            						<img src="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" style="width: 100px">
            					</a>
            				</div>
            				<div class="col-md-2">
            					<a href="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" target="_blank">
            						<img src="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" style="width: 100px">
            					</a>
            				</div>
            				<div class="col-md-2">
            					<a href="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" target="_blank">
            						<img src="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" style="width: 100px">
            					</a>
            				</div>
            				<div class="col-md-2">
            					<a href="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" target="_blank">
            						<img src="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" style="width: 100px">
            					</a>
            				</div>
            				<div class="col-md-2">
            					<a href="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" target="_blank">
            						<img src="https://i1.wp.com/www.murdockcruz.com/wp-content/uploads/2016/12/contoh-png.png?resize=388%2C388" style="width: 100px">
            					</a>
            				</div>
            			</div>
            		</div>
            	</div> -->
              </div>

              <div class="tab-pane" id="tab_4">
              	<form action="rekam_medis/aksi_simpan/4/<?php echo $dt_pasien->id_pasien ?>" method="POST">
              	<textarea rows="10" class="form-control" name="imunisasi">
              		<?php if (get_data('rekam_medis','id_pasien',$dt_pasien->id_pasien,'imunisasi') != ''): 
              			echo get_data('rekam_medis','id_pasien',$dt_pasien->id_pasien,'imunisasi');
              		 ?>
              		<?php else: ?>
              			<table cellspacing="0" style="border-collapse:collapse">
	<tbody>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:71px">
			<p>Hep-b</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px">
			<p>BCG</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px">
			<p>Polio</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px">
			<p>DPT</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px">
			<p>Rotavirus</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px">
			<p>PCV</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px">
			<p>Hep-A</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:none; vertical-align:top; width:71px">
			<p>Tifoid</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">
			<p>&nbsp;</p>
			</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
			<td style="border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:top; width:89px">&nbsp;</td>
		</tr>
	</tbody>
</table>

              		<?php endif ?>
              	</textarea>
              	<br>
              	<button class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
              	</form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
	</div>
</div>

<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'imunisasi' );
</script>