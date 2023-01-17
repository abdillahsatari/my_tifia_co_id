<div class="row">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" >
        <div class="col-xs-12 col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= $button;?> Bukti Konfirmasi</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
    	            <div class="form-group">
                        <label for="varchar">No Akun <?php echo form_error('no_akun') ?></label>
                        <input type="hidden" class="form-control" name="nasabah_id" id="nasabah_id" placeholder="Nama Lengkap" value="<?php echo $nasabah_id; ?>" />
                        <input type="text" class="form-control" name="no_akun" id="no_akun" placeholder="No Akun" value="<?php echo $no_akun; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="bukti_konfirmasi">Bukti Konfirmasi<?php echo form_error('bukti_konfirmasi') ?></label><p>
                        <input type="file" class="form-control" name="bukti_konfirmasi" id="bukti_konfirmasi">
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('adminarea/nasabah/perjanjian_nasabah/'.$nasabah_id) ?>" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>