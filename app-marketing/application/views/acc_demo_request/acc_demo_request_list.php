<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">List Acc_demo_request</h3>
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
							<!-- <?php echo anchor(site_url('acc_demo_request/create'), '<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?> -->
						</div>
						<div class="col-xs-12 col-md-4 text-center">
							<div style="margin-top: 4px" id="message">

							</div>
						</div>
						<div class="col-xs-12 col-md-4 text-right">
							<?php echo anchor(site_url('adminarea/acc_demo_request/printdoc'), '<i class="fa fa-print"></i> Print Preview', 'class="btn bg-maroon"'); ?>
							<?php echo anchor(site_url('adminarea/acc_demo_request/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
							<?php echo anchor(site_url('adminarea/acc_demo_request/word'), '<i class="fa fa-file-word"></i> Word', 'class="btn btn-primary"'); ?>

						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped" id="tableku" style="width:100%">
							<thead>
								<tr>
									<!-- <th width=""></th> -->
									<th width="10px">No</th>
									<th>Nama Nasabah</th>
									<th>Email</th>
									<!-- <th>Acc Currency Id</th> -->
									<th>Tipe Akun</th>
									<!-- <th>Acc Leverage Id</th> -->
									<th>Tanggal Request</th>
									<th>Status Request</th>
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

<div class="modal fade" id="modalKu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal-body"></div>
			<div class="modal-footer" id="modal-footer" style="display: none;">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
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
					url: "<?= base_url() . 'adminarea/acc_demo_request/fetch_list'; ?>",
					type: "POST"
				},
				"columnDefs": [{
					"targets": [0, 1, 2, 3, 5, 6],
					"orderable": false,
				}, ],
				'autoWidth': false
			});
		});

		$(document).on("click", ".modalView", function(e) {
			e.preventDefault();
			$('.modal-dialog').removeClass('modal-lg')
				.removeClass('modal-sm')
				.addClass('modal-md');
			$("#modal-title").text('Request Akun Demo');
			$("#modal-body").load($(this).data("href"));
			$("#modalKu").modal("show");
		});

	});
</script>