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
                    <tr><td>JNo. Withdraw</td><td><?php echo $withdraw_id; ?></td></tr>
            	    <tr><td>No Akun</td><td><?php echo $no_akun; ?></td></tr>
                    <tr><td>Nama Nasabah</td><td><?php echo $nama_lengkap; ?></td></tr>
                    <tr><td>Email Nasabah</td><td><?php echo $email; ?></td></tr>
                
                    <tr><td>Tipe Akun</td><td><?php echo $type; ?></td></tr>
                    <tr><td>Nilai Tukar</td><td><?php echo $nama_currency; ?></td></tr>
                    <tr><td>WD Rate</td><td><?php echo $withdraw_rate; ?></td></tr>
                    <tr><td>Leverage</td><td><?php echo $nama_leverage; ?></td></tr>
                    <tr><td>Komisi</td><td><?php echo $komisi; ?></td></tr>

            	    <tr><td>Bank</td><td><?php echo $nama_bank; ?></td></tr>
                    <tr><td>No Rekening</td><td><?php echo $no_rekening; ?></td></tr>
                    <tr><td>Atas Nama</td><td><?php echo $atas_nama; ?></td></tr>
                    <tr><td>Currency</td><td><?php echo $currency; ?></td></tr>

            	    <tr><td>Jumlah Deposit</td><td><?php echo $total; ?></td></tr>
            	    <tr><td>Status Withdraw</td><td><?php echo $status_withdraw; ?></td></tr>
                    <tr><td>Komentar</td><td><?php echo $komentar; ?></td></tr>
            	    <tr><td>Tanggal Withdraw</td><td><?php echo $tanggal_withdraw; ?></td></tr>
            	    <tr><td><a href="<?php echo site_url('adminarea/withdraw') ?>" class="btn bg-purple">Cancel</a></td></tr>
            	</table>
            </div>
        </div>
    </div>
</div>