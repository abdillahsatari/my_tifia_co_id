<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Acc_leverage</h3>
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
            <label for="varchar">Leverage <?php echo form_error('leverage') ?></label>
            <input type="text" class="form-control" name="leverage" id="leverage" placeholder="Leverage" value="<?php echo $leverage; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Leverage <?php echo form_error('nama_leverage') ?></label>
            <input type="text" class="form-control" name="nama_leverage" id="nama_leverage" placeholder="Nama Leverage" value="<?php echo $nama_leverage; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Status Leverage <?php echo form_error('status_leverage') ?></label>
            <!-- <input type="text" class="form-control" name="status_leverage" id="status_leverage" placeholder="Status Leverage" value="<?php echo $status_leverage; ?>" />
            
             -->

             <select class="form-control" name="status_leverage" id="status_leverage">
                <option value="<?php echo $status_leverage; ?>" selected=""><?php echo $status_leverage; ?></option>
                <?php
                    if($status_leverage === "") {
                ?>
                  <option value="Tidak Aktif">Tidak Aktif</option>

                <?php } ?>
                <?php
                    if($status_leverage === "Aktif") {

                ?>
                  <option value="Tidak Aktif">Tidak Aktif</option>

                <?php } else {?>
                    <option value="Aktif">Aktif</option>
                <?php } ?>
            </select>
        </div>



	    <!-- <div class="form-group">
            <label for="timestamp">Date <?php echo form_error('date') ?></label>
            <input type="datetime" class="form-control" name="date" id="date" placeholder="Date" value="<?php  echo $date; ?>" />
        </div> -->
	    <input type="hidden" name="acc_leverage_id" value="<?php echo $acc_leverage_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('adminarea/acc_leverage') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>