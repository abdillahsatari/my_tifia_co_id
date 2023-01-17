<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Transfer Balance</h3>
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
                    <tr><td><strong>Informasi Akun</strong></td><td></td></tr>
            	    <tr><td>No Akun</td><td><?php echo $no_akun; ?></td></tr>
                    <tr><td>Nilai Tukar</td><td><?php echo $currency; ?></td></tr>
                    <tr><td>Deposit Rate</td><td><?php echo $deposit; ?></td></tr>
                    <tr><td><strong>Informasi Nasabah</strong></td><td></td></tr>
                    <tr><td>Nama Nasabah</td><td><?php echo $nama; ?></td></tr>
                    <tr><td>Email Nasabah</td><td><?php echo $email; ?></td></tr>
                    <tr><td><strong>Informasi Bank</strong></td><td></td></tr>
            	    <tr><td>Bank</td><td><?php echo $bank; ?></td></tr>
                    <tr><td>No Rekening</td><td><?php echo $no_rekening; ?></td></tr>
                    <tr><td>Pemilik Rekening</td><td><?php echo $atas_nama; ?></td></tr>
                    <tr><td>Currency Bank</td><td><?php echo $currency_bank; ?></td></tr>
                    <tr><td><strong>Informasi Deposit</strong></td><td></td></tr>
            	    <tr><td>Total</td><td><?php echo $total; ?></td></tr>
            	    <tr><td>Type Deposit</td><td><?php echo $type_deposit; ?></td></tr>
            	    <tr><td>Status Deposit</td><td><?php echo $status_deposit; ?></td></tr>
            	    <tr><td>Tanggal request </td><td><?php echo $tanggal_deposit; ?></td></tr>
                    <tr>
                        <td>
                            <div class="">
                                <label>Balance : </label>
                            </div>
                        </td>
                        <td>
                            <div class="">
                            <input type="number" >
                            </div>
                        </td>
                    </tr>
            	  <tr>
                     <td>
                    <a  class="btn bg-purple" href="javascript:window.history.go(-1);" >Kembali</a>
                    <a  class="btn bg-purple" href="javascript:window.history.go(-1);" >Up Balance</a>
                    </td>
                  </tr>
            	</table>
            </div>
        </div>
    </div>
</div>