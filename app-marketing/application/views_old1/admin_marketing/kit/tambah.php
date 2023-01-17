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

				<form action="<?= base_url('adminarea/marketing/kit/tambah_action') ?>" method="POST" id="form" enctype="multipart/form-data">


					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-10">
							<input class="form-control" type="text" id="nama" name="nama">
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="tipe">Tipe</label>
						<div class="col-sm-10">
							<select name="tipe" class="form-control select2" id="tipe">
								<option value="">-- Pilih --</option>
								<option value="kit">Kit</option>
								<option value="edukasi">Edukasi</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="jenis">Jenis</label>
						<div class="col-sm-10">
							<select name="jenis" class="form-control select2" id="jenis">
								<option class="kosong" value="" selected disabled>-- pilih --</option>
								<option class="kit" value="Company Profile">Company Profile</option>
								<option class="kit" value="Product Knowledge">Product Knowledge</option>
								<option class="kit" value="Perhitungan Komisi">Perhitungan Komisi</option>
								<option class="kit" value="Video Promosi">Video Promosi</option>
								<option class="edukasi" value="Marketing Digital">Marketing Digital</option>
								<option class="edukasi" value="Sales Education">Sales Education</option>
								<option class="edukasi" value="Trading Education">Trading Education</option>
								<option class="edukasi" value="Leadership & Motivation">Leadership & Motivation</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="file">File</label>
						<div class="col-sm-10">
							<input type="file" name="file" id="file">
						</div>
					</div>

					<div class="form-group text-center mt-5">
						<button class="btn btn-success" type="submit" id="submit">Kirim</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		$('.kit, .edukasi').hide();

		$('#tipe').on('change', function() {
			$('.kosong').hide();

			if ($('#tipe').val() == 'kit') {
				$('.kit').show();
				$('.edukasi').hide();
			} else {
				$('.edukasi').show();
				$('.kit').hide();
			}
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

	});
</script>