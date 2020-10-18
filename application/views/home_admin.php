<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success">
			<h2>Selamat datang, <?php echo $this->session->userdata('nama'); ?></h2>
		</div>
		<?php if ($this->session->userdata('level') == 'user'): ?>
			<div class="alert alert-info">
				Silahkan Klik Menu Pendaftaran untuk mendapatkan No Antrian.
			</div>
		<?php endif ?>
	</div>

</div>
