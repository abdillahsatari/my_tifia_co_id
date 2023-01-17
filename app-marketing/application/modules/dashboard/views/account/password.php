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
                                My Password
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

                            <form action="<?= base_url() ?>dashboard/account/editPass_action" method="POST" id="form">

                                <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="pass_lama">Password lama*</label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input class="form-control" name="pass_lama" id="pass_lama" type="password" placeholder="Password lama">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="pass_baru_1">Password baru*</label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input class="form-control" name="pass_baru_1" id="pass_baru_1" type="password" placeholder="Password baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="pass_baru_2">Konfirmasi password baru*</label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input class="form-control" name="pass_baru_2" id="pass_baru_2" type="password" placeholder="Ketik ulang password baru">
                                        </div>
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