<?php
    if(isset($_POST['btn_save'])){

        $firstname = strtoupper($_POST['firstname']);
        $lastname  = strtoupper($_POST['lastname']);
        $email     = $_POST['email'];
        $contact   = $_POST['contact'];
        $username  = '';
        $password  = $_POST['password'];
        $user_type = $_POST['user_type'];

        $e_sel = "SELECT * FROM tbl_useraccount WHERE firstname=:firstname AND lastname=:lastname";
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
		                User already exist
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
                    $insert = "INSERT INTO tbl_useraccount(firstname,lastname,email,contact_no,username,password,user_type,photo)VALUES(:firstname,:lastname,:email,:contact_no,:username,:password,:user_type,:photo)";
                    $inserts= $db->prepare($insert);
                    $inserts->bindParam(':firstname',$firstname);
                    $inserts->bindParam(':lastname',$lastname);
                    $inserts->bindParam(':email',$email);
                    $inserts->bindParam(':contact_no',$contact);
                    $inserts->bindParam(':username',$username);
                    $inserts->bindParam(':password',$password);
                    $inserts->bindParam(':user_type',$user_type);
                    $inserts->bindParam(':photo',$fileName);
                    $inserts->execute();
                    if($inserts){ 
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