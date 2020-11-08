<div class="row">
	<div class="col-md-12">
		<?php if ($this->session->userdata('level') == 'admin'): ?>
			<div class="alert alert-success alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <h5>Selamat datang, <?php echo $this->session->userdata('nama'); ?></h5>
			</div>
		<?php endif ?>
		<?php if ($this->session->userdata('level') == 'user'): ?>
			<div class="alert alert-info">
				Silahkan Klik Menu Pendaftaran untuk mendapatkan No Antrian.
			</div>
		<?php endif ?>
	</div>

</div>


<?php if ($this->session->userdata('level') =='user'): ?>
	


<?php 

$no = 1;
$this->db->select('b.nama,a.*,b.tanggal_lahir');
$this->db->join('antrian a', 'a.id_pasien = b.id_pasien', 'inner');
$this->db->where('tgl_kunjungan!=', '');
$this->db->where('b.id_member', $this->session->userdata('id_user'));
$this->db->order_by('id_antrian', 'desc');
$pasien = $this->db->get('pasien b');
foreach ($pasien->result() as $rw) {
 ?>

<div class="row">
	<div class="col-md-12">
	<div class="box box-warning">
		<div class="box-header with-border">
		  <h3 class="box-title">Kunjungan Dengan <?php echo get_data('jadwal','id_jadwal',$rw->id_jadwal,'dokter'); ?></h3>

		  <div class="box-tools pull-right">
		  	<a href="app" class="btn btn-box-tool"><i class="fa fa-refresh"></i> Refresh</a>
		    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		    </button>
		  </div>
		  <!-- /.box-tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body">

			<div class="row">
				<div class="col-md-8">
					
					<table class="table table-stripped">
						<thead>
							<tr>
								<td>Nama Pasien</td>
								<td><?php echo $rw->nama ?></td>
							</tr>
							<tr>
								<td>Tanggal Kunjungan</td>
								<td><?php echo $rw->tgl_kunjungan ?></td>
							</tr>
						</thead>
					</table>

				</div>

				<div class="col-md-4">
					<?php if ($rw->konfirmasi == 't'): ?>
						<a onclick="javasciprt: return confirm('Yakin akan konfimasi kedatangan sekarang juga ?')" href="app/update_konfirmasi/<?php echo $rw->id_antrian ?>/y" class="btn btn-primary btn-block">Konfirmasi Kehadiran</a>
					<?php else: ?>
						<a onclick="javasciprt: return confirm('Apakah kamu yakin akan membatalkan konfirmasi kedatangan ?')" href="app/update_konfirmasi/<?php echo $rw->id_antrian ?>/t" class="btn btn-warning btn-block">Batal Konfirmasi</a>
					<?php endif ?>

					<a onclick="javasciprt: return confirm('Yakin akan hapus jadwal kunjungan ini ?')" href="app/hapus_kunjungan/<?php echo $rw->id_antrian ?>/y" class="btn btn-danger btn-block">Hapus</a>


		        </div>

			</div>
			
			<?php if ($rw->konfirmasi == 'y'): ?>
			<div class="row">
				<div class="col-md-4">
		          <div class="info-box" style="border: solid 1px black;">
		            <span class="info-box-icon bg-aqua"><i class="fa fa-send"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Urutan KE</span>
		              <span class="info-box-number">
		              	<?php 
		              	$urut = 0;
		              	$no = 0;
		              	$this->db->select('id_pasien');
		              	$this->db->where('id_jadwal', $rw->id_jadwal);
		              	$this->db->where('tgl_kunjungan', $rw->tgl_kunjungan);
		              	$this->db->where('konfirmasi', 'y');
		              	$this->db->order_by('date_konfirmasi', 'asc');
		              	$urutan = $this->db->get('antrian')->result();
		              	foreach ($urutan as $br) {
		              		$no++;
		              		if ($br->id_pasien == $rw->id_pasien) {
		              			$urut = $no;
		              		}
		              	
		              	}
		              	echo $urut;
		              	 ?>
		              </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>

		        <div class="col-md-4">
		          <div class="info-box" style="border: solid 1px black;">
		            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Total </span>
		              <span class="info-box-number">
		              	<?php 
		              	$this->db->where('id_jadwal', $rw->id_jadwal);
		              	$this->db->where('tgl_kunjungan', $rw->tgl_kunjungan);
		              	$this->db->where('date_konfirmasi!=', '');
		              	$total = $this->db->get('antrian')->num_rows();
		              	echo $total;
		              	 ?>
		              </span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>
		        
			</div>
			<?php endif ?>

		</div>
		<!-- /.box-body -->
		</div>
	<!-- /.box -->
	</div>
</div>
<?php } ?>

<?php endif ?>
