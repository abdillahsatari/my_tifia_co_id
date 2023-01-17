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
                        <label for="enum">Type Deposit <?php echo form_error('type_deposit') ?></label>
                        <input type="text" class="form-control" name="type_deposit" id="type_deposit" placeholder="Type Deposit" value="<?php echo $type_deposit; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="bukti_transfer">Bukti Transfer <?php echo form_error('bukti_transfer') ?></label>
                        <img width="50%" src="<?= base_url() ?>uploads/bukti_tf/<?php echo $bukti_transfer; ?>">
                        <!-- <textarea class="form-control" rows="3" name="bukti_transfer" id="bukti_transfer" placeholder="Bukti Transfer"><?php echo $bukti_transfer; ?></textarea> -->
                    </div>
            	    

            	    <div class="form-group">
                        <label for="varchar">Status Deposit <?php echo form_error('status_deposit') ?></label>
                        <!-- <input type="text" class="form-control" name="status_deposit" id="status_deposit" placeholder="Status Deposit" value="<?php echo $status_deposit; ?>" /> -->
                        <?php if ($status_deposit=='Pending') { ?>
                            <select class="form-control" name="status_deposit" id="status_dw">
                                <option value="Pending" <?php if ($status_deposit=='Pending') {
                                    echo "selected";
                                } ?>>Pending</option>
                                <option value="Approve" <?php if ($status_deposit=='Approve') {
                                    echo "selected";
                                } ?>>Approve</option>
                                <option value="Reject" <?php if ($status_deposit=='Reject') {
                                    echo "selected";
                                } ?>>Reject</option>
                            </select>
                        <?php } else{ ?>
                        
                            <input type="text" class="form-control" name="status_deposit" id="status_deposit" placeholder="Status" 
                            value="<?php echo $status_deposit; ?>" 
                            readonly/>
                            <?php } ?>
                        
                        
                    </div>
                    <div class="form-group" id="komentr" <?php if ($status_deposit!='Reject') { ?> style="display: none" <?php } ?>>
                        <label for="komentar">Komentar <?php echo form_error('komentar') ?></label>
                        <textarea class="form-control" rows="3" name="komentar" id="komentar" placeholder="Komentar" ><?php echo $komentar; ?></textarea>
                    </div>
            	    <input type="hidden" name="deposit_id" value="<?php echo $deposit_id; ?>" /> 
                    <?php if ($status_deposit=='Pending') { ?>
            	       <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <?php } ?>
            	    <a href="<?php echo site_url('adminarea/deposit') ?>" class="btn btn-default">Cancel</a>
            	</form>
            </div>
        </div>
    </div>
</div>