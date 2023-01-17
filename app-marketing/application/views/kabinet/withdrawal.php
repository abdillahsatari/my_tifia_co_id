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
                                Penarikan
                            </h3>

                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#m_modal_4">
                                <i class="la la-plus"></i>
                                Baru
                            </button>
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
                                            <th>No Order</th>
                                            <th>Waktu pengajuan</th>
                                            <th>No Akun</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($wd as $key => $value) { ?>
                                            <tr class="text-center">
                                                <td><?= $no; ?>.</td>
                                                <td class="text-left"><a href="#" class="text-danger"><?= $value->withdraw_id ?></a></td>
                                                <td><?= date_tampil($value->tanggal_withdraw) ?></td>
                                                <td><?= $value->no_akun ?></td>
                                                <td>IDR <?= rupiah($value->total) ?></td>
                                                <td><code><?= $value->status_withdraw ?></code></td>
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
            <form action="<?= base_url() ?>withdrawal/save" method="post" id="formm" accept-charset="utf-8">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Penarikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="noakun"><strong>Informasi Akun & Rekening Bank</strong></label>
                            <div class="form-group m-form__group">
                                <label for="no_akun_wd">No Akun *</label>
                                <select class="form-control m-input" name="no_akun_wd" id="no_akun_wd">
                                    <?php
                                    if (empty($akun)) { ?>
                                        <option value="">-- Belum Ada Akun --</option>
                                    <?php } else { ?>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($akun as $key => $value) { ?>
                                            <option value="<?= $value->no_akun ?>"><?= $value->no_akun ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="bank_select">Rekening *</label>
                                <select class="form-control m-input" name="bank_select" id="bank_select">
                                    <?php
                                    if (empty($bank)) { ?>
                                        <option value="">-- Belum Ada Data --</option>
                                    <?php } else { ?>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($bank as $key) { ?>
                                            <option value="<?= $key->bank_id ?>"><?= $key->nama_bank ?> <?= $key->no_rekening ?> (<?= $key->currency ?>)</option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="namapemilik">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control m-input m-input--square" id="nmpemilik_slc" readonly>

                            </div>
                            <!-- <div class="form-group m-form__group">
                                <label for="jumlah">Swift Code</label>
                                <input type="text" class="form-control m-input m-input--square" id="kodebank_slc" readonly>
                            </div> -->


                            <label><strong>Jumlah yang diajukan (USD)</strong></label>

                            <div class="form-group m-form__group" style="display: none;">
                                <label for="komisi">Komisi Charge (USD)</label>
                                <input type="text" class="form-control m-input m-input--square" name="komisi" id="komisi" readonly>
                            </div>

                            <input type="hidden" name="wd_ratee" id="wd_ratee" value="">

                            <div class="form-group m-form__group">
                                <label for="jumlahidr">Jumlah Pembayaran (USD)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">USD</span>
                                    </div>
                                    <input type="number" class="form-control m-input m-input--square" name="jumlah_usd" id="jumlah_usd" min="0">
                                </div>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="nilaitukar">Nilai Tukar</label>
                                <input type="text" class="form-control m-input m-input--square" name="nilaitukar" id="nilaitukar" value="" readonly>
                            </div>


                            <div class="form-group m-form__group">
                                <label for="jumlahidr">Jumlah Pembayaran (IDR)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">IDR</span>
                                    </div>
                                    <input type="number" class="form-control m-input m-input--square" name="jumlah" id="jumlah" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->


<!-- end:: Body -->


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).on('change keyup', '#jumlah_usd', function(e) {
            var wd_rate = $('#wd_ratee').val();
            // var wd_rate = 10000;

            var jumlah_usd = $('#jumlah_usd').val();

            var jumlah_idr = jumlah_usd * wd_rate;

            console.log(jumlah_idr);

            $('#jumlah').val(jumlah_idr);

        });

        $(document).on('change', '#no_akun_wd', function(e) {
            var accid = $(this).val();

            $.ajax({
                url: "<?= base_url() ?>akuntrading/getAccDetail",
                method: "POST",
                data: {
                    accid: accid
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    komisi = data.komisi;
                    if (komisi == null) {
                        komisi = 0;
                    }

                    $("#komisi").val(komisi);
                    $("#nilaitukar").val(data.nama_currency + ' | ' + data.withdraw_rate);
                    $("#wd_ratee").val(data.withdraw_rate);
                }
            });
        });

        $(document).on('submit', '#formm', function(e) {
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