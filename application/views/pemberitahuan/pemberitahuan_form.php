
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="pemberitahuan">Pemberitahuan <?php echo form_error('pemberitahuan') ?></label>
            <textarea class="form-control" rows="3" name="pemberitahuan" id="pemberitahuan" placeholder="Pemberitahuan"><?php echo $pemberitahuan; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="enum">Aktif </label>
            <div class="checkbox">
              <label><input type="checkbox" name="aktif" value="1" <?php echo $retVal = ($aktif=='1') ? 'checked' : '' ; ?>>Aktif</label>
            </div>
        </div>
	    <input type="hidden" name="id_pemberitahuan" value="<?php echo $id_pemberitahuan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pemberitahuan') ?>" class="btn btn-default">Cancel</a>
	</form>
   