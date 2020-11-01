<?php $data = $data_profil->row(); ?>
<div class="row">
	<div class="col-md-6">
		<form action="app/simpan_pendaftaran" method="POST">
			<div class="form-group">
				<label>Nama Peserta </label>
				<!-- <select name="pasien" class="form-control" id="pilih_peserta" required="">
					<option value="">Pilih Nama</option>
					<option value="<?php echo $this->session->userdata('nama'); ?>"><?php echo $this->session->userdata('nama'); ?> - Penanggung Jawab</option>
					<?php
					$this->db->where('nama !=', $this->session->userdata('nama'));
					$this->db->where('id_member', $this->session->userdata('id_user'));
					 foreach ($this->db->get('pasien')->result() as $rw): ?>
						<option value="<?php echo $rw->id_pasien ?>"><?php echo $rw->nama ?></option>
					<?php endforeach ?>
				</select> -->
				<input type="text" name="nama" id="pasien" class="form-control" required="">
				<br> <input type="checkbox" id="penanggung_jawab"> Nama sesuai akun
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
				<label>Umur</label>
				<input type="text" name="umur" class="form-control" id="umur">
			</div>
			<div id="detail">
				<!-- <div class="form-group">
					<label>Nama Ayah </label>
					<input type="text" name="nama_ayah" class="form-control" id="nama_ayah">
				</div>
				<div class="form-group">
					<label>Nama Ibu </label>
					<input type="text" name="nama_ibu" class="form-control" id="nama_ibu">
				</div> -->
				<div class="form-group">
					<label>Alamat </label>
					<input type="text" name="alamat" class="form-control" value="<?php echo $data->alamat; ?>" id="alamat" readonly>
				</div>
				
				<div class="form-group">
					<label>No Handphone / WA </label>
					<input type="text" name="no_hp" class="form-control" value="<?php echo $data->no_telp; ?>" id="no_hp" readonly>
				</div>
				<div class="form-group">
					<label>No Telp Alternatif </label>
					<input type="text" name="no_telp" value="<?php echo $data->no_alternatif; ?>" class="form-control" id="no_telp" readonly>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">SIMPAN</button>
			</div>
		</form>
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
				$("#umur").val(hasil);
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

		$("#penanggung_jawab").click(function(event) {
			if ($(this).prop('checked') == true) {
				$("#pasien").val("<?php echo $this->session->userdata('nama'); ?>");
				$("#pasien").prop('readonly', true);
				$("#detail").hide();
			} else {
				$("#pasien").val("");
				$("#pasien").prop('readonly', false);
				$("#detail").show();
			}
			
		});
	});
</script>