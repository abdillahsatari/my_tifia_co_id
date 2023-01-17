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
                            $hari_ini = new_date();
                            $tgl = date('d', strtotime($hari_ini));
                            $thn = date('Y', strtotime($hari_ini));
                            $nama_date = nama_date($hari_ini);
                            $dt = $nama_date['hari'] . ', ' . $tgl . ' ' . $nama_date['bulan'] . ' ' . $thn;
                            ?>

                            <form action="<?= base_url() ?>dashboard/activity/tambah_action" method="POST" id="form">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Hari</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="<?= $dt ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">No. Form</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="kode" value="ACT-<?= $kode ?>" disabled>
                                        <input type="hidden" name="kode" value="<?= $kode ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="prioritas">Priority</label>
                                    <div class="col-sm-10">
                                        <div id="prioritas">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="prioritas" id="prioritas2" value="Reguler">
                                                <label class="form-check-label" for="prioritas2">
                                                    Reguler
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="prioritas" id="prioritas1" value="Hot prospek" checked>
                                                <label class="form-check-label" for="prioritas1">
                                                    Hot Prospek
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
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori1" value="Panggilan telepon" checked>
                                                <label class="form-check-label" for="kategori1">
                                                    Panggilan telepon
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori2" value="Janji temu">
                                                <label class="form-check-label" for="kategori2">
                                                    Janji temu
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori3" value="Follow up">
                                                <label class="form-check-label" for="kategori3">
                                                    Follow up
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kategori" id="kategori4" value="Closing">
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
                                                <option value="<?= $r->id ?>"><?= $r->nama ?> / <?= $r->kode ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Mitra</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="<?= sess('mkt_nama') . ' / ' . sess('mkt_kode') ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Deskripsi Aktifitas</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="20"></textarea>
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