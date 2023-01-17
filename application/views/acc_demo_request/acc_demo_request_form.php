<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button; ?> Acc_demo_request</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group" style="display: none">
                    <label for="int">Nasabah Id <?php echo form_error('nasabah_id') ?></label>
                    <input type="text" class="form-control" name="nasabah_id" id="nasabah_id" placeholder="Nasabah Id" value="<?php echo $nasabah_id; ?>" />
                </div>
                <div class="form-group" style="display: none">
                    <label for="int">Acc Currency Id <?php echo form_error('acc_currency_id') ?></label>
                    <input type="text" class="form-control" name="acc_currency_id" id="acc_currency_id" placeholder="Acc Currency Id" value="<?php echo $acc_currency_id; ?>" />
                </div>
                <div class="form-group" style="display: none">
                    <label for="int">Acc Type Id <?php echo form_error('acc_type_id') ?></label>
                    <input type="text" class="form-control" name="acc_type_id" id="acc_type_id" placeholder="Acc Type Id" value="<?php echo $acc_type_id; ?>" />
                </div>
                <div class="form-group" style="display: none">
                    <label for="int">Acc Leverage Id <?php echo form_error('acc_leverage_id') ?></label>
                    <input type="text" class="form-control" name="acc_leverage_id" id="acc_leverage_id" placeholder="Acc Leverage Id" value="<?php echo $acc_leverage_id; ?>" />
                </div>
                <div class="form-group" style="display: none">
                    <label for="timestamp">Date <?php echo form_error('date') ?></label>
                    <input type="text" class="form-control" name="date" id="date" placeholder="Date" value="<?php echo $date; ?>" />
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Nasabah <?php echo form_error('nama_lengkap') ?></label>
                    <div class="form-control" name="nama_lengkap" id="nama_lengkap" readonly><?= $nama_lengkap ?></div>
                </div>
                <div class="form-group">
                    <label for="email">Email Nasabah <?php echo form_error('email') ?></label>
                    <div class="form-control" name="email" id="email" readonly><?= $email ?></div>
                </div>
                <div class="form-group">
                    <label for="type">Tipe Akun <?php echo form_error('type') ?></label>
                    <div class="form-control" name="type" id="type" readonly><?= $type ?></div>
                </div>
                <div class="form-group">
                    <label for="nama_currency">Deposit <?php echo form_error('deposit') ?></label>
                    <div class="form-control" name="deposit" id="deposit" readonly><?= $deposit ?></div>
                </div>
                <div class="form-group">
                    <label for="nama_currency">Nilai Tukar <?php echo form_error('nama_currency') ?></label>
                    <div class="form-control" name="nama_currency" id="nama_currency" readonly><?= $nama_currency ?></div>
                </div>
                <div class="form-group">
                    <label for="nama_leverage">Leverage <?php echo form_error('nama_leverage') ?></label>
                    <div class="form-control" name="nama_leverage" id="nama_leverage" readonly><?= $nama_leverage ?></div>
                </div>

                <div class="form-group">
                    <label for="enum">Status Request <?php echo form_error('status_request') ?></label>
                    <input type="text" class="form-control" name="status_request" id="status_request" placeholder="Status Request" value="<?php echo $status_request; ?>" readonly />
                </div>
                <?php if ($status_request == 'Aktif') { ?>
                    <a href="<?php echo site_url('adminarea/acc_request') ?>" class="btn btn-default">Cancel</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if ($status_request != 'Aktif') { ?>
        <div class="col-xs-12 col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= $button; ?> Acc_trading</h3>
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
                            <label for="int">No Akun <?php echo form_error('no_akun') ?></label>
                            <input type="text" class="form-control" name="no_akun" id="no_akun" placeholder="No Akun" value="<?php echo $no_akun; ?>" />
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
                            <label for="varchar">Server <?php echo form_error('ip') ?></label>
                            <input type="text" class="form-control" name="ip" id="ip" placeholder="Server" value="<?php echo $ip; ?>" />
                        </div>
                        <div class="form-group" style="display: none;">
                            <label for="varchar">Port <?php echo form_error('port') ?></label>
                            <input type="text" class="form-control" name="port" id="port" placeholder="Port" value="0" />
                        </div>
                        <input type="hidden" name="acc_request_id" value="<?php echo $acc_request_id; ?>" />
                        <button type="submit" class="btn btn-primary">
                            <!-- <?php echo $button ?> -->Create
                        </button>
                        <a href="<?php echo site_url('adminarea/acc_demo_request') ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>