<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Blog</h3>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="int">Blog Kategori Id <?php echo form_error('blog_kategori_id') ?></label>
            <?php echo cmb_dinamis('blog_kategori_id', 'blog_kategori', 'blog_kategori', 'blog_kategori_id', $blog_kategori_id); ?>
        </div>
	    <div class="form-group">
            <label for="gambar">Gambar <?php echo form_error('gambar') ?></label>
            <input type="file" name="userfile1" id="userfile1" class="form-control">
        </div>
	    <div class="form-group">
            <label for="judul">Judul <?php echo form_error('judul') ?></label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
        </div>
	    <div class="form-group">
            <label for="content">Content <?php echo form_error('content') ?></label>
            <textarea class="ckeditor form-control" rows="3" name="content" id="content" placeholder="Content"><?php echo $content; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('status') ?></label>
            <select class="form-control" name="status" id="status">
                <option value="Aktif" <?php if ($status=='Aktif') {
                    echo "selected";
                } ?>>Aktif</option>
                <option value="Tidak Aktif" <?php if ($status=='Tidak Aktif') {
                    echo "selected";
                } ?>>Tidak Aktif</option>
            </select>
        </div>
	    <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('blog') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>