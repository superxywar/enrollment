<?php
    if(isset($_POST['btn_login'])){
        $stud_no            = $_POST['stud_no'];
        $firstname          = $_POST['firstname'];
        $lastname           = $_POST['lastname'];
        $guardian_name      = $_POST['guardian_name'];
        $guardian_contact   = $_POST['guardian_contact'];  
        $email              = $_POST['email'];
        $password           = $_POST['password'];

        //blank
        $ext_name	= '';
        $middlename	= '';
        $birth_date = '';
		$gender     = '';
        $address    = '';
        $religion   = '';
        $tribe      = '';
        $mothert    = '';
        $psa        = '';
        $lrn        = '';
        $father_name= '';
		$mother_name= '';	
		$father_contact		= '';
		$mother_contact		= '';
        $father_email    	= '';
        $mother_email   	= '';
		$guard_stat         = 'Inactive';
        $activation =   md5($email.time());

        $o_sel = "SELECT * FROM tbl_student WHERE firstname=:firstname AND lastname=:lastname";
        $o_sele= $db->prepare($o_sel);
        $o_sele->bindParam(':firstname',$firstname);
        $o_sele->bindParam(':lastname',$lastname);
        $o_sele->execute();

        if($o_sele->rowCount()>=1){
            
            $msg = '<div class="alert" style="background-color:#dd4b39; color:#FFF;" id="flash-msg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <p><strong>Error</strong><br />student already exist.</p>
            </div>';
        }
        else{
            
            $insert ="INSERT INTO tbl_student (stud_no,psa_no,lrn_number,firstname,lastname,middlename,ext_name,birth_date,gender,address,religion,mother_tongue,tribe,father_name,father_email,father_contact,mother_name,mother_email,mother_contact,guardian_name,guardian_email,guardian_contact,guard_stat,password,activation) VALUES (:stud_no,:psa_no,:lrn_number,:firstname,:lastname,:middlename,:ext_name,:birth_date,:gender,:address,:religion,:mother_tongue,:tribe,:father_name,:father_email,:father_contact,:mother_name,:mother_email,:mother_contact,:guardian_name,:guardian_email,:guardian_contact,:guard_stat,:password,:activation)";
            $insert_col=$db->prepare($insert);
            $insert_col->bindParam(':stud_no',$stud_no);
            $insert_col->bindParam(':psa_no',$psa);
            $insert_col->bindParam(':lrn_number',$lrn);
            $insert_col->bindParam(':firstname',$firstname);
            $insert_col->bindParam(':lastname',$lastname);
            $insert_col->bindParam(':middlename',$middlename);
            $insert_col->bindParam(':ext_name',$ext_name);
            $insert_col->bindParam(':birth_date',$birth_date);
            $insert_col->bindParam(':gender',$gender);
            $insert_col->bindParam(':address',$address);
            $insert_col->bindParam(':religion',$religion);
            $insert_col->bindParam(':mother_tongue',$mothert);
            $insert_col->bindParam(':tribe',$tribe);
            $insert_col->bindParam(':father_name',$father_name);
            $insert_col->bindParam(':father_email',$father_email);
            $insert_col->bindParam(':father_contact',$father_contact);
            $insert_col->bindParam(':mother_name',$mother_name);
            $insert_col->bindParam(':mother_email',$mother_email);
            $insert_col->bindParam(':mother_contact',$mother_contact);
            $insert_col->bindParam(':guardian_name',$guardian_name);
            $insert_col->bindParam(':guardian_email',$email);
            $insert_col->bindParam(':guardian_contact',$guardian_contact);
            $insert_col->bindParam(':guard_stat',$guard_stat);
            $insert_col->bindParam(':password',$password);
            $insert_col->bindParam(':activation',$activation);
            $insert_col->execute();


            $subject = 'IPIL DISTRICT ADVENTIST ELEMENTARY SCHOOL INC. SYSTEM MESSAGE';
            $message = 'Good Day!!!, Mr & Mrs. '.$lastname.'';
            $message .="\r\n";
            $message .= 'This will be your credentials to login our website using parents portal. ';
            $message .="\r\n";
            $message .= 'E-mail: '.$email;
            $message .="\r\n";
            $message .= 'Password: '.$password;
            $message .="\r\n";
            $message .= 'Please click the link to activate your account : https://ipilsda.com/script_guardianauthenticate.php?activation='.$activation;
                        
            $url = "https://script.google.com/macros/s/AKfycbwXsS6kMWaMbH8jS_GIIzQgjgFXyIN6o5LbJ-UFRuqsyoShIh7kmPwH-Wzw9Vr6OWOuzQ/exec";
            $ch = curl_init($url);
            curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => http_build_query([
                "recipient" => $email,
                "subject"   => $subject,
                "body"      => $message
            ])
            ]);
            $result = curl_exec($ch);

            header('Location:resources/script_insertstudaccount.php');
            
        }
    }

    //declaration of student no number
    $query ="SELECT * FROM tbl_student ORDER BY stud_id ASC";
    $querys= $db->prepare($query);
    $querys->execute();
    if($querys->rowCount()>=1){
    while($row=$querys->fetch()){
      $date2=$row['stud_no'];
      $date1= date('Y');
      $month= date('m');
      $val = explode("-",$date2);
      $val[1];
      $new = $val[1]+1;
      $new = (string)$new;

      $con = strlen($new);
      
      for($j=1;$j<=3-$con;$j++){
      $new = '0'.$new;
      }
      
    
    
      }	
      $student_no =  $date1.$month.'-'.$new;
      }
    else{
    
      $date1= date('Y');
      $month= date('m');
      $date=  $date1.$month.'-001';
      
      $student_no = $date;
    }
?>

<section id="main-container" class="main-container">
  <div class="container" style="margin-top:-30px; ">
    
    <div class="row">
      <div class="col-md-12" style="margin: 0 auto;">
        <?php
          if(!empty($msg)){
            echo $msg;
          }
          if(isset($_GET['msg'])){
            
            echo '<div class="alert" style="background-color:#163020; color:#FFF;" id="flash-msg">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <p><strong>Successfully</strong><br /> register please verifty your account</p>
            </div>';
          }
        ?>
        <p style="line-height:25px; text-align:center;" class="column-title">
          <span style="font-size:30px; font-weight:bold;">IPIL SDA ONLINE REGISTRATION</span><br>
          <span style="font-size:14px; ">SIGN IN TO  YOUR ACCOUNT</span><br>
          <hr style="margin-top:-40px;">
        </p>
        
        <form  method="post" role="form" style="margin-top:-30px;" name="frm">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Student I.D. No. : </label>
                <input class="form-control" name="stud_no" style="width:48.5%;" placeholder="Input Student I.D. No." readonly value="<?php echo $student_no?>" type="text" required autocomplete="off" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Student Firstname : </label>
                <input class="form-control" name="firstname" placeholder="Input Firstname" type="text" required autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Student Lastname : </label>
                <input class="form-control" name="lastname" placeholder="Input Lastname" type="text" required autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Guardian Name : </label>
                <input class="form-control" name="guardian_name" placeholder="Input Guardian Name" type="text" required autocomplete="off" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Guardian Contact No. : </label>
                <input type="number" class="form-control" name="guardian_contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "11" placeholder="Enter Contact No." autocomplete="off" required="required">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label style="font-size:13px; font-weight:bold;"><span style="color:#CF0000;">*</span>Guardian E-mail</label>
                <input class="form-control" name="email" placeholder="Input Guardian E-mail" type="email" required autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
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