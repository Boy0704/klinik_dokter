<div class="row">
	<div class="col-md-6">
		<h5>Cetak Transaksi (Harian/Bulan/Tahun)</h5>
		<hr>
		<form action="app/cetak_pembayaran#" method="GET" target="_blank">
			<div class="form-group">
				<label>Dari</label>
				<input type="date" name="tgl1" class="form-control">
			</div>
			<div class="form-group">
				<label>Sampai</label>
				<input type="date" name="tgl2" class="form-control">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Cetak</button>
			</div>
		</form>
	</div>
</div>