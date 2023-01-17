<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Nasabah_pesan</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
            	    <div class="form-group" style="display: none;">
                        <label for="int">Nasabah Id <?php echo form_error('nasabah_id') ?></label>
                        <input type="text" class="form-control" name="nasabah_id" id="nasabah_id" placeholder="Nasabah Id" value="<?php echo $nasabah_id; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">ID <?php echo form_error('nasabah_pesan_id') ?></label>
                        <input type="text" class="form-control" value="<?php echo $nasabah_pesan_id; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Nasabah <?php echo form_error('nama_lengkap') ?></label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="nama lengkap" value="<?php echo $nama_lengkap; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Email <?php echo form_error('email') ?></label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Tujuan <?php echo form_error('tujuan') ?></label>
                        <input type="text" class="form-control" name="tujuan" id="tujuan" placeholder="Tujuan" value="<?php echo $tujuan; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Subject <?php echo form_error('subject') ?></label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="<?php echo $subject; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="isi">Isi <?php echo form_error('isi') ?></label>
                        <textarea class="form-control" rows="3" name="isi" id="isi" placeholder="Isi" readonly><?php echo $isi; ?></textarea>
                    </div>
            	    <div class="form-group">
                        <label for="gambar">Lampiran <?php echo form_error('lampiran') ?></label>
                        <a href="<?= base_url() ?>uploads/lampiran/<?php echo $lampiran; ?>" target="_blank">Lihat Lampiran</a>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Status <?php echo form_error('status_pesan') ?></label>
                        <select class="form-control" name="status_pesan" id="status_pesan">
                            <option value="Delivered" <?php if ($status=='Delivered') {
                                echo "selected";
                            } ?>>Delivered</option>
                            <option value="Process" <?php if ($status=='Process') {
                                echo "selected";
                            } ?>>Process</option>
                            <option value="Solved" <?php if ($status=='Solved') {
                                echo "selected";
                            } ?>>Solved</option>
                        </select>
                    </div>
            	    <input type="hidden" name="nasabah_pesan_id" value="<?php echo $nasabah_pesan_id; ?>" /> 
            	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            	    <a href="<?php echo site_url('adminarea/nasabah_pesan') ?>" class="btn btn-default">Cancel</a>
	           </form>
            </div>
        </div>
    </div>
</div>