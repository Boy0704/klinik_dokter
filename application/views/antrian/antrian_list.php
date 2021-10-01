
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
        <div style="margin-bottom: 10px;">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#mdlTambah">
                <i class="fa fa-plus"></i> Tambah Antrian
              </button>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px" id="example2">
            <thead>
            <tr>
                <th>No</th>
		<!-- <th>No Antrian</th> -->
        <th>Nama Pasien</th>
        <th>Jadwal dipilih</th>
		<th>Dokter</th>
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
        $this->db->order_by('date_konfirmasi', 'asc');
        $antrian_data = $this->db->get('antrian')->result();
            foreach ($antrian_data as $antrian)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<!-- <td><?php echo $antrian->no_antrian ?></td> -->
			<td><?php echo get_data('pasien','id_pasien',$antrian->id_pasien,'nama') ?></td>
			<td>
                <?php 
                $hari = get_data('jadwal','id_jadwal',$antrian->id_jadwal,'hari');
                $dari = get_data('jadwal','id_jadwal',$antrian->id_jadwal,'dari');
                $sampai = get_data('jadwal','id_jadwal',$antrian->id_jadwal,'sampai');
                $dokter = get_data('jadwal','id_jadwal',$antrian->id_jadwal,'dokter');
                echo  $hari .', '.$dari.' - '.$sampai
                 ?>         
            </td>
            <td>
                <?php echo $dokter ?>
            </td>
			<td><?php echo $retVal = ($antrian->konfirmasi == 'y') ? '<span class="label label-success">dikonfirmasi</span>' : '<span class="label label-danger">belum konfirmasi</span>' ; ?></td>
			<td><?php echo $antrian->date_konfirmasi ?></td>
			<td style="text-align:center" width="200px">
                <?php if ($antrian->status_kunjungan == 'close'): ?>
                <label class="label label-success"><i>Kunjungan selesai</i></label>

                <?php else: 
                  
                  $no_wa = get_data('pasien','id_pasien',$antrian->id_pasien,'no_telp');
                  ?>
                
                <a href="https://api.whatsapp.com/send?phone=62<?php echo $no_wa ?>&text=Ini tes wa !" class="label label-default" target="_blank">WA</a>
                <?php if ($antrian->konfirmasi == 't'): ?>
                    <a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/update_konfirmasi/<?php echo $antrian->id_antrian ?>/y/<?php echo $this->input->get('tanggal') ?>" class="label label-warning">Konfirmasi</a>
                <?php else: ?>

                    <a href="#" data-toggle="modal" data-target="#mdlCall_<?php echo $antrian->id_antrian ?>" class="label label-warning">Panggil Pasien</a>

                    <!-- Modal -->
                    <div id="mdlCall_<?php echo $antrian->id_antrian ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Konfirmasi Panggil</h4>
                          </div>
                          <div class="modal-body">
                            <center>
                                <?php 
                                $get = '';
                                if ($_GET) {
                                    $get = "?tanggal=".$_GET['tanggal'];
                                }
                                 ?>
                                <a href="antrian/skip_panggilan/<?php echo $antrian->id_antrian.$get ?>" class="btn btn-primary">LEWATI</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="antrian/simpan_panggilan/<?php echo $antrian->id_antrian.$get ?>" class="btn btn-success">TERIMA</a>
                            </center>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

                    <a onclick="javasciprt: return confirm('Apakah kamu yakin ?')" href="app/update_konfirmasi/<?php echo $antrian->id_antrian ?>/t/<?php echo $this->input->get('tanggal') ?>" class="label label-success">Batal Konfirmasi</a>
                <?php endif ?>
				<?php 
				echo anchor(site_url('antrian/update/'.$antrian->id_antrian),'<span class="label label-info">Ubah</span>'); 
				echo '  '; 
				echo anchor(site_url('antrian/delete/'.$antrian->id_antrian),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
                <?php endif ?>
			</td>
		</tr>
                <?php
            }
            ?>
        </tbody>
        </table>
        </div>
        

<div class="modal fade" id="mdlTambah" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Antrian</h4>
      </div>
      <div class="modal-body">
        <form action="antrian/simpan_antrian_manual" method="POST" class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label text-left">Nama Pasien</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pasien">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label text-left">Tanggal Lahir</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Nama Pasien">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label text-left">No Hp</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No HP">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label text-left">Alamat Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                <span id="rsl_email"></span>
              </div>
            </div>

            <hr>

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
                        <?php 
                        $no = 1;
                        foreach (list_date() as $jd): 
                            $this->db->where('hari', cek_hari($jd->format("Y-m-d")));
                            $data_jadwal = $this->db->get('jadwal');
                            if ($data_jadwal->num_rows() > 0) {
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $data_jadwal->row()->dokter ?></td>
                                    
                                    <td><?php echo $data_jadwal->row()->hari ?></td>
                                    <td><?php echo $jd->format("Y-m-d"); ?></td>
                                    <td><?php echo $data_jadwal->row()->dari.' - '.$data_jadwal->row()->sampai ?></td>
                                    <td>
                                        <input type="radio" name="id_jadwal" value="<?php echo $data_jadwal->row()->id_jadwal ?>"> 
                                    </td>
                                </tr>
                                <?php
                            } 

                            
                            
                        $no++; endforeach;
                         ?>
                    </tbody>
                    
                </table>
            </div>
            
          </div>
          <!-- /.box-body -->
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#email").keyup(function() {
            var email = $(this).val();
            $.ajax({url: "antrian/cek_email/"+email, 
                beforeSend: function(){ },
                success: function(result){
                    $("#rsl_email").html(result);
                  console.log("success");
                },
                complete:function(data){ }
            });
        });
    });
</script>
    