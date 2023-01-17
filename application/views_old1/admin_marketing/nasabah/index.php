<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>

      <div class="box-body">

        <form id="myform" method="post" onsubmit="return false">

          <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12 col-md-4">
              <!-- <?php echo anchor(site_url('adminarea/marketing/create'), '<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?> -->
            </div>
            <div class="col-xs-12 col-md-4 text-center">
              <div style="margin-top: 4px" id="message">

              </div>
            </div>
            <div class="col-xs-12 col-md-4 text-right">
              <?php echo anchor(site_url('adminarea/marketing/nasabah/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
              <!-- <?php echo anchor(site_url('adminarea/marketing/word'), '<i class="fa fa-file-word"></i> Word', 'class="btn btn-primary"'); ?> -->

            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tableku" style="width:100%">
              <thead>
                <tr>
                  <!-- <th width=""></th> -->
                  <th width="10px">No</th>
                  <th class="text-center">Kode / Nama</th>
                  <th class="text-center">Marketing</th>
                  <th class="text-center">Kontak</th>
                  <th class="text-center">Kota Asal</th>
                  <th class="text-center">Prioritas</th>

                  <th width="80px">Action</th>
                </tr>
              </thead>


            </table>
          </div>
          <!-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button> -->
        </form>

      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {

    $(document).ready(function() {
      var dataTable = $('#tableku').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "<?= base_url() . 'adminarea/marketing/nasabah/fetch_list'; ?>",
          type: "POST"
        },
        "columnDefs": [{
          "targets": [0, 1, 2, 3, 4, 5],
          "orderable": false,
        }, ],
        'autoWidth': false
      });
    });

  });
</script>