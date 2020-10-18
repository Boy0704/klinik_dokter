
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('rekam_medis/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('rekam_medis/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('rekam_medis'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Pasien</th>
		<th>Riwayat Peyakit</th>
		<th>Keluhan Penyakit</th>
		<th>Create At</th>
		<th>Action</th>
            </tr><?php
            foreach ($rekam_medis_data as $rekam_medis)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo get_data('pasien','id_pasien',$rekam_medis->id_pasien,'nama') ?></td>
			<td><?php echo $rekam_medis->riwayat_peyakit ?></td>
			<td><?php echo $rekam_medis->keluhan_penyakit ?></td>
			<td><?php echo $rekam_medis->create_at ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('rekam_medis/update/'.$rekam_medis->id_rekam_medis),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('rekam_medis/delete/'.$rekam_medis->id_rekam_medis),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    