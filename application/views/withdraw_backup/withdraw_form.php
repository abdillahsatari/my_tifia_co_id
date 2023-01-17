<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Withdraw</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="int">No Withdraw <?php echo form_error('withdraw_id') ?></label>
                        <div class="form-control" readonly><?= $withdraw_id ?></div>
                    </div>
                    <!-- <div class="form-group"> -->
                    <!-- <label for="int">No Withdraw <?php echo form_error('no_akun') ?></label> -->
                    <input type="hidden" class="form-control" name="nasabah_id" id="nasabah_id" value="<?php echo $nasabah_id; ?>" readonly />
                    <!-- </div> -->
                    <div class="form-group">
                        <label for="int">Nama Nasabah</label>
                        <div class="form-control" readonly><?= $nama_lengkap ?></div>
                    </div>
                    <div class="form-group">
                        <label for="int">Email Nasabah</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="No Akun" value="<?php echo $email; ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label for="int">No Akun <?php echo form_error('no_akun') ?></label>
                        <input type="text" class="form-control" name="no_akun" id="no_akun" placeholder="No Akun" value="<?php echo $no_akun; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="int">Tipe Akun</label>
                        <div class="form-control" readonly><?= $type ?></div>
                    </div>
                    <div class="form-group">
                        <label for="int">Nilai Tukar</label>
                        <div class="form-control" readonly><?= $nama_currency ?></div>
                    </div>
                    <div class="form-group">
                        <label for="int">Witdraw Rate</label>
                        <div class="form-control" readonly><?= $withdraw_rate ?></div>
                    </div>
                    <div class="form-group">
                        <label for="int">Leverage</label>
                        <div class="form-control" readonly><?= $nama_leverage ?></div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="int">Komisi</label>
                        <div class="form-control" readonly><?= $komisi ?></div>
                    </div> -->


                    <div class="form-group">
                        <label for="int">Jumlah WD <?php echo form_error('total') ?></label>
                        <input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Status Withdraw <?php echo form_error('status_withdraw') ?></label>
                        <?php if ($status_withdraw == 'Pending') { ?>
                            <select class="form-control" name="status_withdraw" id="status_dw">
                                <option value="Pending" <?php if ($status_withdraw == 'Pending') {
                                                            echo "selected disabled";
                                                        } ?>>Pending</option>
                                <option value="Approve" <?php if ($status_withdraw == 'Approve') {
                                                            echo "selected";
                                                        } ?>>Approve</option>
                                <option value="Reject" <?php if ($status_withdraw == 'Reject') {
                                                            echo "selected";
                                                        } ?>>Reject</option>
                            </select>
                        <?php } else { ?>
                            <input type="text" class="form-control" name="status_withdraw" id="status_withdraw" placeholder="Status" value="<?php echo $status_withdraw; ?>" readonly />
                        <?php } ?>
                    </div>
                    <div class="form-group" id="komentr" <?php if ($status_withdraw != 'Reject') { ?> style="display: none" <?php } ?>>
                        <label for="komentar">Komentar <?php echo form_error('komentar') ?></label>
                        <textarea class="form-control" rows="3" name="komentar" id="komentar" placeholder="Komentar" <?php if ($status_withdraw == 'Reject' || $status_withdraw == 'Approve') { ?> readonly <?php } ?>><?php echo $komentar; ?></textarea>
                    </div>
                    <input type="hidden" name="withdraw_id" value="<?php echo $withdraw_id; ?>" />
                    <?php if ($status_withdraw == 'Pending') { ?>
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <?php } ?>
                    <a href="<?php echo site_url('adminarea/withdraw') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>