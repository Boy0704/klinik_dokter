
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <form action="" method="GET">
                    <div class="form-group">
                        <label>Berdasarkan Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?php echo (isset($_GET['tanggal'])) ? $_GET['tanggal'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <?php if (get_data('setting','nama','akses_konfirmasi','value') == '0'): ?>
                    <a href="app/set_konfirmasi/buka" class="btn btn-success"><i class="fa fa-lock"></i> Buka Konfirmasi di Akun User</a>
                <?php else: ?>
                    <a href="app/set_konfirmasi/tutup" class="btn btn-info"><i class="fa fa-unlock"></i> Tutup Konfirmasi di Akun User</a>
                <?php endif ?>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
		<th>No Antrian</th>
		<th>Nama Pasien</th>
		<th>Konfirmasi</th>
		<th>Date Konfirmasi</th>
		<th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($_GET) {
            $this->db->where('tgl_kunjungan', $this->input->get('tanggal'));
        } else {
            $this->db->where('tgl_kunjungan', date('Y-m-d'));
        }
        $antrian_data = $this->db->get('antrian')->result();
            foreach ($antrian_data as $antrian)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $antrian->no_antrian ?></td>
			<td><?php echo get_data('pasien','id_pasien',$antrian->id_pasien,'nama') ?></td>
			
			<td><?php echo $retVal = ($antrian->konfirmasi == 'y') ? '<span class="label label-success">dikonfirmasi</span>' : '<span class="label label-danger">belum konfirmasi</span>' ; ?></td>
			<td><?php echo $antrian->date_konfirmasi ?></td>
			<td style="text-align:center" width="200px">
                <a href="https://api.whatsapp.com/send?phone=6285273592655&text=Ini tes wa !" class="label label-default" target="_blank">WA</a>
                <?php if ($antrian->konfirmasi == 't'): ?>
                    <a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/update_konfirmasi/<?php echo $antrian->id_antrian ?>/y/<?php echo $this->input->get('tanggal') ?>" class="label label-warning">Konfirmasi</a>
                <?php else: ?>
                    <a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/update_konfirmasi/<?php echo $antrian->id_antrian ?>/t/<?php echo $this->input->get('tanggal') ?>" class="label label-success">Batal Konfirmasi</a>
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
        </tbody>
        </table>
        </div>
        
    