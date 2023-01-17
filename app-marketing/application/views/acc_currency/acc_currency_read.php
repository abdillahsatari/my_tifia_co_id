<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Acc Currency Detail</h3>
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
        <table class="table">
	    <tr><td>Nama Currency</td><td><?php echo $nama_currency; ?></td></tr>
	    <tr><td>Deposit Rate</td><td><?php echo $deposit_rate; ?></td></tr>
	    <tr><td>Withdraw Rate</td><td><?php echo $withdraw_rate; ?></td></tr>
	    <tr><td>Status Currency</td><td><?php echo $status_currency; ?></td></tr>
	    <tr><td>Tgl Update Cdeposit</td><td><?php echo $tgl_update_cdeposit; ?></td></tr>
	    <tr><td>Tgl Update Cwithdraw</td><td><?php echo $tgl_update_cwithdraw; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('adminarea/acc_currency') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>