<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>Dokter</label>
			<select name="dokter" class="form-control select2" id="pilih_dokter">
	    		<option>--Pilih Dokter--</option>
	    		<?php
	    		$this->db->group_by('dokter');
	    		$dokter = $this->db->get('jadwal');
	    		 foreach ($dokter->result() as $row): ?>
	    			<option value="<?php echo $row->dokter ?>"><?php echo $row->dokter ?></option>
	    		<?php endforeach ?>
	    	</select>
		</div>
		
		<br>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
				<tr>
					<td>No</td>
					<td>Dokter</td>
					<td>Hari</td>
					<td>Tanggal</td>
					<td>Jam Praktek</td>
					<td>Pilihan</td>
				</tr>
				</thead>
				<tbody id="list_jadwal">
					
				</tbody>
				
			</table>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#pilih_dokter").change(function() {
			$.ajax({
				url: 'app/get_data_jadwal',
				type: 'POST',
				dataType: 'html',
				data: {dokter: $(this).val(),id_pasien: <?php echo $this->uri->segment(3); ?>},
			})
			.done(function(hasil) {
				console.log("success");
				$("#list_jadwal").html(hasil);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
	});
</script>