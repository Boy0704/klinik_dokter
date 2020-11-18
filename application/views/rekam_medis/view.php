<div class="row">
	<div class="col-md-4">
		<a href="#sdfd" class="btn btn-primary">Tambah Pasien</a>
	</div>
	<div class="col-md-4">
		
	</div>
	<div class="col-md-4">
		<label>Berdasarkan Tgl Kunjungan</label>
		<input type="date" name="" class="form-control"><br>
		<button type="submit" class="btn btn-primary"> Cari</button>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Pasien</th>
					<th>Umur</th>
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
					<td>
						<a href="rekam_medis/lihat/<?php echo $rw->id_pasien ?>" class="label label-info">Lihat</a>
					</td>
				</tr>

				<?php $no++; endforeach ?>
			</tbody>
		</table>
	</div>
</div>