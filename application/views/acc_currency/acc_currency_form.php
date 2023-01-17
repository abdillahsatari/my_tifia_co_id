<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Acc_currency</h3>
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
            <label for="varchar">Nama Currency <?php echo form_error('nama_currency') ?></label>
            <input type="text" class="form-control" name="nama_currency" id="nama_currency" placeholder="Nama Currency" value="<?php echo $nama_currency; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Deposit Rate <?php echo form_error('deposit_rate') ?></label>
            <input type="text" class="form-control" name="deposit_rate" id="deposit_rate" placeholder="Deposit Rate" value="<?php echo $deposit_rate; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Withdraw Rate <?php echo form_error('withdraw_rate') ?></label>
            <input type="text" class="form-control" name="withdraw_rate" id="withdraw_rate" placeholder="Withdraw Rate" value="<?php echo $withdraw_rate; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Status Currency <?php echo form_error('status_currency') ?></label>
            <!-- <input type="text" class="form-control" name="status_currency" id="status_currency" placeholder="Status Currency" value="<?php echo $status_currency; ?>" /> -->
            <select class="form-control" name="status_currency" id="status_currency">
                <option value="<?php echo $status_currency; ?>" selected=""><?php echo $status_currency; ?></option>
                <?php
                    if($status_currency === "") {
                ?>
                  <option value="Tidak Aktif">Tidak Aktif</option>

                <?php } ?>
                <?php
                    if($status_currency === "Aktif") {

                ?>
                  <option value="Tidak Aktif">Tidak Aktif</option>

                <?php } else {?>
                    <option value="Aktif">Aktif</option>
                <?php } ?>
            </select>
        </div>
	    <!-- <div class="form-group">
            <label for="datetime">Tgl Update Cdeposit <?php echo form_error('tgl_update_cdeposit') ?></label>
            <input type="text" class="form-control" name="tgl_update_cdeposit" id="tgl_update_cdeposit" placeholder="Tgl Update Cdeposit" value="<?php echo $tgl_update_cdeposit; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Tgl Update Cwithdraw <?php echo form_error('tgl_update_cwithdraw') ?></label>
            <input type="text" class="form-control" name="tgl_update_cwithdraw" id="tgl_update_cwithdraw" placeholder="Tgl Update Cwithdraw" value="<?php echo $tgl_update_cwithdraw; ?>" />
        </div> -->
	    <input type="hidden" name="acc_currency_id" value="<?php echo $acc_currency_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('adminarea/acc_currency') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>