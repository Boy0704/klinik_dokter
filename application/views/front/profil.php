<?php $rw = $data_profil->row(); ?>
<div class="row">
	<div class="col-md-12">
		<form name="app/update_profil" method="POST">
			<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" name="nama" class="form-control" value="<?php echo $rw->nama ?>" required="">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control" value="<?php echo $rw->email ?>" required="">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="text" name="password" class="form-control" placeholder="Kosongkan jika tidak diisi" >
				<input type="hidden" name="password_old" value="<?php echo $rw->password ?>">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<input type="text" name="alamat" class="form-control" required="">
			</div>
			<div class="form-group">
				<label>No Hp / WA</label>
				<input type="text" name="no_telp" class="form-control" required="">
			</div>
			<div class="form-group">
				<label>No Telp</label>
				<input type="text" name="no_alternatif" class="form-control" required="">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update Profil</button>
			</div>
		</form>
	</div>
</div>