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
                                Form Tambah Activity
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

                            <?php
                            $hari_ini = $activity['date_added'];
                            $tgl = date('d', strtotime($hari_ini));
                            $thn = date('Y', strtotime($hari_ini));
                            $nama_date = nama_date($hari_ini);
                            $dt = $nama_date['hari'] . ', ' . $tgl . ' ' . $nama_date['bulan'] . ' ' . $thn;
                            ?>

                            <form action="<?= base_url() ?>dashboard/activity/edit_action" method="POST" id="form">

                                <input type="hidden" name="id" value="<?= $activity['id'] ?>">
                                <input type="hidden" name="kode" value="<?= $activity['kode'] ?>">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Hari</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="hari" value="<?= $dt ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">No. Form</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="kode" value="<?= $activity['kode'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="prioritas">Priority</label>
                                    <div class="col-sm-10">
                                        <div id="prioritas">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="prioritas" id="prioritas1" value="Hot prospek" <?= ($activity['prioritas'] == 'Hot prospek' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="prioritas1">
                                                    Hot Prospek
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="prioritas" id="prioritas2" value="Reguler" <?= ($activity['prioritas'] == 'Reguler' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="prioritas2">
                                                    Reguler
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="kategori">Kategori</label>
                                    <div class="col-sm-10">
                                        <div id="kategori">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori1" value="Panggilan telepon" <?= ($activity['kategori'] == 'Panggilan telepon' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="kategori1">
                                                    Panggilan telepon
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori2" value="Janji temu" <?= ($activity['kategori'] == 'Janji temu' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="kategori2">
                                                    Janji temu
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori3" value="Follow up" <?= ($activity['kategori'] == 'Follow up' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="kategori3">
                                                    Follow up
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori4" value="Closing" <?= ($activity['kategori'] == 'Closing' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="kategori4">
                                                    Closing
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="nasabah">Nasabah</label>
                                    <div class="col-sm-10">
                                        <select name="nasabah" class="form-control select2" id="nasabah">
                                            <option value="">-- Pilih nasabah --</option>
                                            <?php
                                            foreach ($calon_nasabah as $r) {
                                            ?>
                                                <option value="<?= $r->id ?>" <?= ($activity['calon_nasabah_id'] == $r->id  ? 'selected' : '') ?>><?= $r->nama ?> / <?= $r->kode ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Mitra</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="mitra" value="<?= sess('mkt_nama') . ' / ' . sess('mkt_kode') ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Deskripsi Aktifitas</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="20"><?= $activity['deskripsi'] ?></textarea>
                                    </div>
                                </div>


                                <div class="form-group text-center mt-5">
                                    <a href="#" class="btn btn-success" id="batal" style="display: none;">Batal <i class="fa fa-times"></i></a>
                                    <a href="#" class="btn btn-success" id="edit">Edit <i class="fa fa-edit"></i></a>
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
            $("#kode, #hari, #mitra").prop("disabled", true);
        }

        function disable_form() {
            $("#form :input").prop("disabled", true);
            $('#edit, #batal').prop("disabled", false);
            $('#submit, #batal').hide();
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