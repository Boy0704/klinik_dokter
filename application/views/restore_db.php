<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Restore Database</div>
			<div class="panel-body">
				<form action="app/aksi_restore" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>Upload File Database</label>
						<input type="file" name="file_db" class="form-control">
						<p style="color: red">
							*) File yang di upload harus extention : .sql <br>
							*) Maksimal file adalah 1 MB
						</p>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>