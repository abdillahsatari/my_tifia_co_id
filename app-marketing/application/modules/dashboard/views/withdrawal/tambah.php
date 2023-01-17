<!-- END: Subheader -->
<div class="m-subheader">

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
                                Form Withdraw
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <span class="m-section__sub">
                            <p class="font-italic mb-5 text-danger">
                                <i class="fa fa-exclamation-triangle"></i> Pastikan anda telah melengkapi data rekening anda <a href="<?= base_url('dashboard/account/rekening') ?>">disini</a> dan telah mengisi Kesepakatan Kerjasama Kegiatan Pemasaran <a href="<?= base_url('dashboard/account/agreement') ?>">disini</a>.
                            </p>
                        </span>
                        <div class="m-section__content">

                            <form action="<?= base_url() ?>dashboard/Withdrawal/tambah_action" method="POST" id="form">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Bank</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?= $mkt['rekening_bank'] ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor Rekening</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?= $mkt['rekening_nomor'] ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Pemilik Rekening</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?= $mkt['rekening_nama'] ?>" class="form-control" readonly>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                        <div class="input-group mb-3" id="amount">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">IDR</span>
                                            </div>
                                            <input type="number" name="amount" value="0" min="0" step="1000" class="form-control">
                                        </div>
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

        </div>

    </div>
</div>


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
                        $('.form-group').removeClass('.has-error')
                            .removeClass('.has');

                        if (json.success == true) {

                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Success!',
                                text: json.alert,
                                showConfirmButton: false,
                                timer: 2500
                            }).then(function() {
                                window.location.href = json.href;
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