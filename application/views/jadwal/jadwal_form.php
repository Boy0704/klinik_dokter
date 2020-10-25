
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label>Nama Dokter</label>
            <input type="text" name="dokter" class="form-control" required="">
        </div>
	    <div class="form-group">
            <label for="varchar">Hari <?php echo form_error('hari') ?></label>
            <!-- <input type="text" class="form-control" name="hari" id="hari" placeholder="Hari" value="<?php echo $hari; ?>" /> -->
            <select name="hari" class="form-control">
                <option value="<?php echo $hari ?>"><?php echo $hari ?></option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="time">Jam Mulai <?php echo form_error('dari') ?></label>
            <input type="text" class="form-control" name="dari" id="dari" placeholder="Dari" value="<?php echo $dari; ?>" />
        </div>
	    <div class="form-group">
            <label for="time">Jam Selesai <?php echo form_error('sampai') ?></label>
            <input type="text" class="form-control" name="sampai" id="sampai" placeholder="Sampai" value="<?php echo $sampai; ?>" />
        </div>
	    <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jadwal') ?>" class="btn btn-default">Cancel</a>
	</form>
   