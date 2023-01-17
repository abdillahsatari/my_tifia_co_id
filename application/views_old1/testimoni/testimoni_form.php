<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Testimoni</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <!-- <div class="form-group">
            <label for="int">Id Testi <?php echo form_error('id_testi') ?></label>
            <input type="text" class="form-control" name="id_testi" id="id_testi" placeholder="Id Testi" value="<?php echo $id_testi; ?>" />
        </div> -->
        <input type="hidden" name="id_testi" value="<?php echo $id_testi; ?>" /> 
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pekerjaan <?php echo form_error('pekerjaan') ?></label>
            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?php echo $pekerjaan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Isitesti <?php echo form_error('isitesti') ?></label>
<!--             <input type="text" class="form-control" name="isitesti" id="isitesti" placeholder="Isitesti" value="<?php echo $isitesti; ?>" />
 -->
             <textarea class="ckeditor form-control" rows="3" name="isitesti" id="isitesti" ><?php echo $isitesti; ?></textarea>
        </div>
<!-- 	    <div class="form-group">
            <label for="photo">Photo <?php echo form_error('photo') ?></label>
            <textarea class="form-control" rows="3" name="photo" id="photo" placeholder="Photo"><?php echo $photo; ?></textarea>
        </div> -->
         <div class="form-group">
            <label for="gambar">Gambar <?php echo form_error('photo') ?></label>
            <input type="file" name="userfile1" id="userfile1" class="form-control">
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('adminarea/testimoni') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>