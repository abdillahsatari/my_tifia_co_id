<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">NMI Confirmed</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
            <i class="fa fa-refresh"></i></button>
        </div>
      </div>

      <div class="box-body">

        <form id="myform" method="post" onsubmit="return false">

          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tableku" style="width:100%">
              <thead>
                <tr>
                  <!-- <th width=""></th> -->
                  <th width="10px">No</th>
                  <th width="10px">Date Confirmed</th>
                  <th class="text-center">Kode</th>
                  <th class="text-center">Marketing</th>
                  <th class="text-center">Grand Total</th>
                  <th class="text-center">Status</th>
                  <th class="text-center" width="80px">Action</th>
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
          url: "<?= base_url() . 'adminarea/marketing/nmi_processed/fetch_list'; ?>",
          type: "POST"
        },
        "columnDefs": [{
          "targets": [0, 1, 2, 3, 4, 5, 6],
          "orderable": false,
        }, ],
        'autoWidth': false
      });
    });

  });
</script>