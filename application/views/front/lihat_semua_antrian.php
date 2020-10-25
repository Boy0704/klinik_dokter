<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered" id="example1">
				<thead>
					<tr>
						<th width="100">No.</th>
						<th>Nama</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no=1;
					$this->db->where('id_jadwal', $this->uri->segment(3));
					$this->db->where('tgl_kunjungan', $this->uri->segment(4));
					$data = $this->db->get('antrian');
					foreach ($data->result() as $rw): ?>
					
					<tr>
						<td><?php echo $no ?></td>
						<td><?php echo get_data('pasien','id_pasien',$rw->id_pasien,'nama') ?></td>
					</tr>
					<?php $no++; endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>