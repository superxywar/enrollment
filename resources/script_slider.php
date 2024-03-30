<?php
    if(isset($_POST['btn_save'])){

        $title     = $_POST['title'];
        $description  = $_POST['description'];
        $date      = date('Y-m-d');
        $e_sel = "SELECT * FROM tbl_slider WHERE title=:title";
        $e_sele= $db->prepare($e_sel);
        $e_sele->bindParam(':title',$title);
        $e_sele->execute();

        if($e_sele->rowCount()==1){
            echo'
			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-danger alert-dismissible" style="margin:10px;">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-ban"></i> Alert!!!</h4>
		                Slider already exist
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
                    $insert = "INSERT INTO tbl_slider(title,description,photo,date)VALUES(:title,:description,:photo,:date)";
                    $inserts= $db->prepare($insert);
                    $inserts->bindParam(':title',$title);
                    $inserts->bindParam(':description',$description);
                    $inserts->bindParam(':photo',$fileName);
                    $inserts->bindParam(':date',$date);
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