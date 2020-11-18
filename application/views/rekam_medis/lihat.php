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
              					<textarea class="form-control editor" name="riwayat_penyakit"></textarea>
              				</td>
              			</tr>
              			<tr>
              				<td>Alergi</td>
              				<td>
              					<textarea class="form-control editor" name="alergi"></textarea>
              				</td>
              			</tr>
              			<tr>
              				<td></td>
              				<td>
              					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
              				</td>
              			</tr>
              		</thead>
              	</table>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                	
              	<div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#1">
	                        Tgl Kunjungan : 20 November 2020
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="1" class="panel-collapse collapse">
	                    <div class="box-body">
	                    	
	                    	<form action="" method="POST">
	                    		<div class="form-group">
	                    			<label>Clinical Notes</label>
	                    			<textarea class="form-control editor" name="riwayat_penyakit"></textarea>
	                    		</div>
	                    		<div class="form-group">
	                    			<label>Medications</label>
	                    			<textarea class="form-control editor" name="riwayat_penyakit"></textarea>
	                    		</div>
	                    	</form>

	                    </div>
	                  </div>
	                </div>

	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#2">
	                        Tgl Kunjungan : 20 November 2020
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="2" class="panel-collapse collapse">
	                    <div class="box-body">
	                    	
	                    	<form action="" method="POST">
	                    		<div class="form-group">
	                    			<label>Clinical Notes</label>
	                    			<textarea class="form-control editor" name="riwayat_penyakit"></textarea>
	                    		</div>
	                    		<div class="form-group">
	                    			<label>Medications</label>
	                    			<textarea class="form-control editor" name="riwayat_penyakit"></textarea>
	                    		</div>
	                    	</form>

	                    </div>
	                  </div>
	                </div>

	                <div class="panel box box-primary">
	                  <div class="box-header with-border">
	                    <h4 class="box-title">
	                      <a data-toggle="collapse" data-parent="#accordion" href="#3">
	                        Tgl Kunjungan : 20 November 2020
	                      </a>
	                    </h4>
	                  </div>
	                  <div id="3" class="panel-collapse collapse">
	                    <div class="box-body">
	                    	
	                    	<form action="" method="POST">
	                    		<div class="form-group">
	                    			<label>Clinical Notes</label>
	                    			<textarea class="form-control editor" name="riwayat_penyakit"></textarea>
	                    		</div>
	                    		<div class="form-group">
	                    			<label>Medications</label>
	                    			<textarea class="form-control editor" name="riwayat_penyakit"></textarea>
	                    		</div>
	                    	</form>

	                    </div>
	                  </div>
	                </div>
	                
	              </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
            	<div class="row">
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
            	</div>
              </div>

              <div class="tab-pane" id="tab_4">
              	<textarea rows="10" class="form-control" name="imunisasi">
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

              	</textarea>
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