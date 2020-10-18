<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?php echo base_url() ?>">
	<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body onload="print()">
	
	<center><h2>Nota Pembayaran</h2></center>

	<hr>
	<?php 
	$rw = $this->db->get_where('pembayaran', array('id_pembayaran'=>$this->uri->segment(3)))->row();
	 ?>
	<table class="table">
		<tr>
			<td>Tanggal</td>
			<td><?php echo $rw->tanggal_bayar ?></td>
		</tr>
		<tr>
			<td>Bulan</td>
			<td><?php echo $rw->bulan ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td><?php echo $rw->tahun ?></td>
		</tr>
		<tr>
			<td>Jumlah Bayar</td>
			<td><?php echo $rw->jumlah_bayar ?></td>
		</tr>
	</table>

	
</body>
</html>