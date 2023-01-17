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
                                Form Tambah Sales
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

                            <form action="<?= base_url() ?>dashboard/sales/register_action" method="POST" id="form" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Nomor</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="kode" value="MTFX-<?= $kode ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="nama">Nama*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="nama" id="nama" nama type="text" placeholder="" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="email">E-mail*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="email" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="no_hp">No. HP*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="no_hp" id="no_hp" type="text" placeholder="">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="tempat_lahir">Tempat/tanggal Lahir</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="tempat_lahir" id="tempat_lahir" type="text" placeholder="Tempat lahir">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="input-group date">

                                            <input type="text" class="form-control m-input datepicker" name="tanggal_lahir" id="m_datepicker_3" />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar"></i>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="jk">Jenis Kelamin*</label>
                                    <div class="col-sm-10">
                                        <select name="jk" id="jk" class="form-control">
                                            <option value="L">Pria</option>
                                            <option value="P">Wanita</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="status">Status*</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="status" class="form-control">
                                            <option value="Lajang">Lajang</option>
                                            <option value="Menikah">Menikah</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="pendidikan">Pendidikan*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="pendidikan" id="pendidikan" type="text" placeholder="">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="alamat">Alamat*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="alamat" id="alamat" type="text" placeholder="">
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
                                                <option value="<?= $prov->id ?>"><?= $prov->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kabupaten / kota*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kabupaten" id="kabupaten">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kecamatan*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kecamatan" id="kecamatan">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kelurahan*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kelurahan" id="kelurahan">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-5">
                                    <button class="btn btn-success" type="submit" id="submit">Selanjutnya <i class="fa fa-arrow-right"></i></button>
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
                                timer: 4000
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
                                    .html('Selanjutnya <i class="fa fa-arrow-right"></i>');
                            });
                        }

                    } else {
                        $("#submit").prop('disabled', false)
                            .html('Selanjutnya <i class="fa fa-arrow-right"></i>');
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