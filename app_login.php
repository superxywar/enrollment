<?php
  if(isset($_POST['btn_login'])){
    $email   = $_POST['email'];
    $password= $_POST['password'];

    $o_sel = "SELECT * FROM tbl_account WHERE email=:email AND password=:password ";
    $o_sele= $db->prepare($o_sel);
    $o_sele->bindParam(':email',$email);
    $o_sele->bindParam(':password',$password);
    $o_sele->execute();

    if($o_sele->rowCount()==1){
        $o_row = $o_sele->fetch();
        
        if($o_row['type']=='Student'){
          $g_sel = "SELECT * FROM tbl_student WHERE stud_id=:stud_id AND guard_stat='Active'";
          $g_sele= $db->prepare($g_sel);
          $g_sele->bindParam(':stud_id',$o_row['stud_id']);
          $g_sele->execute();
          if($g_sele->rowCount()>=1){
            
            $_SESSION['stud_id'] = $o_row['stud_id'];
            header('Location:production/parent/');
          }
          else{
            $msg = '<div class="alert" style="background-color:#dd4b39; color:#FFF;" id="flash-msg">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <p><strong>Error</strong><br /> your account was inactive.</p>
            </div>';
          }
        }
        else{
          $g_sel = "SELECT * FROM tbl_teacher WHERE teach_id=:teach_id AND status='Active'";
          $g_sele= $db->prepare($g_sel);
          $g_sele->bindParam(':teach_id',$o_row['teach_id']);
          $g_sele->execute();
          if($g_sele->rowCount()>=1){
            $_SESSION['teach_id'] = $o_row['teach_id'];

            $s_sel = "SELECT * FROM tbl_schoolyear WHERE status='Active'";
            $s_sele= $db->prepare($s_sel);
            $s_sele->execute();
            $s_row = $s_sele->fetch();

            $_SESSION['sy_id'] = $s_row['sy_id'];
            header('Location:production/teach/');
          }
          else{
            $msg = '<div class="alert" style="background-color:#dd4b39; color:#FFF;" id="flash-msg">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <p><strong>Error</strong><br /> your account was inactive.</p>
            </div>';
          } 
        }
    }
    else{
      
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
        <p style="line-height:25px; text-align:center;" class="column-title">
          <span style="font-size:30px; font-weight:bold;">IPIL SDA PORTAL</span><br>
          <span style="font-size:14px; ">SIGN IN TO  YOUR ACCOUNT</span><br>
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