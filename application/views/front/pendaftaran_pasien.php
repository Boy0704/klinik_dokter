<div class="row">
	<div class="col-md-6">
		<form action="app/simpan_pendaftaran" method="POST">
			<div class="form-group">
				<label>Nama Pasien (Bayi/Anak) </label>
				<input type="text" name="nama" class="form-control">
			</div>
			<div class="form-group">
				<label>Jenis Kelamin </label>
				<div class="radio">
				  <label><input type="radio" name="jenis_kelamin" value="L" >Laki-laki</label>
				  <span style="margin-left: 20px;"></span>
				  <label><input type="radio" name="jenis_kelamin" value="P" >Perempuan</label>
				</div>
			</div>
			<div class="form-group">
				<label>Tgl Lahir </label>
				<input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
			</div>
			<div class="form-group">
				<label>Nama Ayah </label>
				<input type="text" name="nama_ayah" class="form-control" id="nama_ayah">
			</div>
			<div class="form-group">
				<label>Nama Ibu </label>
				<input type="text" name="nama_ibu" class="form-control" id="nama_ibu">
			</div>
			<div class="form-group">
				<label>Alamat </label>
				<input type="text" name="alamat" class="form-control">
			</div>
			<div class="form-group">
				<label>No Telp Rumah </label>
				<input type="text" name="no_telp" class="form-control">
			</div>
			<div class="form-group">
				<label>No Handphone / WA </label>
				<input type="text" name="no_hp" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">SIMPAN</button>
			</div>
		</form>
	</div>
	<div class="col-md-6">
		<button class="btn btn-info btn-block" disabled="">JADWAL KLINIK</button><br>
		<table class="table table-stripped">
			<thead>
				<tr>
					<th>Hari</th>
					<th>Jam Mulai</th>
					<th>Jam Selesai</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->db->get('jadwal')->result() as $br): ?>
				<tr>
					<td><?php echo $br->hari ?></td>
					<td><?php echo $br->dari ?></td>
					<td><?php echo $br->sampai ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			
		
		<button class="btn btn-warning btn-block" disabled="">NO ANTRIAN</button><br>
		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th>No.</th>
					<th>No Antrian</th>
					<th>Nama Pasien</th>
					<th>Umur</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php 

				$no = 1;
				$this->db->select('b.nama,a.*,b.tanggal_lahir');
				$this->db->join('antrian a', 'a.id_pasien = b.id_pasien', 'inner');
				$pasien = $this->db->get('pasien b');
				foreach ($pasien->result() as $rw) {
				 ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<button class="btn btn-info"><?php echo $rw->no_antrian ?></button>
					</td>
					<td><?php echo $rw->nama ?></td>
					<td><?php echo hitung_umur($rw->tanggal_lahir) ?></td>
					<td>
						<?php if ($rw->konfirmasi == 't'): ?>
							<a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/update_konfirmasi/<?php echo $rw->id_antrian ?>" class="btn btn-sm btn-warning">Konfirmasi</a>
						<?php else: ?>
							<span class="label label-success">Sudah dikonfirmasi</span>
						<?php endif ?>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$("#tgl_lahir").change(function(event) {
			var tgl_lahir = $(this).val();
			$.ajax({
				url: 'app/cek_umur',
				type: 'POST',
				dataType: 'html',
				data: {tgl_lahir: tgl_lahir},
			})
			.done(function(hasil) {
				console.log("success");
				console.log(hasil);
				if (hasil > 18) {
					$('#nama_ayah').prop('readonly', true);
					$('#nama_ibu').prop('readonly', true);
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	});
</script>