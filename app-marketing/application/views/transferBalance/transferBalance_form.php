<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Deposit</h3>
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
                        <label for="int">id <?php echo form_error('deposit_id') ?></label>
                        <input type="text" class="form-control" name="deposit_id" id="deposit_id" placeholder="deposit_id" value="<?php echo $deposit_id; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="int">No Akun <?php echo form_error('no_akun') ?></label>
                        <input type="text" class="form-control" name="no_akun" id="no_akun" placeholder="No Akun" value="<?php echo $no_akun; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="int">Nilai Tukar</label>
                        <div class="form-control" readonly><?php echo $currency; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="int">Deposit Rate</label>
                        <div class="form-control" readonly><?php echo number_format($deposit); ?></div>
                    </div>

            	    <div class="form-group" style="display: none;">
                        <label for="int">Nasabah Id <?php echo form_error('nasabah_id') ?></label>
                        <input type="text" class="form-control" name="nasabah_id" id="nasabah_id" placeholder="Nasabah Id" value="<?php echo $nasabah_id; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Nama <?php echo form_error('nama_lengkap') ?></label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="int">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" readonly/>
                    </div>

                    <div class="form-group">
                        <label for="enum">Bank <?php echo form_error('bank') ?></label>
                        <input type="text" class="form-control" name="bank" id="bank" placeholder="Nama Bank" value="<?php echo $bank; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="enum">No Rek<?php echo form_error('No Rekening') ?></label>
                        <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="No Rekening" value="<?php echo $no_rekening; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="int">Pemilik Rekening</label>
                        <div class="form-control" readonly><?php echo $atas_nama; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="enum">Currency Bank <?php echo form_error('currency_bank') ?></label>
                        <input type="text" class="form-control" name="currency_bank" id="currency_bank" placeholder="currency" value="<?php echo $currency_bank; ?>" readonly/>
                    </div>

            	    <div class="form-group">
                        <label for="double">Total <?php echo form_error('total') ?></label>
                        <input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo number_format($total); ?>" readonly/>
                    </div>

                    <div class="form-group">
                        <label for="double">Jumlah Transfer Balance <?php echo form_error('total') ?></label>
                        <input type="number" class="form-control" name="balance" step='0.01' id="total" placeholder="Total" value=<?php echo number_format(0,2); ?> />
                    </div>
                  
            	    <a  href="javascript:window.history.go(-1);" class="btn btn-default">Cancel</a>

                    <?php if ($status_deposit=='Approve') { ?>
            	       <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <?php } ?>
            	</form>
            </div>
        </div>
    </div>
</div>