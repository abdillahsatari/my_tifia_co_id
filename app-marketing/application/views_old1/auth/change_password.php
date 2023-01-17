
<div class="row">
      <div class="col-md-5 col-xs-12">
            <div class="box box-primary">
                  <div class="box-header with-border">
                        <h3 class="box-title"><?php echo lang('change_password_heading');?></h3>
                  </div>
                  <div id="infoMessage"><?php echo $message;?></div>
                  <!-- lahdakhd -->
                  <?php echo form_open("auth/change_password");?>
                        <div class="box-body">
                              <div class="form-group">
                                    <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                                    <?php echo form_input($old_password);?>
                              </div>
                              <div class="form-group">
                                    <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                                    <?php echo form_input($new_password);?>
                              </div>
                              <div class="form-group">
                                    <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                                    <?php echo form_input($new_password_confirm);?>
                              </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                              <?php echo form_input($user_id);?>
                              <?php echo form_submit('submit', lang('change_password_submit_btn'));?>
                        </div>

                  <?php echo form_close();?>
            </div>
      </div>
      <div class="col-md-7 col-xs-12"></div>
</div>
