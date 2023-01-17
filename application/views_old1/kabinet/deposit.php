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
                            <h3 class="m-portlet__head-text mr-3">
                                Penyetoran
                            </h3>

                            <div class="">
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#m_modal_4">
                                    <i class="la la-plus"></i>
                                    <span>Baru</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">


                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <!-- begin pilih akun -->
                            <?= $this->session->flashdata('message') ?>
                            <div class="table-responsive">
                                <table class="table table-striped m-table">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Type Deposit</th>
                                            <th>Akun Trading</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($deposit as $key => $value) { ?>
                                            <tr class="text-center">
                                                <td><?= $no ?></td>
                                                <td><a href="<?= base_url('deposit/detail/' . $value->id) ?>" class="text-danger"><?= $value->deposit_id ?> <i class="fa fa-info-circle"></i></a></td>
                                                <td><?= $value->type_deposit ?></td>
                                                <td><?= $value->no_akun ?></td>
                                                <td>IDR <?= rupiah($value->total) ?></td>
                                                <td><?= date_tampil($value->tanggal_deposit) ?></td>
                                                <td><code><?= $value->status_deposit ?></code></td>
                                            </tr>
                                        <?php $no++;
                                        } ?>


                                    </tbody>
                                </table>
                            </div>
                            <!-- end pilih akun -->

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
        <form action="<?= base_url() ?>deposit/save" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Penyetoran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-form__group">
                                <label for="tujuan">Gateway / Rekening Tujuan *</label>
                                <select class="form-control m-input" name="gateway_id" id="gateway_id">
                                    <!-- <option value="" disabled selected>-- pilih --</option> -->
                                    <?php
                                    foreach ($gateway as $r) {
                                        echo '<option value="' . $r->id . '">' . $r->bank . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="form-group m-form__group">
                                <label for="tujuan">Tujuan Deposit *</label>
                                <select class="form-control m-input" name="tujuan" id="tujuan" required>
                                    <option value="" disabled selected>-- pilih --</option>
                                    <option value="deposit_awal">Deposit Awal</option>
                                    <option value="topup">Topup</option>
                                </select>
                            </div> -->
                            <div class="form-group m-form__group" id="topup">
                                <label for="no_akun">No Akun Trading *</label>
                                <select class="form-control m-input" name="no_akun" id="no_akun">
                                    <?php
                                    if (empty($akun)) { ?>
                                        <option value="" disabled>Belum Ada Akun</option>
                                        <?php } else {
                                        foreach ($akun as $key => $value) { ?>
                                            <option value="<?= $value->no_akun ?>"><?= $value->no_akun ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="bank">Rekening Anda *</label>
                                <select class="form-control m-input" name="bank" id="bank">
                                    <?php
                                    if (empty($bank)) { ?>
                                        <option value="" disabled>Belum Ada Data</option>
                                        <?php } else {
                                        foreach ($bank as $key => $value) { ?>
                                            <option value="<?= $value->bank_id ?>"><?= $value->nama_bank ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="jumlah">Jumlah *</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">IDR</span>
                                    </div>
                                    <input type="number" step="1000" min="0" class="form-control m-input m-input--square" id="jumlah" name="jumlah">
                                </div>
                            </div>
                            <!-- <div class="form-group m-form__group">
                                <label for="cabangusd">Upload bukti transfer *</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div> -->
                            <div class="form-group mt-3 mb-0">
                                <p><b>Note:</b> <br>Instruksi transfer akan ditampilkan setelah anda menekan tombol Submit</p>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group m-form__group m--margin-top-10">
                                <div class="alert m-alert m-alert--default" role="alert">
                                    <div class="well">
                                        <table>
                                            <tr>
                                                <td>Untuk Deposit IDR :</td>
                                            </tr>
                                            <tr>
                                                <td>Nama Bank</td>
                                                <td>:</td>
                                                <td>Bank Central Asia (BCA)</td>
                                            </tr>
                                            <tr>
                                                <td>Pemilik Rekening</td>
                                                <td>:</td>
                                                <td>PT. Tifia Finansial Berjangka</td>
                                            </tr>
                                            <tr>
                                                <td>Nomor Akun</td>
                                                <td>:</td>
                                                <td>0353118673</td>
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

                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
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