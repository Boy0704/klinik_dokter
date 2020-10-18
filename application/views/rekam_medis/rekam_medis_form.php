
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Nama Pasien <?php echo form_error('id_pasien') ?></label>
            <!-- <input type="text" class="form-control" name="id_pasien" id="id_pasien" placeholder="Id Pasien" value="<?php echo $id_pasien; ?>" /> -->
            <select name="id_pasien" class="form-control select2">
                <option value="">--Pilih--</option>
                <?php foreach ($this->db->get('pasien')->result() as $rw): 
                    if ($id_pasien == $rw->id_pasien) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                ?>
                    <option value="<?php echo $rw->id_pasien ?>" <?php echo $selected ?>><?php echo $rw->nama ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="riwayat_peyakit">Riwayat Peyakit <?php echo form_error('riwayat_peyakit') ?></label>
            <textarea class="form-control" rows="3" name="riwayat_peyakit" id="riwayat_peyakit" placeholder="Riwayat Peyakit"><?php echo $riwayat_peyakit; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="keluhan_penyakit">Keluhan Penyakit <?php echo form_error('keluhan_penyakit') ?></label>
            <textarea class="form-control" rows="3" name="keluhan_penyakit" id="keluhan_penyakit" placeholder="Keluhan Penyakit"><?php echo $keluhan_penyakit; ?></textarea>
        </div>
	    <input type="hidden" name="id_rekam_medis" value="<?php echo $id_rekam_medis; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('rekam_medis') ?>" class="btn btn-default">Cancel</a>
	</form>
   