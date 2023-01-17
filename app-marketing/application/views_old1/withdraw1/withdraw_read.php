<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Withdraw Detail</h3>
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
	    <tr><td>Nasabah Id</td><td><?php echo $nasabah_id; ?></td></tr>
	    <tr><td>No Akun</td><td><?php echo $no_akun; ?></td></tr>
	    <tr><td>Wallet Id</td><td><?php echo $wallet_id; ?></td></tr>
	    <tr><td>Bank Id</td><td><?php echo $bank_id; ?></td></tr>
	    <tr><td>Total</td><td><?php echo $total; ?></td></tr>
	    <tr><td>Status Withdraw</td><td><?php echo $status_withdraw; ?></td></tr>
	    <tr><td>Komentar</td><td><?php echo $komentar; ?></td></tr>
	    <tr><td>Sumber Withdraw</td><td><?php echo $sumber_withdraw; ?></td></tr>
	    <tr><td>Tanggal Withdraw</td><td><?php echo $tanggal_withdraw; ?></td></tr>
	    <tr><td>Kode Withdraw</td><td><?php echo $kode_withdraw; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('adminarea/withdraw') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>