<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Acc_type</h3>
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
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Type <?php echo form_error('type') ?></label>
            <input type="text" class="form-control" name="type" id="type" placeholder="type" value="<?php echo $type; ?>" />
        </div>
	    <!-- <div class="form-group">
            <label for="enum">Status Type <?php echo form_error('status_type') ?></label>
            <input type="text" class="form-control" name="status_type" id="status_type" placeholder="Status Type" value="<?php echo $status_type; ?>" />
        </div> -->
	

        <div class="form-group">
            <label for="enum">Status type <?php echo form_error('status_type') ?></label>
            <!-- <input type="text" class="form-control" name="status_type" id="status_type" placeholder="Status Currency" value="<?php echo $status_type; ?>" /> -->
            <select class="form-control" name="status_type" id="status_type">
                <option value="<?php echo $status_type; ?>" selected=""><?php echo $status_type; ?></option>
                <?php
                    if($status_type === "") {
                ?>
                  <option value="Tidak Aktif">Tidak Aktif</option>

                <?php } ?>
                <?php
                    if($status_type === "Aktif") {

                ?>
                  <option value="Tidak Aktif">Tidak Aktif</option>

                <?php } else {?>
                    <option value="Aktif">Aktif</option>
                <?php } ?>
            </select>
        </div>
           
	    <input type="hidden" name="acc_type_id" value="<?php echo $acc_type_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('adminarea/acc_type') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>