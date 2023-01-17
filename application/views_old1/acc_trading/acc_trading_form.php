<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Acc_trading</h3>
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
            <label for="int">Acc Currency Id <?php echo form_error('acc_currency_id') ?></label>
            <input type="text" class="form-control" name="acc_currency_id" id="acc_currency_id" placeholder="Acc Currency Id" value="<?php echo $acc_currency_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Acc Leverage Id <?php echo form_error('acc_leverage_id') ?></label>
            <input type="text" class="form-control" name="acc_leverage_id" id="acc_leverage_id" placeholder="Acc Leverage Id" value="<?php echo $acc_leverage_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Nasabah Id <?php echo form_error('nasabah_id') ?></label>
            <input type="text" class="form-control" name="nasabah_id" id="nasabah_id" placeholder="Nasabah Id" value="<?php echo $nasabah_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Acc Type Id <?php echo form_error('acc_type_id') ?></label>
            <input type="text" class="form-control" name="acc_type_id" id="acc_type_id" placeholder="Acc Type Id" value="<?php echo $acc_type_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Komisi <?php echo form_error('komisi') ?></label>
            <input type="text" class="form-control" name="komisi" id="komisi" placeholder="Komisi" value="<?php echo $komisi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Percent Req <?php echo form_error('percent_req') ?></label>
            <input type="text" class="form-control" name="percent_req" id="percent_req" placeholder="Percent Req" value="<?php echo $percent_req; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password Trade <?php echo form_error('password_trade') ?></label>
            <input type="text" class="form-control" name="password_trade" id="password_trade" placeholder="Password Trade" value="<?php echo $password_trade; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password Investor <?php echo form_error('password_investor') ?></label>
            <input type="text" class="form-control" name="password_investor" id="password_investor" placeholder="Password Investor" value="<?php echo $password_investor; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ip <?php echo form_error('ip') ?></label>
            <input type="text" class="form-control" name="ip" id="ip" placeholder="Ip" value="<?php echo $ip; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Port <?php echo form_error('port') ?></label>
            <input type="text" class="form-control" name="port" id="port" placeholder="Port" value="<?php echo $port; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Buat Akun <?php echo form_error('tanggal_buat_akun') ?></label>
            <input type="text" class="form-control" name="tanggal_buat_akun" id="tanggal_buat_akun" placeholder="Tanggal Buat Akun" value="<?php echo $tanggal_buat_akun; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Terakhir Login <?php echo form_error('tanggal_terakhir_login') ?></label>
            <input type="text" class="form-control" name="tanggal_terakhir_login" id="tanggal_terakhir_login" placeholder="Tanggal Terakhir Login" value="<?php echo $tanggal_terakhir_login; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status Aktif <?php echo form_error('status_aktif') ?></label>
            <input type="text" class="form-control" name="status_aktif" id="status_aktif" placeholder="Status Aktif" value="<?php echo $status_aktif; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Balance <?php echo form_error('balance') ?></label>
            <input type="text" class="form-control" name="balance" id="balance" placeholder="Balance" value="<?php echo $balance; ?>" />
        </div>
	    <input type="hidden" name="no_akun" value="<?php echo $no_akun; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('adminarea/acc_trading') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>