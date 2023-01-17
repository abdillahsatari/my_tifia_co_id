<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Bank</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo $action; ?>" method="post">
            	    <div class="form-group" style="display: none;">
                        <label for="int">Nasabah Id <?php echo form_error('nasabah_id') ?></label>
                        <input type="text" class="form-control" name="nasabah_id" id="nasabah_id" placeholder="Nasabah Id" value="<?php echo $nasabah_id; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Nasabah <?php echo form_error('nama_lengkap') ?></label>
                        <input type="text" class="form-control" readonly name="nama_lengkap" id="nama_lengkap" placeholder="Nama Nasabah" value="<?php echo $nama_lengkap; ?>" />
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Nama Bank <?php echo form_error('nama_bank') ?></label>
                        <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama Bank" value="<?php echo $nama_bank; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">No Rekening <?php echo form_error('no_rekening') ?></label>
                        <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="No Rekening" value="<?php echo $no_rekening; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Cabang <?php echo form_error('cabang') ?></label>
                        <input type="text" class="form-control" name="cabang" id="cabang" placeholder="Cabang" value="<?php echo $cabang; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Jenis Rekening <?php echo form_error('jenis_rekening') ?></label>
                        <input type="text" class="form-control" name="jenis_rekening" id="jenis_rekening" placeholder="Jenis Rekening" value="<?php echo $jenis_rekening; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Telepon Bank <?php echo form_error('telepon_bank') ?></label>
                        <input type="text" class="form-control" name="telepon_bank" id="telepon_bank" placeholder="Telepon Bank" value="<?php echo $telepon_bank; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Kode Bank <?php echo form_error('kode_bank') ?></label>
                        <input type="text" class="form-control" name="kode_bank" id="kode_bank" placeholder="Kode Bank" value="<?php echo $kode_bank; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Atas Nama <?php echo form_error('atas_nama') ?></label>
                        <input type="text" class="form-control" name="atas_nama" id="atas_nama" placeholder="Atas Nama" value="<?php echo $atas_nama; ?>" readonly/>
                    </div>
            	    <div class="form-group">
                        <label for="varchar">Currency <?php echo form_error('currency') ?></label>
                        <input type="text" class="form-control" name="currency" id="currency" placeholder="Currency" value="<?php echo $currency; ?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Buku Tabungan</label>
                        <?php if (!empty($gambar)) { ?>
                            <img width="50%" src="<?= base_url() ?>uploads/buku_tabungan/<?= $gambar ?>">
                        <?php } else { ?>
                            <img width="50%" src="<?= base_url() ?>uploads/photo/<?= $gambar2 ?>">
                        <?php } ?>
                    </div>
            	    <div class="form-group">
                        <label for="enum">Status Bank <?php echo form_error('status_bank') ?></label>
                        <select  class="form-control" name="status_bank" id="status_bank">
                            <option value="Pending" <?php if ($status_bank=='Pending') {
                                echo "selected";
                            } ?>>Pending</option>
                            <option value="Approve" <?php if ($status_bank=='Approve') {
                                echo "selected";
                            } ?>>Approve</option>
                            <option value="Reject" <?php if ($status_bank=='Reject') {
                                echo "selected";
                            } ?>>Reject</option>
                        </select>
                    </div>
            	    <input type="hidden" name="bank_id" value="<?php echo $bank_id; ?>" /> 
            	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            	    <a href="<?php echo site_url('adminarea/bank') ?>" class="btn btn-default">Cancel</a>
            	</form>
            </div>
        </div>
    </div>
</div>