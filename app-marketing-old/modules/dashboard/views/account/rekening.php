<!-- END: Subheader -->
<div class="m-subheader">


    <?= $this->session->flashdata('message') ?>


    <div class="row">

        <div class="col-md-8">

            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                My Bank Account
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <span class="m-section__sub">
                            <!--  -->
                        </span>
                        <div class="m-section__content">

                            <form action="<?= base_url() ?>dashboard/account/editBank_action" method="POST" id="form">

                                <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="rekening_nama">Nama pemilik rekening*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="rekening_nama" id="rekening_nama" type="text" value="<?= $data['rekening_nama'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="rekening_bank">Bank*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="rekening_bank" id="rekening_bank" type="text" value="<?= $data['rekening_bank'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="rekening_nomor">Nomor rekening*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="rekening_nomor" id="rekening_nomor" type="text" value="<?= $data['rekening_nomor'] ?>">
                                    </div>
                                </div>


                                <div class="form-group text-center mt-5">
                                    <a href="<?= base_url('dashboard') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    <button class="btn btn-success" type="submit" id="submit">Kirim</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<script src="<?= base_url() ?>assets/wilayah-administratif.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        function disable_form() {
            $("#form :input").prop("disabled", true);
            $('#file_foto, #file_ktp, #file_cv, #file_ijazah, #file_sertifikat_1, #file_sertifikat_2, #id').prop("disabled", false);
            // $('#submit').hide();
        }

        $(document).on("click", ".lihat_file", function(e) {
            e.preventDefault();

            window.open('<?= base_url('uploads/marketing/') ?>' + $(this).data("href"), '_blank');
        });


        $("#file_foto, #file_ktp, #file_cv, #file_ijazah, #file_sertifikat_1, #file_sertifikat_2").change(function() {

            var field = $(this).data("field");
            // alert(field + " has been selected." + $('#id').val());

            // ambil gambar
            var file_data = $(this).prop("files")[0];

            // buat dan isi form
            var form_data = new FormData();
            form_data.append(field, file_data);
            form_data.append("field", field);
            form_data.append("marketing_id", $('#id').val());

            $.ajax({
                url: "<?= base_url('dashboard/account/upload_files') ?>",
                type: 'post',
                data: form_data,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                processData: false,
                success: function(json) {
                    if (json.success == true) {
                        $.toast({
                            heading: 'Success',
                            text: json.alert,
                            position: 'top-right',
                            textAlign: 'left',
                            hideAfter: 2500,
                            icon: 'success',
                            afterHidden: function() {
                                // window.location.href = json.href;
                                location.reload();
                            }
                        });

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: json.alert,
                            position: 'top-right',
                            textAlign: 'left',
                            hideAfter: 5000,
                            icon: 'error'
                        });
                    }

                }
            });

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

                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Success!',
                                text: json.alert,
                                showConfirmButton: false,
                                timer: 2500
                            }).then(function() {
                                // window.location.href = json.href;
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: 'Error!',
                                text: json.alert,
                                showConfirmButton: false,
                                timer: 2500
                            }).then(function() {
                                $("#submit").prop('disabled', false)
                                    .html('Kirim');
                            });
                        }

                    } else {
                        $("#submit").prop('disabled', false)
                            .html('Kirim');
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