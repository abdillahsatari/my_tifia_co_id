  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    
    <div class="row">
        <div class="col-lg-8">
          <?php echo form_open_multipart('user/changepassword');?>
           <?= $this->session->flashdata('message'); ?>
            <div class="form-group row">
              <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="current_password" name="current_password">
                <?php echo form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="new_password1" class="col-sm-2 col-form-label">New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="new_password1" name="new_password1">
                <?php echo form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>

             <div class="form-group row">
              <label for="new_password2" class="col-sm-2 col-form-label">Retype Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="new_password2" name="new_password2">
                 <?php echo form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>


            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary small"> Submit</button>
                </div>
            </div>
            
          </form>

        </div>
    </div>
    
          
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

     