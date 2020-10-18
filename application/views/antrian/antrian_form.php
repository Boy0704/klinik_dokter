
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">No Antrian <?php echo form_error('no_antrian') ?></label>
            <input type="text" class="form-control" name="no_antrian" id="no_antrian" placeholder="No Antrian" value="<?php echo $no_antrian; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Pasien <?php echo form_error('id_pasien') ?></label>
            <input type="text" class="form-control" name="id_pasien" id="id_pasien" placeholder="Id Pasien" value="<?php echo $id_pasien; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Create At <?php echo form_error('create_at') ?></label>
            <input type="text" class="form-control" name="create_at" id="create_at" placeholder="Create At" value="<?php echo $create_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Konfirmasi <?php echo form_error('konfirmasi') ?></label>
            <input type="text" class="form-control" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi" value="<?php echo $konfirmasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Date Konfirmasi <?php echo form_error('date_konfirmasi') ?></label>
            <input type="text" class="form-control" name="date_konfirmasi" id="date_konfirmasi" placeholder="Date Konfirmasi" value="<?php echo $date_konfirmasi; ?>" />
        </div>
	    <input type="hidden" name="id_antrian" value="<?php echo $id_antrian; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('antrian') ?>" class="btn btn-default">Cancel</a>
	</form>
   