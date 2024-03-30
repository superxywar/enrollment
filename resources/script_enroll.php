<?php
    if(isset($_POST['btn_submit'])){

        $sy_id      = $_SESSION['sy_id'];
        $stud_id    = $_POST['stud_id'];
        $acad_id    = $_POST['acad_id'];
        $grade_id   = $_POST['grade_id'];
        $section_id = $_POST['state'];
        $status_en  = 'Pre-Enroll';
        if(empty($_POST['status'])){
            $status	= 'Regular';
        }
        else{
            $status	= $_POST['status'];
        }
        $date       = date('Y-m-d');
        $script     = $_POST['script'];


        if($script==1){
            $i = 0;
            if($status=='New Student'&&$grade_id==1){
                $i = 0;
            }
            else{
                
                $i++;
            }
            if($status=='New Student'){
                if($i>=1){
                    $_SESSION['message'] = 17;
                    
                // header('Location:index.php?page=app_enroll&stud_id='.$stud_id.'');
                }
                else{
                    $e_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stud_id=:stud_id";
                    $e_sele= $db->prepare($e_sel);
                    $e_sele->bindParam(':sy_id',$_SESSION['sy_id']);
                    $e_sele->bindParam(':stud_id',$stud_id);
                    $e_sele->execute();

                    if($e_sele->rowCount()==1){
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
                        // Insert image file name into database 
                        $insert = "INSERT INTO tbl_enroll(sy_id,stud_id,acad_id,grade_id,section_id,status,stat_enroll,date)VALUES(:sy_id,:stud_id,:acad_id,:grade_id,:section_id,:status,:stat_enroll,:date)";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':sy_id',$_SESSION['sy_id']);
                        $inserts->bindParam(':stud_id',$stud_id);
                        $inserts->bindParam(':acad_id',$acad_id);
                        $inserts->bindParam(':grade_id',$grade_id);
                        $inserts->bindParam(':section_id',$section_id);
                        $inserts->bindParam(':status',$status);
                        $inserts->bindParam(':stat_enroll',$status_en);
                        $inserts->bindParam(':date',$date);
                        $inserts->execute();
                        
                        
                        header('Location:../../resources/script_enrollsub.php?stud_id='.$stud_id.'');
                    }
                }
            }
            else{
                if($grade_id==1){
                    $e_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stud_id=:stud_id";
                    $e_sele= $db->prepare($e_sel);
                    $e_sele->bindParam(':sy_id',$_SESSION['sy_id']);
                    $e_sele->bindParam(':stud_id',$stud_id);
                    $e_sele->execute();

                    if($e_sele->rowCount()==1){
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
                        // Insert image file name into database 
                        $insert = "INSERT INTO tbl_enroll(sy_id,stud_id,acad_id,grade_id,section_id,status,stat_enroll,date)VALUES(:sy_id,:stud_id,:acad_id,:grade_id,:section_id,:status,:stat_enroll,:date)";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':sy_id',$_SESSION['sy_id']);
                        $inserts->bindParam(':stud_id',$stud_id);
                        $inserts->bindParam(':acad_id',$acad_id);
                        $inserts->bindParam(':grade_id',$grade_id);
                        $inserts->bindParam(':section_id',$section_id);
                        $inserts->bindParam(':status',$status);
                        $inserts->bindParam(':stat_enroll',$status_en);
                        $inserts->bindParam(':date',$date);
                        $inserts->execute();
                        
                        
                        header('Location:../../resources/script_enrollsub.php?stud_id='.$stud_id.'');
                    }
                }
                else{
                    for($i=1;$i<=$grade_id;$i++){
                        if($i==$grade_id){

                            // Insert image file name into database 
                            $insert = "INSERT INTO tbl_enroll(sy_id,stud_id,acad_id,grade_id,section_id,status,stat_enroll,date)VALUES(:sy_id,:stud_id,:acad_id,:grade_id,:section_id,:status,:stat_enroll,:date)";
                            $inserts= $db->prepare($insert);
                            $inserts->bindParam(':sy_id',$_SESSION['sy_id']);
                            $inserts->bindParam(':stud_id',$stud_id);
                            $inserts->bindParam(':acad_id',$acad_id);
                            $inserts->bindParam(':grade_id',$i);
                            $inserts->bindParam(':section_id',$section_id);
                            $inserts->bindParam(':status',$status);
                            $inserts->bindParam(':stat_enroll',$status_en);
                            $inserts->bindParam(':date',$date);
                            $inserts->execute();
                        }
                        else{
                            $sections = 0;
                            // Insert image file name into database 
                            $insert = "INSERT INTO tbl_enroll(sy_id,stud_id,acad_id,grade_id,section_id,status,stat_enroll,date)VALUES(:sy_id,:stud_id,:acad_id,:grade_id,:section_id,:status,:stat_enroll,:date)";
                            $inserts= $db->prepare($insert);
                            $inserts->bindParam(':sy_id',$_SESSION['sy_id']);
                            $inserts->bindParam(':stud_id',$stud_id);
                            $inserts->bindParam(':acad_id',$acad_id);
                            $inserts->bindParam(':grade_id',$i);
                            $inserts->bindParam(':section_id',$sections);
                            $inserts->bindParam(':status',$status);
                            $inserts->bindParam(':stat_enroll',$status_en);
                            $inserts->bindParam(':date',$date);
                            $inserts->execute();
                        }
                        header('Location:../../resources/script_enrollsubs.php?stud_id='.$stud_id.'');
                    }
                }
                
            }
        }
        else{
            // Insert image file name into database 
            $insert = "INSERT INTO tbl_enroll(sy_id,stud_id,acad_id,grade_id,section_id,status,stat_enroll,date)VALUES(:sy_id,:stud_id,:acad_id,:grade_id,:section_id,:status,:stat_enroll,:date)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':sy_id',$_SESSION['sy_id']);
            $inserts->bindParam(':stud_id',$stud_id);
            $inserts->bindParam(':acad_id',$acad_id);
            $inserts->bindParam(':grade_id',$grade_id);
            $inserts->bindParam(':section_id',$section_id);
            $inserts->bindParam(':status',$status);
            $inserts->bindParam(':stat_enroll',$status_en);
            $inserts->bindParam(':date',$date);
            $inserts->execute();
            
            
            header('Location:../../resources/script_enrollsub.php?stud_id='.$stud_id.'');
        }
    }
?>