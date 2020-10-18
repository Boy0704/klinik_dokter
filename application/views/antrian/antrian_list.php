
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('antrian/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('antrian/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('antrian'); ?>" class="btn btn-default">Reset</a>
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
		<th>No Antrian</th>
		<th>Nama Pasien</th>
		<th>Create At</th>
		<th>Konfirmasi</th>
		<th>Date Konfirmasi</th>
		<th>Action</th>
            </tr><?php
            foreach ($antrian_data as $antrian)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $antrian->no_antrian ?></td>
			<td><?php echo get_data('pasien','id_pasien',$antrian->id_pasien,'nama') ?></td>
			<td><?php echo $antrian->create_at ?></td>
			<td><?php echo $retVal = ($antrian->konfirmasi == 'y') ? '<span class="label label-success">dikonfirmasi</span>' : '<span class="label label-danger">belum konfirmasi</span>' ; ?></td>
			<td><?php echo $antrian->date_konfirmasi ?></td>
			<td style="text-align:center" width="200px">

                <?php if ($antrian->konfirmasi == 't'): ?>
                    <a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/update_konfirmasi/<?php echo $antrian->id_antrian ?>" class="label label-warning">Konfirmasi</a>
                <?php endif ?>
				<?php 
				echo anchor(site_url('antrian/update/'.$antrian->id_antrian),'<span class="label label-info">Ubah</span>'); 
				echo '  '; 
				echo anchor(site_url('antrian/delete/'.$antrian->id_antrian),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    