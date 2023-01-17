<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Acc_demo</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
            	    <div class="form-group">
                        <label for="int">No Akun <?php echo form_error('no_akun') ?></label>
                        <input type="text" class="form-control" name="no_akun" id="no_akun" placeholder="No Akun" value="<?php echo $no_akun; ?>" />
                    </div>
            	    <div class="form-group">
                        <label for="int">Nama Lengkap</label>
                        <div class="form-control" name="nama_lengkap" id="nama_lengkap" readonly><?php echo $nama_lengkap; ?></div>
                    </div>
            	    <div class="form-group">
                        <label for="int">Email</label>
                        <div class="form-control" name="email" id="email" readonly><?php echo $email; ?></div>
                    </div>
            	    <div class="form-group">
                        <label for="int">Tipe Akun</label>
                        <div class="form-control" name="type" id="type" readonly><?php echo $type; ?></div>
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
                        <label for="varchar">Status Aktif <?php echo form_error('status_aktif') ?></label>
                        <select class="form-control" name="status_aktif" id="status_aktif">
                            <option value="Aktif" <?php if ($status_aktif=='Aktif') {
                                echo "selected";
                            } ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php if ($status_aktif=='Tidak Aktif') {
                                echo "selected";
                            } ?>>Tidak Aktif</option>
                        </select>
                    </div>
            	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            	    <a href="<?php echo site_url('adminarea/acc_demo') ?>" class="btn btn-default">Cancel</a>
            	</form>
            </div>
        </div>
    </div>
</div>