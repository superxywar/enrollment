<?php
    if(isset($_POST['btn_save'])){

		$student_no	= $_POST['student_no'];
		$firstname 	= strtoupper($_POST['firstname']);
        $lastname 	= strtoupper($_POST['lastname']);
        $middlename	= strtoupper($_POST['middlename']);
        
        if(empty($_POST['ext_name'])){
            $ext_name	= '';
        }
        else{
            $ext_name	= strtoupper($_POST['ext_name']);
        }
		if(empty($_POST['middlename'])){
            $middlename	= '';
        }
        else{
            $middlename	= strtoupper($_POST['middlename']);
        }
        $birth_date = $_POST['birth_date'];
		$gender     = strtoupper($_POST['gender']);
        $address    = strtoupper($_POST['address']);
        $religion   = strtoupper($_POST['religion']);
        $tribe      = strtoupper($_POST['tribe']);
        $mothert    = strtoupper($_POST['mother_tongue']);
        $psa        = $_POST['psa'];
        $lrn        = $_POST['lrn'];

		$father_name= strtoupper($_POST['father_name']);
		$mother_name= strtoupper($_POST['mother_name']);	
		$guardian_name		= strtoupper($_POST['guardian_name']);
		$father_contact		= $_POST['father_contact'];
		$mother_contact		= $_POST['mother_contact'];
		$guardian_contact	= $_POST['guardian_contact'];
        $father_email    	= $_POST['father_email'];
        $mother_email   	= $_POST['father_email'];
        $guardian_email 	= $_POST['guardian_email'];
		$guard_stat         = 'Inactive';
		// Generating Password
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        $password = substr(str_shuffle( $chars ), 0, 8 );
        $password1= $password;
		$activation =   md5($email.time());

		$select ="SELECT * FROM tbl_student WHERE firstname=:firstname AND lastname=:lastname";
		$check	=$db->prepare($select);
		$check->bindParam(':firstname',$firstname);
		$check->bindParam(':lastname',$lastname);
		$check->execute();
		if($check->rowCount()>=1){
			echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Student already exist
	              	</div>
              	</div>
            </div>';
		}
	    else{
		$insert ="INSERT INTO tbl_student (stud_no,psa_no,lrn_number,firstname,lastname,middlename,ext_name,birth_date,gender,address,religion,mother_tongue,tribe,father_name,father_email,father_contact,mother_name,mother_email,mother_contact,guardian_name,guardian_email,guardian_contact,guard_stat,password,activation) VALUES (:stud_no,:psa_no,:lrn_number,:firstname,:lastname,:middlename,:ext_name,:birth_date,:gender,:address,:religion,:mother_tongue,:tribe,:father_name,:father_email,:father_contact,:mother_name,:mother_email,:mother_contact,:guardian_name,:guardian_email,:guardian_contact,:guard_stat,:password,:activation)";
		$insert_col=$db->prepare($insert);
		$insert_col->bindParam(':stud_no',$student_no);
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
		$insert_col->bindParam(':guardian_email',$guardian_email);
		$insert_col->bindParam(':guardian_contact',$guardian_contact);
		$insert_col->bindParam(':guard_stat',$guard_stat);
		$insert_col->bindParam(':password',$password1);
		$insert_col->bindParam(':activation',$activation);
		$insert_col->execute();
		
		$subject = 'IPIL DISTRICT ADVENTIST ELEMENTARY SCHOOL INC. SYSTEM MESSAGE';
        $message = 'Good Day!!!, Mr & Mrs. '.$lastname.'';
        $message .="\r\n";
        $message .= 'This will be your credentials to login our website using parents portal. ';
        $message .="\r\n";
        $message .= 'E-mail: '.$guardian_email;
        $message .="\r\n";
        $message .= 'Password: '.$password1;
        $message .="\r\n";
        $message .= 'Please click the link to activate your account : https://ipilsda.com/script_guardianauthenticate.php?activation='.$activation;
                    
        $url = "https://script.google.com/macros/s/AKfycbwXsS6kMWaMbH8jS_GIIzQgjgFXyIN6o5LbJ-UFRuqsyoShIh7kmPwH-Wzw9Vr6OWOuzQ/exec";
        $ch = curl_init($url);
        curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_POSTFIELDS => http_build_query([
            "recipient" => $guardian_email,
            "subject"   => $subject,
            "body"      => $message
        ])
        ]);
        $result = curl_exec($ch);
        
		header('Location:../../resources/script_insertstudaccounts.php');
		
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