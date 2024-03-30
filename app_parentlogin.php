<?php
  if(isset($_POST['btn_login'])){
    $email   = $_POST['email'];
    $password= $_POST['password'];

    $o_sel = "SELECT * FROM tbl_student WHERE guardian_email=:guardian_email AND password=:password";
    $o_sele= $db->prepare($o_sel);
    $o_sele->bindParam(':guardian_email',$email);
    $o_sele->bindParam(':password',$password);
    $o_sele->execute();

    if($o_sele->rowCount()==1){
        $o_row = $o_sele->fetch();
        $_SESSION['stud_id'] = $o_row['stud_id'];
        

        
        if($o_row['guard_stat']=='Active'){
          $stud_id = $o_row['stud_id'];
          header('Location:production/parent/');
        }
        else{
          $msg = '<div class="alert" style="background-color:#dd4b39; color:#FFF;" id="flash-msg">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <p><strong>Error</strong><br />Please confirm your registration by  verifying your e-mail address.</p>
          </div>';
        }
    }
    else{
      $msg = '<div class="alert" style="background-color:#dd4b39; color:#FFF;" id="flash-msg">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <p><strong>Error</strong><br /> incorrect e-mail and password</p>
      </div>';
    }
  }
?>
<script type="text/javascript">
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
        
</script>
<section id="main-container" class="main-container">
  <div class="container" style="margin-top:-30px; ">
    
    <div class="row">
      <div class="col-md-6" style="margin: 0 auto;">
        <?php
          if(!empty($msg)){
            echo $msg;
          }
        ?>
        <p>
          <h4 class="column-title">PARENT PORTAL</h4>
          <h4 class="column-title">SIGN IN TO  YOUR ACCOUNT<br></h4>
          <hr style="margin-top:-40px;">
        </p>
        
        <form  method="post" role="form" style="margin-top:-30px;" name="frm">
          <div class="row">
            
            <div class="col-md-12">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Email</label>
                <input class="form-control" name="email" placeholder="Input E-mail" type="email" required autocomplete="off">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Password</label>
                <!--<a href="#" onclick="myFunction()" style="float:right;">&nbsp;&nbsp;Show Password</a>-->
                <input class="form-control" name="password" placeholder="Input Password" type="password" required autocomplete="off" id="myInput">
                
              </div>
            </div>
          </div>
          <div style="text-align:center;">
            <button class="btn btn-success" name="btn_login" type="submit" style="font-size:14px; width:30%;">Sign In</button>
          </div>
        </form>
      </div>
    </div><!-- Content row -->
  </div><!-- Conatiner end -->
</section><!-- Main container end -->