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
                                Simulasi Perhitungan Komisi
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

                            <form action="#" method="POST" id="formku2">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Commission (USD)</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">USD</span>
                                            </div>
                                            <input type="number" class="form-control input-sm" name="commission_usd" min="0" step="0.01" value="0" id="commission_usd">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Lots Traded</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" value="0" min="0" step="0.01" id="lots" name="lots">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="nasabah">Role / title</label>
                                    <div class="col-sm-10">
                                        <select name="role" class="form-control select2" id="role">
                                            <option value="" data-persen="0">-- Pilih title --</option>
                                            <option value="FC" data-persen="80">FC</option>
                                            <option value="HFC" data-persen="7">HFC</option>
                                            <option value="BM" data-persen="5">BM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jumlah Nasabah</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" min="1" step="1" id="nasabah" name="nasabah" value="0">
                                    </div>
                                </div>


                                <div class="form-group text-center mt-5 mb-5">
                                    <button class="btn btn-success" type="submit">Calculate</button>
                                </div>

                                <!-- Result -->

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Commission (IDR)</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">IDR</span>
                                            </div>
                                            <input type="number" class="form-control input-sm" name="commission_idr" id="commission_idr" readonly>
                                        </div>
                                    </div>
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

        // SIMULASI

        $(document).on('submit', '#formku2', function(e) {
            e.preventDefault();

            commission_usd = $('#commission_usd').val();
            lots = $('#lots').val();
            persen_role = $('#role').find(':selected').data('persen');
            nasabah = $('#nasabah').val();

            // console.log(persen_role);

            $('#commission_idr').val(commission_usd * lots * (persen_role / 100) * nasabah * 10000);
        });
    });
</script>