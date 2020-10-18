
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('pasien/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pasien/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pasien'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama</th>
		<th>Tanggal Lahir</th>
		<th>Jenis Kelamin</th>
		<th>Nama Ayah</th>
		<th>Nama Ibu</th>
		<th>Alamat</th>
		<th>No Telp</th>
		<th>No Hp</th>
		<th>Akun Member</th>
		<th>Action</th>
            </tr><?php
            foreach ($pasien_data as $pasien)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pasien->nama ?></td>
			<td><?php echo $pasien->tanggal_lahir ?></td>
			<td><?php echo $pasien->jenis_kelamin ?></td>
			<td><?php echo $pasien->nama_ayah ?></td>
			<td><?php echo $pasien->nama_ibu ?></td>
			<td><?php echo $pasien->alamat ?></td>
			<td><?php echo $pasien->no_telp ?></td>
			<td><?php echo $pasien->no_hp ?></td>
			<td><?php echo get_data('member','id_member',$pasien->id_member,'nama') ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pasien/update/'.$pasien->id_pasien),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('pasien/delete/'.$pasien->id_pasien),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    