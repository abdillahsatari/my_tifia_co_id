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
                                Pilih Tipe Akun Real
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <!-- begin pilih akun -->
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="akuntrading/saveRequestReal" method="post" accept-charset="utf-8">
                                        <div class="form-group m-form__group">
                                            <label for="jenisakun">Jenis Akun *</label>
                                            <select class="form-control m-input" name="type" id="type" required="">
                                                <?php foreach ($tipe as $key => $value) { ?>
                                                    <option value="<?= $value->acc_type_id ?>"><?= $value->type ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>                                
                                        <div class="form-group m-form__group">
                                            <label for="nilaitukar">Nilai Tukar *</label>
                                            <select class="form-control m-input" name="currency" id="currency" required="">
                                                <?php foreach ($nilai_tukar as $key => $value) { ?>
                                                    <option value="<?= $value->acc_currency_id ?>"><?= $value->nama_currency ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="leverage">Leverage *</label>
                                            <select class="form-control m-input" name="leverage" id="leverage" required="">
                                                <?php foreach ($leverage as $key => $value) { ?>
                                                    <option value="<?= $value->acc_leverage_id ?>"><?= $value->nama_leverage ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <div class="m-form__actions">
                                                <button type="submit" name="submit" class="btn btn-primary">Selanjutnya</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div> 
                            <!-- end pilih akun -->
                        </div>
                    </div>
                    <!--end::Section-->
                </div>  
            </div>
        </div>
    </div>
</div>

        
<!-- end:: Body -->

