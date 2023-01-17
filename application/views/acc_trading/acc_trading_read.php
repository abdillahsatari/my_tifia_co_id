<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Acc Trading Detail</h3>
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
                    <tr><td>No Akun</td><td><?php echo $no_akun; ?></td></tr>
                    <tr><td>Nama Nasabah</td><td><?php echo $nama_lengkap; ?></td></tr>
                    <tr><td>Email Nasabah</td><td><?php echo $email; ?></td></tr>
                    <tr><td>Tipe Akun</td><td><?php echo $type; ?></td></tr>
                    <tr><td>Nilai Tukar</td><td><?php echo $currency; ?></td></tr>
                    <tr><td>Leverage</td><td><?php echo $leverage; ?></td></tr>
            	    <tr><td>Komisi</td><td><?php echo $komisi; ?></td></tr>
            	    <tr><td>Password Trade</td><td><?php echo $password_trade; ?></td></tr>
            	    <tr><td>Password Investor</td><td><?php echo $password_investor; ?></td></tr>
            	    <tr><td>Ip</td><td><?php echo $ip; ?></td></tr>
            	    <tr><td>Port</td><td><?php echo $port; ?></td></tr>
            	    <tr><td>Tanggal Buat Akun</td><td><?php echo $tanggal_buat_akun; ?></td></tr>
            	    <tr><td>Status Aktif</td><td><?php echo $status_aktif; ?></td></tr>
            	      <tr><td>Balance</td><td><?php echo $balance; ?></td></tr>
                    <tr><td><a  class="btn bg-purple" href="javascript:window.history.go(-1);" >Kembali</a></td></tr>

            	</table>
            </div>
        </div>
    </div>
</div>