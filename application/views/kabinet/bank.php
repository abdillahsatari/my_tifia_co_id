<!-- BEGIN: Subheader -->
<!--  <div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">Dashboard</h3>
        </div>
        
    </div>
</div> -->

<!-- END: Subheader -->
<div class="m-subheader ">

    <div class="row ui-sortable" id="m_sortable_portlets">
        <div class="col-lg">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Pengajuan Penambahan Rekening Bank
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="text-center">

                        <button type="button" class="btn btn-sm btn-warning mb-4" data-toggle="modal" data-target="#m_modal_4">
                            <i class="la la-plus"></i>
                            <span>Ajukan Rekening Baru</span>
                        </button>
                    </div>

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <!-- begin pilih akun -->
                            <?= $this->session->flashdata('message') ?>
                            <div class="table-responsive">
                                <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Bank</th>
                                            <th>No Rekening</th>
                                            <th>Nama Pemilik</th>
                                            <th>Cabang</th>
                                            <th>Currency</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($bank as $key => $value) { ?>
                                            <tr class="text-center">
                                                <td><?= $no; ?>.</td>
                                                <td><?= $value->nama_bank ?></td>
                                                <td><?= $value->no_rekening ?></td>
                                                <td class="text-left"><?= $value->atas_nama ?></td>
                                                <td><?= $value->cabang ?></td>
                                                <td><?= $value->currency ?></td>
                                                <td><code><?= $value->status_bank ?></code></td>
                                            </tr>
                                        <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                                <!-- end pilih akun -->
                            </div>

                        </div>

                    </div>

                    <!--end::Section-->
                </div>
                <!--  -->

                <!--  -->
            </div>
            <!--end::Portlet-->

        </div>
    </div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pengajuan Akun Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>bank/save" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group">
                                <label for="namabank">Nama Bank *</label>
                                <input type="text" class="form-control m-input m-input--square" name="bank" id="bank">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="norekening">No Rekening *</label>
                                <input type="text" class="form-control m-input m-input--square" name="no_rekening" id="no_rekening" onkeyup="">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="namarekening">Atas Nama *</label>
                                <input type="text" class="form-control m-input m-input--square" name="atas_nama" id="atas_nama" value="<?= $this->session->userdata('nsb_nama') ?>">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="cabang">Currency *</label>
                                <select class="form-control m-input m-input--square" name="currency" id="currency">
                                    <option value="IDR" selected>IDR</option>
                                    <!-- <option value="USD">USD</option> -->
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="cabang">Jenis Rekening *</label>
                                <input type="text" class="form-control m-input m-input--square" value="Tabungan" name="jenis_rekening" id="jenis_rekening">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group m-form__group">
                                <label for="cabang">Kode Bank</label>
                                <input type="text" class="form-control m-input m-input--square" name="kode_bank" id="kode_bank">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="cabang">Cabang</label>
                                <input type="text" class="form-control m-input m-input--square" name="cabang" id="cabang">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="cabang">Telepon Bank</label>
                                <input type="text" class="form-control m-input m-input--square" name="tlp" id="tlp">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="image">Upload cover buku tabungan *</label>
                                <!-- <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" class="img-thumbnail"> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group m-form__group m--margin-top-10">
                                <div class="alert m-alert m-alert--default" role="alert">
                                    <div class="well">
                                        <table>
                                            <tr>
                                                <td>Akun Bank Anda (IDR) :</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Bank</td>
                                                <td>:</td>
                                                <td>Bank Central Asia (BCA)</td>
                                            </tr>
                                            <tr>
                                                <td>Pemilik Rekening</td>
                                                <td>:</td>
                                                <td>...</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Akun</td>
                                                <td>:</td>
                                                <td>...</td>
                                            </tr>
                                            <tr>
                                                <td>Mata Uang</td>
                                                <td>:</td>
                                                <td>IDR</td>
                                            </tr>
                                            <tr>
                                                <td>Swift Code</td>
                                                <td>:</td>
                                                <td>CENAIDJA</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-form__group m--margin-top-10">
                                <div class="alert m-alert m-alert--default" role="alert">
                                    <div class="well">
                                        <table>
                                            <tr>
                                                <td>Akun Bank Anda USD :</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Bank</td>
                                                <td>:</td>
                                                <td>...</td>
                                            </tr>
                                            <tr>
                                                <td>Pemilik Rekening</td>
                                                <td>:</td>
                                                <td>...</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Akun</td>
                                                <td>:</td>
                                                <td>...</td>
                                            </tr>
                                            <tr>
                                                <td>Mata Uang</td>
                                                <td>:</td>
                                                <td>...</td>
                                            </tr>
                                            <tr>
                                                <td>Swift Code</td>
                                                <td>:</td>
                                                <td>...</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal-->


<!-- end:: Body -->


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
                                // $("#m_modal_4").modal('hide');
                                //  $("#tableku").DataTable().ajax.reload();
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
                                $("#submit").prop('disabled', false).html('Submit');
                            });
                        }

                    } else {
                        $("#submit").prop('disabled', false).html('Submit');
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