<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Form</h3>
				<div class="box-tools pull-right">
					<!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button> -->
					<button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
						<i class="fa fa-refresh"></i></button>
				</div>
			</div>

			<div class="box-body">
				<?php
				$hari_ini = $nmi['date_added'];
				$tgl = date('d', strtotime($hari_ini));
				$thn = date('Y', strtotime($hari_ini));
				$nama_date = nama_date($hari_ini);
				$dt = $nama_date['hari'] . ', ' . $tgl . ' ' . $nama_date['bulan'] . ' ' . $thn;
				?>


				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Status</label>
					<div class="col-sm-10">
						<code><?= $nmi['status'] ?></code>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="kode">No. Form</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" id="kode" placeholder="auto" value="<?= $nmi['kode'] ?>" disabled>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="mitra_id">Penerima (Mitra)</label>
					<div class="col-sm-6">
						<select name="mitra_id" class="form-control selectpicker" data-live-search="true" id="mitra_id" <?= ($nmi['id'] != '' ? 'disabled' : '') ?>>
							<option value="">-- Select Mitra --</option>
							<?php
							foreach ($mitra as $r) {
							?>
								<option value="<?= $r->id ?>" data-role="<?= $r->role ?>" <?= ($nmi['marketing_id'] == $r->id ? 'selected' : '') ?>><?= $r->kode ?> / <?= $r->nama ?></option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="col-sm-4">
						<input class="form-control" type="text" id="role" placeholder="Jabatan" readonly>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="date_added">Tanggal</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" id="hari" value="<?= $dt ?>" disabled>
					</div>
					<label class="col-sm-2 col-form-label" for="date">Tanggal Request</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" id="hari" value="<?= date_tampil($nmi['date_requested']) ?>" disabled>
					</div>
				</div>



				<div class="table-responsive m-t-2">
					<table class="table table-bordered table-striped" id="tableku" style="width:100%">
						<thead>
							<tr>
								<!-- <th width=""></th> -->
								<th width="10px">ID Akun</th>
								<th class="text-center">Total Lot</th>
								<th class="text-center">Deskripsi</th>
								<th class="text-center">Margin</th>
								<th class="text-center">NMI (%)</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($nmi_list as $r) {
							?>
								<tr>
									<td class="text-center"><a href="#" data-href="<?= base_url('adminarea/marketing/nmi/modal_nmiList/' . $nmi['id'] . '/' . $r->id) ?>" class="modal_listNmi"><?= $r->no_akun ?></a></td>
									<td class="text-center"><?= floatval($r->total_lot) ?></td>
									<td class="text-center"><?= $r->deskripsi ?></td>
									<td class="text-center"><?= floatval($r->margin) ?></td>
									<td class="text-center"><?= floatval($r->nmi_percentage) ?></td>
									<td class="text-center"><?= rupiah(floatval($r->total)) ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5" class="text-right">Grand Total</th>
								<th class="text-center"><?= rupiah($nmi['grand_total']) ?></th>
							</tr>
						</tfoot>

					</table>

					<div class="text-right">
						<?php
						if ($nmi['status'] == 'Requested') {
						?>
							<button class="btn btn-secondary btn-konfirmasi" data-href="<?= base_url('adminarea/marketing/nmi_request/konfirmasi/declined/' . $nmi['id']) ?>" data-type="Decline">Decline <i class="fa fa-times"></i></button>

							<button class="btn btn-success btn-konfirmasi" data-href="<?= base_url('adminarea/marketing/nmi_request/konfirmasi/approved/' . $nmi['id']) ?>" data-type="Approve">Approve <i class="fa fa-check"></i></button>
						<?php
						} elseif ($nmi['status'] == 'Approved') {
						?>
							<button class="btn btn-success" disabled>Approved <i class="fa fa-check"></i></button>
						<?php
						} elseif ($nmi['status'] == 'Declined') {
						?>
							<button class="btn btn-danger" disabled>Declined <i class="fa fa-times"></i></button>
						<?php
						}
						?>
					</div>

				</div>

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


<script src="<?= base_url() ?>assets/wilayah-administratif.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {

		get_role();
		$(document).on('change', '#mitra_id', function() {
			get_role();
		});

		$(document).on("click", ".btn-konfirmasi", function(e) {
			e.preventDefault();
			$('.modal-dialog').removeClass('modal-lg')
				.removeClass('modal-md')
				.addClass('modal-sm');
			$("#modal-title").text('Konfirmasi');
			$("#modal-body").html(`
            <p>Anda yakin untuk ` + $(this).data('type') + ` request NMI? Anda <span class="text-danger">tidak dapat mengubah</span> NMI jika telah diproses.</p>

            <div class="text-center">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                <a href="` + $(this).data('href') + `" class="btn btn-primary btn-sm">Ya, saya Yakin</a>
            </div>
            `);
			$("#modalKu").modal("show");
		});

		function get_role() {
			role = $('#mitra_id option:selected').attr('data-role');
			$('#role').val(role);
		}

	});
</script>