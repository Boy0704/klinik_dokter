<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body onload="print()">

<?php 
$this->db->where('id_antrian', $this->uri->segment(3));
$dt = $this->db->get('antrian')->row();
 ?>

<center>
	<u><h1><?php echo get_data('jadwal','id_jadwal',$dt->id_jadwal,'dokter') ?></h1></u>
	<?php echo get_data('setting','nama','alamat','value') ?>
</center>
<hr>
<p style="text-align: right;"><b>Tanggerang</b>, <?php echo date('d-m-Y') ?></p>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<table style="text-align: left;">
	<tr>
		<th>Pro</th>
		<td>:</td>
		<td><?php echo get_data('pasien','id_pasien',$dt->id_pasien,'nama') ?></td>
	</tr>
	<tr>
		<th>Umur</th>
		<td>:</td>
		<td><?php echo hitung_umur(get_data('pasien','id_pasien',$dt->id_pasien,'tanggal_lahir')) ?></td>
	</tr>

	<tr>
		<th>Alamat</th>
		<td>:</td>
		<td><?php echo get_data('pasien','id_pasien',$dt->id_pasien,'alamat') ?></td>
	</tr>
	<tr>
		<th>Telp / HP</th>
		<td>:</td>
		<td><?php echo get_data('pasien','id_pasien',$dt->id_pasien,'no_telp') ?></td>
	</tr>


</table>
<center>
	<u><h3>Obat tidak boleh diganti tanpa persetujuan Dokter</h3></u>
</center>

</body>
</html>