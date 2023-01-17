<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">List NMI</h3>
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
                  <th class="text-center">Date</th>
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


<div class="modal fade in" id="modalKu" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="modal-title"></h4>
      </div>
      <div class="modal-body" id="modal-body"></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {

    $(document).on("click", ".btn-delete", function(e) {
      e.preventDefault();
      $('.modal-dialog').removeClass('modal-lg')
        .removeClass('modal-md')
        .addClass('modal-sm');
      $("#modal-title").text('Konfirmasi');
      $("#modal-body").html(`
            <p>Anda yakin untuk menghapus NMI? Anda <span class="text-danger">tidak dapat mengembalikan</span> NMI jika telah dihapus.</p>

            <div class="text-center">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                <a href="` + $(this).data('href') + `" class="btn btn-danger btn-sm">Ya, saya Yakin</a>
            </div>

            `);
      $("#modalKu").modal("show");
    });

    $(document).ready(function() {
      var dataTable = $('#tableku').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "<?= base_url() . 'adminarea/marketing/nmi/fetch_list'; ?>",
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