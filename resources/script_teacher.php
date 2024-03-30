<?php
    if(isset($_POST['btn_save'])){

        $firstname = strtoupper($_POST['firstname']);
        $lastname  = strtoupper($_POST['lastname']);
        $address   = $_POST['address'];
        $email     = $_POST['email'];
        $contact   = $_POST['contact'];
        $gender    = $_POST['gender'];
        $civil     = $_POST['civil'];
        $status    = 'Inactive';
        // Generating Password
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        $password = substr(str_shuffle( $chars ), 0, 8 );
        $password1= $password;
        $activation =   md5($email.time());

        $e_sel = "SELECT * FROM tbl_teacher WHERE firstname=:firstname AND lastname=:lastname";
        $e_sele= $db->prepare($e_sel);
        $e_sele->bindParam(':firstname',$firstname);
        $e_sele->bindParam(':lastname',$lastname);
        $e_sele->execute();

        if($e_sele->rowCount()==1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Teacher already exist
	              	</div>
              	</div>
            </div>';
        }
        else{

            $targetDir = "images/"; 

            $fileName = basename($_FILES["file"]["name"]); 
            $targetFilePath = $targetDir . $fileName; 
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 

            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                    // Insert image file name into database 
                    $insert = "INSERT INTO tbl_teacher(firstname,lastname,address,email,contact_no,gender,civil_status,password,status,activation,photo)VALUES(:firstname,:lastname,:address,:email,:contact_no,:gender,:civil_status,:password,:status,:activation,:photo)";
                    $inserts= $db->prepare($insert);
                    $inserts->bindParam(':firstname',$firstname);
                    $inserts->bindParam(':lastname',$lastname);
                    $inserts->bindParam(':address',$address);
                    $inserts->bindParam(':email',$email);
                    $inserts->bindParam(':contact_no',$contact);
                    $inserts->bindParam(':gender',$gender);
                    $inserts->bindParam(':civil_status',$civil);
                    $inserts->bindParam(':password',$password);
                    $inserts->bindParam(':status',$status);
                    $inserts->bindParam(':activation',$activation);
                    $inserts->bindParam(':photo',$fileName);
                    $inserts->execute();
                    
                    $subject = 'IPIL DISTRICT ADVENTIST ELEMENTARY SCHOOL INC. SYSTEM MESSAGE';
                    $message = 'Hello, Teacher '.$lastname.'';
                    $message .="\r\n";
                    $message .= 'This will be your credentials to login our website using teacher portal. ';
                    $message .="\r\n";
                    $message .= 'E-mail: '.$email;
                    $message .="\r\n";
                    $message .= 'Password: '.$password;
                    $message .="\r\n";
                    $message .= 'Please click the link to activate your account : https://ipilsda.com/script_teacherauthenticate.php?activation='.$activation;
                    
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
                    
                    if($inserts){ 
                        header('Location:../../resources/script_inserteachaccount.php');
                        echo'<div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success alert-dismissible"  style="margin:10px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-check"></i> Success!!! </h4>
                                    Data successfully save.
                                </div>
                            </div>
                        </div>';
                    }else{ 
                        echo'<div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible" style="margin:10px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
                                    File upload failed, please try again.
                                </div>
                            </div>
                        </div>';
                    }  
                }else{ 
                    echo'<div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissible" style="margin:10px;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
                                Sorry, there was an error uploading your file.
                            </div>
                        </div>
                    </div>';
                } 
            }else{ 
                echo'<div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissible" style="margin:10px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
                            Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.
                        </div>
                    </div>
                </div>';
                
            } 
            
        }
    }
?>