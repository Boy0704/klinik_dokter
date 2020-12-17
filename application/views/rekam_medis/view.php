<div class="row">
	<div class="col-md-4">
		<a href="#sdfd" class="btn btn-primary">Tambah Pasien</a>
	</div>
	<div class="col-md-4">
		<div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
	</div>
	<div class="col-md-4">
		<label>Berdasarkan Tgl Kunjungan</label>
		<input type="date" name="" class="form-control"><br>
		<button type="submit" class="btn btn-primary"> Cari</button>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Pasien</th>
					<th>Umur</th>
					<th>Akun Terkait</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no= 1;
				foreach ($this->db->get('pasien')->result() as $rw): ?>
				
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $rw->nama ?></td>
					<td><?php echo hitung_umur($rw->tanggal_lahir) ?></td>
					<td><?php echo get_data('member','id_member',$rw->id_member,'email') ?></td>
					<td>
						<a href="rekam_medis/lihat/<?php echo $rw->id_pasien ?>" class="label label-info">Lihat</a>
						<a href="#" class="label label-default" data-toggle="modal" data-target="#mdlAkun<?php echo $rw->id_pasien ?>">Kaitkan Akun</a>

						<div class="modal fade" id="mdlAkun<?php echo $rw->id_pasien ?>" style="display: none;">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">×</span></button>
						        <h4 class="modal-title">Kaitkan Akun</h4>
						      </div>
						      <div class="modal-body">
						        <form action="pasien/kaitkan_akun/<?php echo $rw->id_pasien ?>" method="POST" class="form-horizontal">
						          <div class="box-body">
						            
						            <div class="form-group">
						              <label class="col-sm-4 control-label text-left">Alamat Email</label>
						              <div class="col-sm-8">
						                <select name="id_member" class="form-control select2" id="id_member" style="width: 100%">
								    		<option>--Pilih Akun--</option>
								    		<?php
								    		$dokter = $this->db->get('member');
								    		 foreach ($dokter->result() as $row):
								    		 	$selected = ($rw->id_member == $row->id_member) ? 'selected' : '';
								    		  ?>
								    			<option value="<?php echo $row->id_member ?>" <?php echo $selected ?>><?php echo $row->email ?></option>
								    		<?php endforeach ?>
								    	</select>
						                <span id="rsl_email"></span>
						              </div>
						            </div>

						            
						            
						          </div>
						          <!-- /.box-body -->
						          
						        
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary">Simpan</button>
						        </form>
						      </div>
						    </div>
						    <!-- /.modal-content -->
						  </div>
						  <!-- /.modal-dialog -->
						</div>

					</td>
				</tr>

				<?php $no++; endforeach ?>
			</tbody>
		</table>
		</div>
	</div>
</div>

