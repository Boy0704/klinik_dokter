
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Jenis Bayar <?php echo form_error('jenis_bayar') ?></label>
            <input type="text" class="form-control" name="jenis_bayar" id="jenis_bayar" placeholder="Jenis Bayar" value="<?php echo $jenis_bayar; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Harga <?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
	    <input type="hidden" name="id_jenis_bayar" value="<?php echo $id_jenis_bayar; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jenis_bayar') ?>" class="btn btn-default">Cancel</a>
	</form>
   