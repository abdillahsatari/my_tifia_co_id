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
                                Nasabah <?= $nasabah['kode'] ?>
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

                            <form action="<?= base_url() ?>dashboard/nasabah/edit_action" method="POST" id="form">

                                <input type="hidden" name="id" value="<?= $nasabah['id'] ?>">
                                <input type="hidden" name="kode" value="<?= $nasabah['kode'] ?>">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Nomor</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="kode" value="<?= $nasabah['kode'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="nama">Nama*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="nama" id="nama" nama type="text" placeholder="" value="<?= $nasabah['nama'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="email">E-mail*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="" value="<?= $nasabah['email'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="no_hp">No. HP*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="no_hp" id="no_hp" type="text" placeholder="" value="<?= $nasabah['no_hp'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="no_telp">No. Telp</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="no_telp" id="no_telp" type="text" placeholder="" value="<?= $nasabah['no_telp'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="jk">Jenis Kelamin*</label>
                                    <div class="col-sm-10">
                                        <select name="jk" id="jk" class="form-control">
                                            <option value="L" <?= ($nasabah['jenis_kelamin'] == 'L' ? 'selected' : '') ?>>Pria</option>
                                            <option value="P" <?= ($nasabah['jenis_kelamin'] == 'P' ? 'selected' : '') ?>>Wanita</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="pekerjaan">Pekerjaan*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="pekerjaan" id="pekerjaan" type="text" placeholder="" value="<?= $nasabah['pekerjaan'] ?>">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="alamat">Alamat*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="alamat" id="alamat" type="text" placeholder="" value="<?= $nasabah['alamat'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Provinsi*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="provinsi" id="provinsi">
                                            <option value="">-- Pilih Provinsi --</option>
                                            <?php
                                            $provinsi = $this->db->get("wil_provinsi")->result();
                                            foreach ($provinsi as $prov) : ?>
                                                <option value="<?= $prov->id ?>" <?= ($nasabah['id_provinsi'] == $prov->id ? 'selected' : '') ?>><?= $prov->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kabupaten / kota*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kabupaten" id="kabupaten">
                                            <?= tampilkan_wilayah("wil_kabupaten", ["province_id" => $nasabah['id_provinsi']], $nasabah['id_kabupaten']) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kecamatan*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kecamatan" id="kecamatan">
                                            <?= tampilkan_wilayah("wil_kecamatan", ["regency_id" => $nasabah['id_kabupaten']], $nasabah['id_kecamatan']) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kelurahan*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kelurahan" id="kelurahan">
                                            <?= tampilkan_wilayah("wil_kelurahan", ["district_id" => $nasabah['id_kecamatan']], $nasabah['id_kelurahan']) ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="prioritas">Priority*</label>
                                    <div class="col-sm-10">
                                        <div>
                                            <div class="form-check" id="prioritas">
                                                <input class="form-check-input" type="radio" name="prioritas" id="prioritas1" value="Hot prospek" <?= ($nasabah['prioritas'] == 'Hot prospek' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="prioritas1">
                                                    Hot Prospek
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="prioritas" id="prioritas2" value="New customer" <?= ($nasabah['prioritas'] == 'New customer' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="prioritas2">
                                                    New customer
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="prioritas" id="prioritas3" value="Reguler" <?= ($nasabah['prioritas'] == 'Reguler' ? 'checked' : '') ?>>
                                                <label class="form-check-label" for="prioritas3">
                                                    Reguler
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- <div class="form-group text-center mt-5">
                                    <a href="#" class="btn btn-success" id="batal" style="display: none;">Batal <i class="fa fa-times"></i></a>
                                    <a href="#" class="btn btn-success" id="edit">Edit <i class="fa fa-edit"></i></a>
                                    <button class="btn btn-success" type="submit" id="submit">Kirim</button>
                                </div> -->
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