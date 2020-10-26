
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="pemberitahuan">Pemberitahuan <?php echo form_error('pemberitahuan') ?></label>
            <textarea class="form-control" rows="3" name="pemberitahuan" id="pemberitahuan" placeholder="Pemberitahuan"><?php echo $pemberitahuan; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="enum">Aktif <?php echo form_error('aktif') ?></label>
            <input type="text" class="form-control" name="aktif" id="aktif" placeholder="Aktif" value="<?php echo $aktif; ?>" />
        </div>
	    <input type="hidden" name="id_pemberitahuan" value="<?php echo $id_pemberitahuan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pemberitahuan') ?>" class="btn btn-default">Cancel</a>
	</form>
   