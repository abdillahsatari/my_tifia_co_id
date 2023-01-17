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
                                Sales <?= $data['kode'] ?>
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

                            <form action="<?= base_url() ?>dashboard/sales/edit_action" method="POST" id="form" enctype="multipart/form-data">

                                <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">
                                <input type="hidden" name="kode" id="kode" value="<?= $data['kode'] ?>">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Nomor</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="kode" value="<?= $data['kode'] ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="nama">Nama*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="nama" id="nama" nama type="text" value="<?= $data['nama'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="email">E-mail*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="email" value="<?= $data['email'] ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="no_hp">No. HP*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="no_hp" id="no_hp" type="text" value="<?= $data['no_hp'] ?>">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="tempat_lahir">Tempat/tanggal Lahir</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="tempat_lahir" id="tempat_lahir" type="text" value="<?= $data['tempat_lahir'] ?>">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="input-group date">

                                            <input type="text" class="form-control m-input datepicker" name="tanggal_lahir" id="m_datepicker_3" value="<?= $data['tanggal_lahir'] ?>" />
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
                                            <option value="L" <?= ($data['jenis_kelamin'] == 'L' ? 'selected' : '') ?>>Pria</option>
                                            <option value="P" <?= ($data['jenis_kelamin'] == 'P' ? 'selected' : '') ?>>Wanita</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="status">Status*</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="status" class="form-control">
                                            <option value="Lajang" <?= ($data['status'] == 'Lajang' ? 'selected' : '') ?>>Lajang</option>
                                            <option value="Menikah" <?= ($data['status'] == 'Menikah' ? 'selected' : '') ?>>Menikah</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="pendidikan">Pendidikan*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="pendidikan" id="pendidikan" type="text" value="<?= $data['pendidikan'] ?>">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="alamat">Alamat*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="alamat" id="alamat" type="text" value="<?= $data['alamat'] ?>">
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
                                                <option value="<?= $prov->id ?>" <?= ($data['id_provinsi'] == $prov->id ? 'selected' : '') ?>><?= $prov->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kabupaten / kota*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kabupaten" id="kabupaten">
                                            <?= tampilkan_wilayah("wil_kabupaten", ["province_id" => $data['id_provinsi']], $data['id_kabupaten']) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kecamatan*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kecamatan" id="kecamatan">
                                            <?= tampilkan_wilayah("wil_kecamatan", ["regency_id" => $data['id_kabupaten']], $data['id_kecamatan']) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kelurahan*</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kelurahan" id="kelurahan">
                                            <?= tampilkan_wilayah("wil_kelurahan", ["district_id" => $data['id_kecamatan']], $data['id_kelurahan']) ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <p><strong>DOCUMENT UPLOAD</strong></p>

                                <div class="form-group row">
                                    <label class="col-sm-4" for="file_foto">Foto diri terbaru* <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                    <div class="col-sm-4">
                                        <input name="file_foto" id="file_foto" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_foto">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        if ($data['file_foto'] != '') {
                                        ?>
                                            <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_foto'] ?>">Lihat file</a>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="text-danger text-left">Belum ada file</span>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4" for="file_ktp">Foto KTP* <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                    <div class="col-sm-4">
                                        <input name="file_ktp" id="file_ktp" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_ktp">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        if ($data['file_ktp'] != '') {
                                        ?>
                                            <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_ktp'] ?>">Lihat file</a>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="text-danger text-left">Belum ada file</span>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4" for="file_cv">CV* <small>Max. 2MB (pdf/word)</small> </label>
                                    <div class="col-sm-4">
                                        <input name="file_cv" id="file_cv" type="file" class="file_up" data-field="file_cv">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        if ($data['file_cv'] != '') {
                                        ?>
                                            <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_cv'] ?>">Lihat file</a>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="text-danger text-left">Belum ada file</span>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4" for="file_ijazah">Ijazah <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                    <div class="col-sm-4">
                                        <input name="file_ijazah" id="file_ijazah" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_ijazah">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        if ($data['file_ijazah'] != '') {
                                        ?>
                                            <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_ijazah'] ?>">Lihat file</a>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="text-danger text-left">Belum ada file</span>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4" for="file_sertifikat_1">Sertifikat <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                    <div class="col-sm-4">
                                        <input name="file_sertifikat_1" id="file_sertifikat_1" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_sertifikat_1">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        if ($data['file_sertifikat_1'] != '') {
                                        ?>
                                            <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_sertifikat_1'] ?>">Lihat file</a>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="text-danger text-left">Belum ada file</span>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4" for="file_sertifikat_2">Sertifikat <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                    <div class="col-sm-4">
                                        <input name="file_sertifikat_2" id="file_sertifikat_2" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_sertifikat_2">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        if ($data['file_sertifikat_2'] != '') {
                                        ?>
                                            <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_sertifikat_2'] ?>">Lihat file</a>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="text-danger text-left">Belum ada file</span>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-5">
                                    <a href="<?= base_url('dashboard/sales') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>

                                    <?php
                                    if ($this->input->get('type') != 'upload') {
                                    ?>
                                        <button class="btn btn-success" type="submit" id="submit">Kirim</button>
                                    <?php
                                    }
                                    ?>
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

        <?php
        if ($this->input->get('type') == 'upload') {
        ?>
            disable_form();
        <?php
        }
        ?>

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
                url: "<?= base_url('dashboard/sales/upload_files') ?>",
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