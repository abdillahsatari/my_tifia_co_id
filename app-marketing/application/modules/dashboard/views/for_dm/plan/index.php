<!-- END: Subheader -->
<div class="m-subheader">


  <?= $this->session->flashdata('message') ?>


  <div class="row">

    <div class="col-lg-12">

      <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
          <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
              <span class="m-portlet__head-icon m--hide">
                <i class="la la-gear"></i>
              </span>
              <h3 class="m-portlet__head-text">
                List Sales
              </h3>
              <a href="<?= base_url('dashboard/all_plan/excel') ?>" class="btn btn-sm btn-success ml-3">
                <i class="fa fa-file-excel"></i> Excel
              </a>
            </div>
          </div>
        </div>
        <div class="m-portlet__body">
          <div class="m-section">
            <span class="m-section__sub">
              <!--  -->
            </span>
            <div class="m-section__content">

              <div class="table-responsive">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tableku">
                  <thead>
                    <tr class="text-center">
                      <th width="10px">No</th>
                      <th class="text-center">Kode</th>
                      <th class="text-center">Marketing</th>
                      <th class="text-center">Periode</th>
                      <th class="text-center">Judul</th>
                      <th class="text-center">Target Omset</th>
                      <th class="text-center">Deskripsi</th>
                      <th class="text-center" width="80px">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>

            </div>
          </div>
        </div>
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
          url: "<?= base_url() . 'dashboard/all_plan/fetch_plan'; ?>",
          type: "POST"
        },
        "columnDefs": [{
          "targets": [0, 1, 2, 3, 4, 5, 6, 7],
          "orderable": false,
        }, ],
        'autoWidth': false
      });
    });

  });
</script>