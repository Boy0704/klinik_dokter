<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">Peserta</a></li>
		    <li><a data-toggle="tab" href="#menu1">No Antrian</a></li>
		  </ul>

		  <div class="tab-content">
		    <div id="home" class="tab-pane fade in active">
		    	<br>
		    	<a href="app/tambah_peserta" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Peserta</a>

		    	<br><br>
		    	<div class="table-responsive">
		
				<button class="btn btn-warning btn-block" disabled="">PESERTA</button><br>
				<table class="table table-bordered" id="example1">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Peserta</th>
							<th>Umur</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						$no = 1;
						$this->db->where('id_member', $this->session->userdata('id_user'));
						$this->db->where('aktif','1');
						$this->db->order_by('id_pasien', 'desc');
						$pasien = $this->db->get('pasien');
						foreach ($pasien->result() as $rw) {
						 ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $rw->nama. $retVal = ($rw->nama == $this->session->userdata('nama')) ? ' (Penanggung Jawab)' : '' ; ?></td>
							<td><?php echo hitung_umur($rw->tanggal_lahir) ?></td>
							<td>
								<a href="app/jadwal_dokter/<?php echo $rw->id_pasien ?>" class="label label-info">Pilih Jadwal Kunjungan</a>

								

								<a href="" data-toggle="modal" data-target="#<?php echo $rw->id_pasien ?>mDetail" class="label label-success">Detail</a>

								<!-- Modal -->
								<div class="modal fade" id="<?php echo $rw->id_pasien ?>mDetail" role="dialog">
								<div class="modal-dialog">

								  <!-- Modal content-->
								  <div class="modal-content">
								    <div class="modal-header">
								      <button type="button" class="close" data-dismiss="modal">&times;</button>
								      <h4 class="modal-title">Detail Peserta</h4>
								    </div>
								    <div class="modal-body">
								    	<?php $dt = $this->db->get_where('pasien', array('id_pasien'=>$rw->id_pasien))->row(); ?>
								    	<table class="table">
								    		<tr>
								    			<td>Nama</td>
								    			<td><?php echo $dt->nama ?></td>
								    		</tr>
								    		<tr>
								    			<td>Tanggal Lahir</td>
								    			<td><?php echo $dt->tanggal_lahir ?></td>
								    		</tr>
								    		<tr>
								    			<td>Jenis Kelamin</td>
								    			<td><?php echo $dt->jenis_kelamin ?></td>
								    		</tr>
								    		<tr>
								    			<td>Nama Ayah</td>
								    			<td><?php echo $dt->nama_ayah ?></td>
								    		</tr>
								    		<tr>
								    			<td>Nama Ibu</td>
								    			<td><?php echo $dt->nama_ibu ?></td>
								    		</tr>
								    		<tr>
								    			<td>Alamat</td>
								    			<td><?php echo $dt->alamat ?></td>
								    		</tr>
								    		<tr>
								    			<td>No Telp/ WA</td>
								    			<td><?php echo $dt->no_telp ?></td>
								    		</tr>
								    	</table>
								    </div>
								    <div class="modal-footer">
								      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								    </div>
								  </div>
								  
								</div>
								</div>

								<a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/hapus_peserta/<?php echo $rw->id_pasien ?>" class="label label-danger">Hapus</a>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
				</div>

		      
		    </div>
		    <div id="menu1" class="tab-pane fade">
				<div class="table-responsive">
		
				<button class="btn btn-warning btn-block" disabled="">DAFTAR ANTRIAN</button><br>
				<table class="table table-bordered" id="example1">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Pasien</th>
							<th>Umur</th>
							<th>Tanggal Kunjungan</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						$no = 1;
						$this->db->select('b.nama,a.*,b.tanggal_lahir');
						$this->db->join('antrian a', 'a.id_pasien = b.id_pasien', 'inner');
						$this->db->where('tgl_kunjungan!=', '');
						$this->db->order_by('id_antrian', 'desc');
						$pasien = $this->db->get('pasien b');
						foreach ($pasien->result() as $rw) {
						 ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $rw->nama ?></td>
							<td><?php echo hitung_umur($rw->tanggal_lahir) ?></td>
							<td><?php echo $rw->tgl_kunjungan ?></td>
							<td>
								<?php if ($rw->konfirmasi == 't'): ?>
									<a onclick="javasciprt: return confirm('Pastikan nomor whatsapp/HP utama benar dan sudah update agar dapat dihubungi beserta kolom notes input untuk admin ?')" href="app/update_konfirmasi/<?php echo $rw->id_antrian ?>/y" class="label label-success">Konfirmasi</a>
								<?php else: ?>
									<a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/update_konfirmasi/<?php echo $rw->id_antrian ?>/t" class="label label-warning">Batal Konfirmasi</a>
									<a href="app/lihat_semua_antrian/<?php echo $rw->id_jadwal.'/'.$rw->tgl_kunjungan ?>" class="label label-info">Lihat Semua Antrian</a>
								<?php endif ?>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
				</div>
		    </div>
		    
		  </div>
	</div>
</div>








