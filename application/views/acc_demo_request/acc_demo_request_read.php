<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Acc Request Detail</h3>
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
            	    <!-- <tr><td>Nasabah Id</td><td><?php echo $nasabah_id; ?></td></tr>
            	    <tr><td>Acc Currency Id</td><td><?php echo $acc_currency_id; ?></td></tr>
            	    <tr><td>Acc Type Id</td><td><?php echo $acc_type_id; ?></td></tr>
            	    <tr><td>Acc Leverage Id</td><td><?php echo $acc_leverage_id; ?></td></tr> -->
                    <tr><td>Nama</td><td><?php echo $nama_lengkap; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
                    <tr><td>Tipe Akun</td><td><?php echo $type; ?></td></tr>
                    <tr><td>Nilai Tukar</td><td><?php echo $currency; ?></td></tr>
                    <tr><td>leverage</td><td><?php echo $leverage; ?></td></tr>
            	    <tr><td>Tanggal Request</td><td><?php echo $date; ?></td></tr>
            	    <tr><td>Status Request</td><td><?php echo $status_request; ?></td></tr>
            	    <tr><td><a href="<?php echo site_url('adminarea/acc_request') ?>" class="btn bg-purple">Cancel</a></td></tr>
            	</table>
            </div>
        </div>
    </div>
</div>