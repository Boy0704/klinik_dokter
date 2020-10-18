<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?php echo base_url() ?>">
	<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body onload="print()">
	<?php 
	$tgl1 = $_GET['tgl1'];
	$tgl2 = $_GET['tgl2'];
	 ?>
	<center><h2>Cetak Pembayaran</h2></center>

	<hr>

	<div>
		<h5>Tanggal : <?php echo $tgl1.' - '.$tgl2 ?></h5>
	</div>

	<table class="table table-bordered table-stripped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tanggal Bayar</th>
				<th>Pedagang</th>
				<th>Bulan</th>
				<th>Tahun</th>
				<th>Jumlah Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no =1;
			$total = 0;
			$sql = "SELECT * FROM pembayaran WHERE tanggal_bayar BETWEEN '$tgl1' AND '$tgl2' ";
			foreach ($this->db->query($sql)->result() as $rw): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $rw->tanggal_bayar ?></td>
					<td><?php echo get_data('pedagang','id_pedagang',$rw->id_pedagang,'nama') ?></td>
					<td><?php echo $rw->bulan ?></td>
					<td><?php echo $rw->tahun ?></td>
					<td><?php echo number_format($rw->jumlah_bayar); $total = $total + $rw->jumlah_bayar ?></td>
				</tr>
			<?php $no++; endforeach ?>
			<tr>
				<td colspan="5"><b>Total </b></td>
				<td><?php echo number_format($total) ?></td>
			</tr>
		</tbody>
	</table>

</body>
</html>