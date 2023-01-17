          <div class="m-subheader">
            <div class="row">
              <div class="col-md-12">

                <!--begin::Change Password-->
                <?php echo form_open_multipart('changepassword');?>
                 <?= $this->session->flashdata('message'); ?>
                <div class="m-portlet m-portlet--tab">
                  <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                          <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                          Ganti Password
                        </h3>
                      </div>
                    </div>
                  </div>

                  <!--begin::Form-->
                  <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                      <div class="form-group m-form__group m--margin-top-10">
                        <div class="alert m-alert m-alert--default" role="alert">
                          Inget selalu password anda!, jangan pernah memberitahukan password anda kepada siapapun!
                        </div>
                      </div>
                      <div class="form-group m-form__group">
                        <label for="current_password">Password Saat ini</label>
                        <input type="password" class="form-control m-input"  id="current_password" name="current_password">
                      </div>  
                      <div class="form-group m-form__group">
                        <label for="new_password1">Password Baru</label>
                        <input type="password" class="form-control m-input"  id="new_password1" name="new_password1">
                        <?php echo form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                      <div class="form-group m-form__group">
                        <label for="new_password2">Ketik Ulang Password Baru</label>
                        <input type="password" class="form-control m-input"  id="new_password2" name="new_password2">
                         <?php echo form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                      <div class="m-form__actions">
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                        <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                    
                  </form>

                  <!--end::Form-->
                </div>
                </form>
                <!--end::Change Password-->
              </div>

            </div>
          </div>