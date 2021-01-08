<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Setting Alamat</div>
			<div class="panel-body">
				<form action="" method="POST">
					<div class="form-group">
						<label>Alamat</label>
						<input type="hidden" name="aksi" value="ubah_alamat">
						<textarea class="form-control editor" name="alamat"><?php echo get_data('setting','nama','alamat','value') ?></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>