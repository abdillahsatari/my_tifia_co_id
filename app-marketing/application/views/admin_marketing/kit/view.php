<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Form</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
						<i class="fa fa-refresh"></i></button>
				</div>
			</div>

			<div class="box-body">

				<form action="<?= base_url('adminarea/marketing/kit/update_action') ?>" method="POST" id="form" enctype="multipart/form-data">


					<input class="form-control" type="hidden" id="id" name="id" value="<?= $data['id'] ?>">

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-10">
							<input class="form-control" type="text" id="nama" name="nama" value="<?= $data['nama'] ?>">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5"><?= $data['deskripsi'] ?></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="tipe">Tipe</label>
						<div class="col-sm-10">
							<select name="tipe" class="form-control select2" id="tipe">
								<option value="kit" <?= ($data['tipe'] == 'kit') ? 'selected' : '' ?>>Kit</option>
								<option value="edukasi" <?= ($data['tipe'] == 'edukasi') ? 'selected' : '' ?>>Edukasi</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="jenis">Jenis</label>
						<div class="col-sm-10">
							<select name="jenis" class="form-control select2" id="jenis">
								<!-- <option class="kosong" value="" selected disabled>-- pilih --</option> -->
								<option class="kit" value="Company Profile" <?= ($data['jenis'] == 'Company Profile') ? 'selected' : '' ?>>Company Profile</option>
								<option class="kit" value="Product Knowledge" <?= ($data['jenis'] == 'Product Knowledge') ? 'selected' : '' ?>>Product Knowledge</option>
								<option class="kit" value="Perhitungan Komisi" <?= ($data['jenis'] == 'Perhitungan Komisi') ? 'selected' : '' ?>>Perhitungan Komisi</option>
								<option class="kit" value="Video Promosi" <?= ($data['jenis'] == 'Video Promosi') ? 'selected' : '' ?>>Video Promosi</option>
								<option class="edukasi" value="Marketing Digital" <?= ($data['jenis'] == 'Marketing Digital') ? 'selected' : '' ?>>Marketing Digital</option>
								<option class="edukasi" value="Sales Education" <?= ($data['jenis'] == 'Sales Education') ? 'selected' : '' ?>>Sales Education</option>
								<option class="edukasi" value="Trading Education" <?= ($data['jenis'] == 'Trading Education') ? 'selected' : '' ?>>Trading Education</option>
								<option class="edukasi" value="Leadership & Motivation" <?= ($data['jenis'] == 'Leadership & Motivation') ? 'selected' : '' ?>>Leadership & Motivation</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="file">
							File
						</label>
						<div class="col-sm-10">
							<?php
							if ($data['file'] != '') {
								echo '<a href="' . base_url('uploads/marketing-kit/' . $data['file']) . '" target="_blank" class="text-success"><b>Lihat File <i class="fa fa-eye"></i></b></a>';
							}
							?>
							<input type="file" name="file" id="file">
							<small class="text-info">Filih file untuk upload baru</small>
						</div>
					</div>

					<div class="form-group text-center mt-5">
						<a href="<?= base_url('adminarea/marketing/kit/' . ($data['tipe'] == 'kit' ? 'kits' : 'educations')) ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
						<button class="btn btn-success" type="submit" id="submit"><i class="fa fa-edit"></i> Kirim</button>
						<button id="hapus" data-href="<?= base_url('adminarea/marketing/kit/delete/' . $data['id']) ?>" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalKu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title" id="modal-title"></p>
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

		// $('.kit, .edukasi').hide();

		slct();

		function slct() {
			if ($('#tipe').val() == 'kit') {
				$('.kit').show();
				$('.edukasi').hide();
			} else {
				$('.edukasi').show();
				$('.kit').hide();
			}
		}

		$('#tipe').on('change', function() {
			$('.kosong').hide();

			slct();
		});

		$(document).on('submit', '#form', function(e) {
			e.preventDefault();
			var me = $(this);
			$("#submit").prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin"></i>');
			$.ajax({
				url: me.attr('action'),
				type: 'post',
				data: new FormData(this),
				contentType: false,
				cache: false,
				dataType: 'JSON',
				processData: false,
				success: function(json) {
					if (json.form_validation == true) {

						if (json.success == true) {

							$("#submit").prop('disabled', false).html('Kirim');
							alertify.set('notifier', 'position', 'top-right');
							alertify.success('<a style="color:white"><p>' + json.alert + '</p></a>');
							window.location.href = json.href;
							// location.reload();
						} else {
							$("#submit").prop('disabled', false).html('Kirim');
							alertify.set('notifier', 'position', 'top-right');
							alertify.error('<a style="color:white"><p>' + json.alert + '</p></a>');

						}

					} else {
						$("#submit").prop('disabled', false).html('Submit');
						$.each(json.alert, function(key, value) {
							var element = $('#' + key);
							$(element)
								.closest('.form-group')
								.find('.invalid-feedback-show').remove();
							$(element).after(value);
						});
					}
				}
			});
		});

		$(document).on("click", "#hapus", function(e) {
			e.preventDefault();
			$('.modal-dialog').removeClass('modal-lg')
				.removeClass('modal-md')
				.addClass('modal-sm');
			$("#modal-title").text('Konfirmasi hapus');
			$("#modal-body").html(`
            <p>Anda yakin untuk hapus?</p>

            <div class="text-center">
                <button class="btn btn-primary btn-sm" data-dismiss="modal">Tutup</button>
                <a href="` + $(this).data('href') + `" class="btn btn-danger btn-sm">Ya, saya yakin</a>
            </div>

            `);
			$("#modalKu").modal("show");
		});

	});
</script>