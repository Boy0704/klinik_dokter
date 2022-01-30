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
                    <li><a href="#tab_5" data-toggle="tab">BIAYA</a></li>

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
                                             <td><?php echo ($dt_pasien->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan' ?>
                                             </td>
                                        </tr>
                                        <tr>
                                             <td>Nama Pasien</td>
                                             <td><?php echo hitung_umur($dt_pasien->tanggal_lahir) ?></td>
                                        </tr>
                                        <tr>
                                             <td>Riwayat Penyakit</td>
                                             <td>
                                                  <input type="text" class="form-control" name="riwayat_penyakit"
                                                       value="<?php echo get_data('rekam_medis','id_pasien',$dt_pasien->id_pasien,'riwayat_penyakit') ?>">
                                             </td>
                                        </tr>
                                        <tr>
                                             <td>Alergi</td>
                                             <td>
                                                  <input type="text" class="form-control" name="alergi"
                                                       value="<?php echo get_data('rekam_medis','id_pasien',$dt_pasien->id_pasien,'alergi') ?>">
                                             </td>
                                        </tr>
                                        <tr>
                                             <td></td>
                                             <td>
                                                  <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i> Update</button>
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
                                        <form action="rekam_medis/aksi_simpan/2/<?php echo $dt_pasien->id_pasien ?>?tgl_kunjungan=<?php echo $rw->tgl_kunjungan ?>"
                                             method="POST">

                                             <h4 class="box-title">
                                                  <a data-toggle="collapse" data-parent="#accordion"
                                                       href="#<?php echo $rw->id_antrian ?>">
                                                       Tgl Kunjungan : <?php echo tanggal_indo($rw->tgl_kunjungan) ?>
                                                       <input type="text" name="tujuan_kunjungan"
                                                            value="<?php echo $rw->tujuan_kunjungan ?>">
                                                  </a>
                                             </h4>
                                   </div>
                                   <div id="<?php echo $rw->id_antrian ?>" class="panel-collapse collapse">
                                        <div class="box-body">


                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <a href="rekam_medis/cetak_resep/<?php echo $rw->id_antrian ?>"
                                                            target="_blank" class="btn btn-success"><i
                                                                 class="fa fa-print"></i> Cetak Resep</a><br>
                                                  </div>
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label>Clinical Notes</label>
                                                            <textarea class="form-control"
                                                                 name="clinical_notes"><?php echo $rw->clinical_notes ?></textarea>
                                                       </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label>Medications</label>
                                                            <textarea class="form-control"
                                                                 name="medications"><?php echo $rw->medications ?></textarea>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <button class="btn btn-primary"><i class="fa fa-save"></i>
                                                            Update</button>
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


                         <link href="<?php echo base_url(); ?>assets/dropzone/dist/dropzone.css" type="text/css"
                              rel="stylesheet" />
                         <script src="<?php echo base_url(); ?>assets/dropzone/dist/min/dropzone.min.js"></script>

                         <?php 
												$id = $this->uri->segment(3);
												 ?>
                         <h1>Upload </h1>
                         <form action="<?php echo base_url('app/dropzone/'.$id); ?>" class="dropzone">
                         </form>

                         <br><br>

                         <div id="list_image">

                         </div>

                         <script type="text/javascript">
                         $(document).ready(function() {
                              // setInterval(function() {
                              //      cek_data();
                              //      console.log('berhasil');
                              // }, 1000);

                              function cek_data() {
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

                    <div class="tab-pane" id="tab_5">
                        <div class="box-group" id="accordion1">
                              <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                              <?php
							                $sql = "
							                	SELECT a.id_antrian, a.tgl_kunjungan, b.total_bayar, b.id_antrian as b_antrian, b.id_invoice, b.dibayar,b.sisa
																FROM antrian as a
																LEFT JOIN invoice as b ON a.id_antrian=b.id_antrian
																WHERE a.id_pasien='$dt_pasien->id_pasien'
																GROUP BY tgl_kunjungan
																ORDER BY id_antrian DESC
							                ";
							                 foreach ($this->db->query($sql)->result() as $rw): 
                                                       // cek jika id_antrian di invice kosong, lakukan insert
                                                       if ($rw->b_antrian == null) {
                                                            $this->db->insert('invoice', array(
                                                                 'no_inv' => 'inv'.time(),
                                                                 'id_antrian' => $rw->id_antrian,
                                                                 'created_at' => get_waktu()
                                                            ));
                                                       }

                                                       ?>



                              <div class="panel box box-primary">
                                   <div class="box-header with-border">
                                        <form action="rekam_medis/aksi_simpan/2/<?php echo $dt_pasien->id_pasien ?>?tgl_kunjungan=<?php echo $rw->tgl_kunjungan ?>"
                                             method="POST">

                                             <h4 class="box-title">
                                                  <a data-toggle="collapse" data-parent="#accordion1"
                                                       href="#biaya<?php echo $rw->id_antrian ?>">
                                                       Tgl Kunjungan : <?php echo tanggal_indo($rw->tgl_kunjungan) ?>
                                                  </a>
                                             </h4>
                                   </div>
                                   <div id="biaya<?php echo $rw->id_antrian ?>" class="panel-collapse collapse">
                                        <div class="box-body">


                                             <div class="row">
                                                <div class="col-md-12">
                                                	<table class="table table-bordered">
                                                		<thead>
                                                			<tr>
                                                				<td>Biaya</td>
                                                				<td width="200px">Harga</td>
                                                				<td width="50px">
                                                					<span class="btn btn-primary" onclick="tambah_biaya('<?php echo $rw->id_antrian ?>','<?php echo $rw->id_invoice ?>')">
                                                						<i class="fa fa-plus"></i>
                                                					</span>
                                                				</td>
                                                			</tr>
                                                		</thead>
                                                		<tbody class="bayar<?php echo $rw->id_antrian?>">
                                                			<?php 
                                                            $total = 0;
                                                            $this->db->where('id_invoice', $rw->id_invoice);
                                                            foreach ($this->db->get('invoice_detail')->result() as $br): ?>
                                                            <tr id="br<?php echo $br->id_detail_inv ?>">
                                                                 <td>

                                                                       <select class="form-control select2" onchange="pilih_jenis('<?php echo $rw->id_antrian ?>','<?php echo $rw->id_invoice ?>','<?php echo $br->id_detail_inv ?>')" name="id_jenis_bayar[]" id="jenis_bayar<?php echo $br->id_detail_inv ?>" style="width: 100%;">
                                                                           <option value="<?php echo $br->id_jenis_bayar ?>"><?php echo get_data('jenis_bayar','id_jenis_bayar',$br->id_jenis_bayar,'jenis_bayar') ?></option>
                                                                           <?php foreach ($this->db->get('jenis_bayar')->result() as $jb): ?>
                                                                               <option value="<?php echo $jb->id_jenis_bayar ?>"><?php echo $jb->jenis_bayar ?></option>
                                                                           <?php endforeach ?>
                                                                       </select>
                                                                   </td>
                                                                   <td>
                                                                       <span id="harga<?php echo $br->id_detail_inv ?>">
                                                                            <?php 
                                                                            echo get_data('jenis_bayar','id_jenis_bayar',$br->id_jenis_bayar,'harga');
                                                                            $total = $total + get_data('jenis_bayar','id_jenis_bayar',$br->id_jenis_bayar,'harga');
                                                                             ?>
                                                                       </span>
                                                                   </td>
                                                                   <td>
                                                                       <span class="btn btn-xs btn-danger" onclick="remove('<?php echo $rw->id_antrian ?>','<?php echo $rw->id_invoice ?>','<?php echo $br->id_detail_inv ?>')">
                                                                           <i class="fa fa-trash"></i>
                                                                       </span>
                                                                   </td>
                                                            </tr>
                                                            <?php endforeach ?>
                                                		</tbody>
                                                		<tfoot>
                                                			<tr>
                                                				<td align="right"><b>Total</b></td>
                                                				<td align="left" onload="total_det_inv('<?php echo $rw->id_antrian ?>','<?php echo $rw->id_invoice ?>')">Rp. 
                                                					<b id="total<?php echo $rw->id_antrian ?>"><?php echo $total ?></b>
                                                				</td>
                                                			</tr>
                                                            <tr>
                                                                 <td align="right">
                                                                      <b>Pembayaran</b>
                                                                 </td>
                                                                 <td align="left">
                                                                      <input type="number" id="dibayar<?php echo $rw->id_antrian ?>" onkeyup="pembayaran('<?php echo $rw->id_antrian ?>')" name="dibayar" class="form-control" value="<?php echo $rw->dibayar ?>">
                                                                 </td>
                                                            </tr>
                                                            <tr>
                                                                 <td align="right">
                                                                      <b>Kembalian</b>
                                                                 </td>
                                                                 <td align="left">
                                                                      <input type="number" id="kembalian<?php echo $rw->id_antrian ?>" name="kembalian" class="form-control" value="<?php echo $rw->sisa ?>" readonly>
                                                                 </td>
                                                            </tr>
                                                		</tfoot>
                                                	</table>

                                                	
                                                </div>
                                             </div>
                                             <div class="row">
                                                  <div class="col-md-12">
                                                       <span onclick="update_pembayaran('<?php echo $rw->id_antrian ?>','<?php echo $rw->id_invoice ?>')" class="btn btn-primary"><i class="fa fa-save"></i>
                                                            Update</span>
                                                  </div>
                                             </div>

                                             </form>

                                        </div>
                                   </div>
                              </div>

                              <?php endforeach ?>

                         </div>
                    </div>


               </div>
               <!-- /.tab-content -->
          </div>
     </div>
</div>

<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('imunisasi');

function tambah_biaya(id_antrian, id_invoice) {

	$.ajax({
		url: 'rekam_medis/get_form_pembayaran/'+ id_antrian +'/'+id_invoice,
		type: 'GET',
		dataType: 'html'
	})
	.done(function(result) {
		console.log("success");
		$(".bayar"+id_antrian).append(result);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}

function remove(id_antrian, id_invoice, n) {
     $("#br"+n).remove();
     $.get('rekam_medis/remove_invoice_detail/'+n, function(data) {
          console.log("berhasil hapus");
          total_det_inv(id_antrian, id_invoice);
     });
}

function pilih_jenis(id_antrian, id_invoice, n) {
	var jenis_bayar = $("#jenis_bayar"+n).val();
	$.ajax({
		url: 'rekam_medis/get_biaya/'+n,
		type: 'POST',
		dataType: 'html',
		data: {id: jenis_bayar},
	})
	.done(function(result) {
		console.log("success");
		$("#harga"+n).text(result);
          total_det_inv(id_antrian, id_invoice);
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}

function total_det_inv(id_antrian, id_invoice) {
     $.get('rekam_medis/total_detail_inv/'+id_invoice, function(data) {
          $("#total"+id_antrian).text(data);
          pembayaran(id_antrian);
     });
}

function pembayaran(id_antrian) {
     var dibayar =  $("#dibayar"+id_antrian).val();
     var total =  $("#total"+id_antrian).text();

     var hasil = parseInt(dibayar) - parseInt(total);
     console.log(total);
     console.log(hasil);
     $("#kembalian"+id_antrian).val(hasil);
}

function update_pembayaran(id_antrian, id_invoice) {
     var dibayar =  $("#dibayar"+id_antrian).val();
     var total =  $("#total"+id_antrian).text();

     var sisa = parseInt(dibayar) - parseInt(total);

     $.ajax({
          url: 'rekam_medis/update_pembayaran/'+id_invoice,
          type: 'POST',
          dataType: 'html',
          data: {total_bayar: total, dibayar: dibayar, sisa: sisa},
     })
     .done(function() {
          console.log("success");
          window.location='<?php echo base_url() ?>rekam_medis/<?php echo $this->uri->segment(2).'/'.$this->uri->segment(3) ?>'
     })
     .fail(function() {
          console.log("error");
     })
     .always(function() {
          console.log("complete");
     });
     
}



</script>