<!-- Default box -->
<div class="row">
  <div class="col-md-5 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Password</h3>
      </div>
        <!-- /.box-header -->
        <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Password Lama</label>
            <?php echo form_input($old_password);?>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
         <div class="form-group">
            <label for="exampleInputPassword1">NewPassword</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-7 col-xs-12">
    <!-- Profile Image -->
  <!--   <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/dist/img/user4-128x128.jpg" alt="User profile picture">
        <h3 class="profile-username text-center">Nina Mcintire</h3>
        <p class="text-muted text-center">Software Engineer</p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right">email</a>
          </li>
          <li class="list-group-item">
            <b>Telepon</b> <a class="pull-right">Telepon</a>
          </li>
        </ul>
        <a href="<?= base_url();?>auth/logout" class="btn bg-purple btn-block"><b>Sign Out</b></a>
      </div>
      
    </div> -->
    <!-- /.box -->
  </div>
  <!--  box edit-->
  
  <!--  / box edit-->

  
</div>
    