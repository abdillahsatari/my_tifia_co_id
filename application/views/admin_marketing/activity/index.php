<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">List Marketing</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
						<i class="fa fa-refresh"></i></button>
				</div>
			</div>

			<div class="box-body">

				<div class="row" style="margin-bottom: 10px">
					<div class="col-xs-12 col-md-4">

						<!-- Date range -->
						<div class="form-group">
							<label>Date range:</label>

							<form action="">

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" id="date_range">
								</div>

							</form>
							<!-- daterangepicker_start, daterangepicker_end, applyBtn -->
							<!-- /.input group -->

						</div>
						<!-- /.form group -->


						<!-- <?php echo anchor(site_url('adminarea/marketing/create'), '<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?> -->
					</div>
					<div class="col-xs-12 col-md-4 text-center">
						<div style="margin-top: 4px" id="message">
						</div>
					</div>
					<div class="col-xs-12 col-md-4 text-right">
						<button id="btnResetTable" class="btn bg-purple"><i class=" fa fa-refresh"></i> Refresh</button>
						<?php echo anchor(site_url('adminarea/marketing/activity/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
						<!-- <?php echo anchor(site_url('adminarea/marketing/word'), '<i class="fa fa-file-word"></i> Word', 'class="btn btn-primary"'); ?> -->

					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="tableku" style="width:100%">
						<thead>
							<tr>
								<!-- <th width=""></th> -->
								<th width="10px">No</th>
								<th class="text-center">Kode</th>
								<th class="text-center">Marketing</th>
								<th class="text-center">Nasabah</th>
								<th class="text-center">Prioritas</th>
								<th class="text-center">Kategori</th>
								<th class="text-center">Tanggal</th>

								<th class="text-center" width="80px">Action</th>
							</tr>
						</thead>


					</table>
				</div>

			</div>
		</div>
	</div>
</div>


<script>
	document.addEventListener('DOMContentLoaded', function() {

		$(document).ready(function() {
			setDatatables();
		});
		$(document).on("click", "#btnResetTable", function() {
			setDatatables();
		});

		function setDatatables() {
			$("#tableku").dataTable().fnDestroy()
			var dataTable = $('#tableku').DataTable({
				"processing": true,
				"serverSide": true,
				"order": [],
				"ajax": {
					url: "<?= base_url() . 'adminarea/marketing/activity/fetch_activity'; ?>",
					type: "POST"
				},
				"columnDefs": [{
					"targets": [0, 1, 2, 3, 4, 5, 6, 7],
					"orderable": false,
				}, ],
				'autoWidth': false
			});
		}

		$(document).on("click", ".applyBtn", function() {
			$("#tableku").dataTable().fnDestroy()
			var dataTable = $('#tableku').DataTable({
				"processing": true,
				"serverSide": true,
				"order": [],
				"ajax": {
					url: "<?= base_url() . 'adminarea/marketing/activity/fetch_activity'; ?>",
					type: "POST",
					data: {
						'daterangepicker_start': $("input[name=daterangepicker_start]").val(),
						'daterangepicker_end': $("input[name=daterangepicker_end]").val()
					}
				},
				"columnDefs": [{
					"targets": [0, 1, 2, 3, 4, 5, 6, 7],
					"orderable": false,
				}, ],
				'autoWidth': false
			});
		});




		//Date range picker
		$('#date_range').daterangepicker({
			locale: {
				format: 'YYYY-MM-DD'
			}
		});

	});
</script>