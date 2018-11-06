
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            Change Password 
        </h1>
    </div>
</div> 
     <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change Password for <?php echo $this->session->userdata('user_name') ;?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5">
                        <form role="form" method="post" action="<?php echo base_url();?>user/update_password">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder = "Password" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder = "Confirm Password" id="confirm_password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script type="text/javascript">
    var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>