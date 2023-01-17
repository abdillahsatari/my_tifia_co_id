<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bank Detail</h3>
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
	    <tr><td>Nama Bank</td><td><?php echo $nama_bank; ?></td></tr>
	    <tr><td>No Rekening</td><td><?php echo $no_rekening; ?></td></tr>
	    <tr><td>Cabang</td><td><?php echo $cabang; ?></td></tr>
	    <tr><td>Jenis Rekening</td><td><?php echo $jenis_rekening; ?></td></tr>
	    <tr><td>Telepon Bank</td><td><?php echo $telepon_bank; ?></td></tr>
	    <tr><td>Kode Bank</td><td><?php echo $kode_bank; ?></td></tr>
	    <tr><td>Atas Nama</td><td><?php echo $atas_nama; ?></td></tr>
	    <tr><td>Currency</td><td><?php echo $currency; ?></td></tr>
	    <tr><td>Created Date</td><td><?php echo $created_date; ?></td></tr>
	    <tr><td>Update Date</td><td><?php echo $update_date; ?></td></tr>
	    <tr><td>Status Bank</td><td><?php echo $status_bank; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('adminarea/bank') ?>" class="btn bg-purple">Cancel</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>