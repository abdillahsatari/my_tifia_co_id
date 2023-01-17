<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Withdraw</h3>
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
            <label for="int">Nasabah Id <?php echo form_error('nasabah_id') ?></label>
            <input type="text" class="form-control" name="nasabah_id" id="nasabah_id" placeholder="Nasabah Id" value="<?php echo $nasabah_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">No Akun <?php echo form_error('no_akun') ?></label>
            <input type="text" class="form-control" name="no_akun" id="no_akun" placeholder="No Akun" value="<?php echo $no_akun; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Wallet Id <?php echo form_error('wallet_id') ?></label>
            <input type="text" class="form-control" name="wallet_id" id="wallet_id" placeholder="Wallet Id" value="<?php echo $wallet_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Bank Id <?php echo form_error('bank_id') ?></label>
            <input type="text" class="form-control" name="bank_id" id="bank_id" placeholder="Bank Id" value="<?php echo $bank_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Total <?php echo form_error('total') ?></label>
            <input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status Withdraw <?php echo form_error('status_withdraw') ?></label>
            <input type="text" class="form-control" name="status_withdraw" id="status_withdraw" placeholder="Status Withdraw" value="<?php echo $status_withdraw; ?>" />
        </div>
	    <div class="form-group">
            <label for="komentar">Komentar <?php echo form_error('komentar') ?></label>
            <textarea class="form-control" rows="3" name="komentar" id="komentar" placeholder="Komentar"><?php echo $komentar; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Sumber Withdraw <?php echo form_error('sumber_withdraw') ?></label>
            <input type="text" class="form-control" name="sumber_withdraw" id="sumber_withdraw" placeholder="Sumber Withdraw" value="<?php echo $sumber_withdraw; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Tanggal Withdraw <?php echo form_error('tanggal_withdraw') ?></label>
            <input type="text" class="form-control" name="tanggal_withdraw" id="tanggal_withdraw" placeholder="Tanggal Withdraw" value="<?php echo $tanggal_withdraw; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kode Withdraw <?php echo form_error('kode_withdraw') ?></label>
            <input type="text" class="form-control" name="kode_withdraw" id="kode_withdraw" placeholder="Kode Withdraw" value="<?php echo $kode_withdraw; ?>" />
        </div>
	    <input type="hidden" name="withdraw_id" value="<?php echo $withdraw_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('adminarea/withdraw') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>