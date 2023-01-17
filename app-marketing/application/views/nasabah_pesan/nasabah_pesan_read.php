<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Nasabah Pesan Detail</h3>
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
                    <tr><td>No. Pesan</td><td><?php echo $nasabah_pesan_id; ?></td></tr>
            	    <tr><td>Nama Nasabah</td><td><?php echo $nama_lengkap; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
            	    <tr><td>Tujuan</td><td><?php echo $tujuan; ?></td></tr>
            	    <tr><td>Subject</td><td><?php echo $subject; ?></td></tr>
            	    <tr><td>Isi</td><td><?php echo $isi; ?></td></tr>
            	    <tr><td>Lampiran</td><td><a href="<?= base_url() ?>uploads/lampiran/<?php echo $lampiran; ?>" target="_blank">Lihat Lampiran</a></td></tr>
            	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
            	    <tr><td>Date</td><td><?php echo $create_date; ?></td></tr>
            	    <tr><td><a href="<?php echo site_url('adminarea/nasabah_pesan') ?>" class="btn bg-purple">Cancel</a></td></tr>
            	</table>
            </div>
        </div>
    </div>
</div>