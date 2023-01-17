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
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#m_modal_4"><span>
                                <i class="la la-send"></i>
                                <span>Kirim Pesan</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <!-- begin kirim pesan ke kantor -->
                            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Departement</th>
                                            <th>Subjek</th>
                                            <th>Status</th>
                                            <th>Tanggal Kirim</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach ($pesan as $key => $value) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->tujuan ?></td>
                                                <td><?= $value->subject ?></td>
                                                <td><span class="m-badge  m-badge--<?php if($value->status_pesan=='Delivered') {
                                                    echo "success";
                                                } elseif($value->status_pesan=='Process') {
                                                    echo "brand";
                                                } elseif($value->status_pesan=='Solved') {
                                                    echo "info";
                                                } ?> m-badge--wide"><?= $value->status_pesan ?></span></td>
                                                <td><?= $value->create_date ?></td>
                                            </tr>
                                        <?php $no++; } ?>
                                        <!-- <tr>
                                            <td>1</td>
                                            <td>Compliance</td>
                                            <td>Ubah data</td>
                                            <td><span class="m-badge  m-badge--success m-badge--wide">Delivered</span></td>
                                            <td>03/12/2017 (09:32)</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Compliance</td>
                                            <td>Ubah data</td>
                                            <td><span class="m-badge  m-badge--brand m-badge--wide">Process</span></td>
                                            <td>03/12/2017 (09:32)</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Compliance</td>
                                            <td>Ubah data</td>
                                            <td><span class="m-badge  m-badge--info m-badge--wide">Solved</span></td>
                                            <td>03/12/2017 (09:32)</td>
                                        </tr> -->
                                        
                                    </tbody>
                                </table>
                            <!-- end kirim pesan -->
                          
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
                <h5 class="modal-title" id="exampleModalLabel">Form Kirim Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="hubungikami/save" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group m-form__group">
                                <!-- <label for="departemen">Ditujukan Kepada * <?php echo form_error('tujuan', '<small class="text-danger pl-3">', '</small>'); ?></label> -->
                                <input type="hidden" class="form-control m-input m-input--square" name="tujuan" id="tujuan" value="Compliance" required>
                                <!-- <select class="form-control m-input" name="tujuan" id="tujuan" required>
                                    <option value="Compliance">Compliance</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Finance">Finance</option>
                                </select> -->
                            </div>
                            <div class="form-group m-form__group">
                                <label for="subjek">Subjek <?php echo form_error('subject', '<small class="text-danger pl-3">', '</small>'); ?></label>
                               <input type="text" class="form-control m-input m-input--square" name="subject" id="subject" required>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="pesan">Isi pesan <?php echo form_error('isi', '<small class="text-danger pl-3">', '</small>'); ?></label>
                                <!-- <input type="text" class="form-control m-input m-input--square" name="pesan" id="pesan"> -->
                                <div class="form-group m-form__group row m--margin-top-10">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <textarea class="summernote" input type="text" name="isi" id="isi"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group">
                                <label for="subjek">File pendukung <?php echo form_error('image', '<small class="text-danger pl-3">', '</small>'); ?></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--end::Modal-->

        
<!-- end:: Body -->

