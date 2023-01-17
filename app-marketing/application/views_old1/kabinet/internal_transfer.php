<div class="m-subheader">

    <div class="row">
        <div class="col-xl-8">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Internal Transfer
                            </h3>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">

                    <div class="col-md-8">

                        <form action="<?= base_url() ?>internaltransfer/transfer_action" method="POST" id="form">

                            <div class="form-group m-form__group">
                                <label for="akun_asal">Akun Asal</label>
                                <select class="form-control m-input" name="akun_asal" id="akun_asal">
                                    <option value="">--- Pilih ---</option>
                                    <option value="1">Pilih</option>
                                </select>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="akun_tujuan">Akun Tujuan</label>
                                <select class="form-control m-input" name="akun_tujuan" id="akun_tujuan">
                                    <option value="">--- Pilih ---</option>
                                    <option value="1">Pilih</option>
                                </select>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="jumlah">Jumlah * </label>
                                <div class="input-group mb-3" id="jumlah">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">USD</span>
                                    </div>
                                    <input name="jumlah" type="number" class="form-control" placeholder="Jumlah">
                                </div>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="komentar">Komentar</label>
                                <div class="input-group mb-3" id="komentar">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-comment"></i></span>
                                    </div>
                                    <input name="komentar" type="text" class="form-control" placeholder="Komentar">
                                </div>
                            </div>

                            <div class="form-group m-form__group mt-4">

                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>

<!-- end:: Body -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        $("#form").submit(function(e) {
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
                        $('.form-group').removeClass('.has-error')
                            .removeClass('.has');

                        if (json.success == true) {

                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Succes!',
                                text: json.alert,
                                showConfirmButton: false,
                                timer: 2500
                            }).then(function() {
                                if (json.href != '') {
                                    window.location.href = json.href;
                                }
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
                                    .html('Submit');
                            });
                        }

                    } else {
                        $("#submit").prop('disabled', false)
                            .html('Submit');
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