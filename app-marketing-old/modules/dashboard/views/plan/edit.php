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
                                Plan: <?= $plan['kode'] ?>
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

                            <form action="<?= base_url() ?>dashboard/plan/edit_action" method="POST" id="form">

                                <input type="hidden" name="id" value="<?= $plan['id'] ?>">
                                <input type="hidden" name="kode" value="<?= $plan['kode'] ?>">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">No. Form</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="kode" value="<?= $plan['kode'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Peroide*</label>
                                    <div class="col-sm-5">
                                        <select name="bulan" id="bulan" class="form-control">
                                            <!-- <option value="">-- Pilih --</option> -->
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                $nama_bulan = date('F', mktime(0, 0, 0, $i, 10));
                                            ?>
                                                <option value="<?= $i ?>" <?= ($plan['bulan'] == $i ? 'selected' : '') ?>><?= $nama_bulan ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <select name="tahun" id="tahun" class="form-control">
                                            <?php
                                            for ($i = 2021; $i <= date('Y'); $i++) {
                                            ?>
                                                <option value="<?= $i ?>" <?= ($plan['tahun'] == $i ? 'selected' : '') ?>><?= $i ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="judul">Judul*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="judul" id="judul" type="text" value="<?= $plan['judul'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="target_omset">Target Omset*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="target_omset" id="target_omset" type="number" min="0" value="<?= $plan['target_omset'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="2"><?= $plan['deskripsi'] ?></textarea>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold" for="date">Minggu I</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="minggu_1" id="minggu_1" cols="30" rows="5"><?= $plan['minggu_1'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold" for="date">Minggu II</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="minggu_2" id="minggu_2" cols="30" rows="5"><?= $plan['minggu_2'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold" for="date">Minggu III</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="minggu_3" id="minggu_3" cols="30" rows="5"><?= $plan['minggu_3'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label font-weight-bold" for="date">Minggu IV</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="minggu_4" id="minggu_4" cols="30" rows="5"><?= $plan['minggu_4'] ?></textarea>
                                    </div>
                                </div>


                                <div class="form-group text-center mt-5">
                                    <a href="#" class="btn btn-success" id="batal" style="display: none;">Batal <i class="fa fa-times"></i></a>
                                    <a href="#" class="btn btn-success" id="edit">Edit <i class="fa fa-edit"></i></a>
                                    <button class="btn btn-success" type="submit" id="submit" style="display: none;">Kirim</button>
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

        disable_form();

        $(document).on('click', '#edit', function(e) {
            e.preventDefault();
            able_form()
            $('#submit, #batal').show();
            $('#edit').hide();
        });

        $(document).on('click', '#batal', function(e) {
            e.preventDefault();
            disable_form()
            $('#submit, #batal').hide();
            $('#edit').show();
        });

        function able_form() {
            $("#form :input").prop("disabled", false);
            $("#kode").prop("disabled", true);
        }

        function disable_form() {
            $("#form :input").prop("disabled", true);
            $('#edit, #batal').prop("disabled", false);
        }

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
                                window.location.reload();
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