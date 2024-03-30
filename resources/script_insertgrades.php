<?php
    require_once'../database/dbconfig.php';
    if(isset($_POST['btn_submit'])){
        $quarter = $_POST['quarter'];


        

        $d_sel = "SELECT ensub_id FROM tbl_enrollsub WHERE sy_id=:sy_id ORDER BY ensub_id ASC";
        $d_sele= $db->prepare($d_sel);
        $d_sele->bindParam(':sy_id',$_SESSION['sy_id']);
        $d_sele->execute();
        while($d_row=$d_sele->fetch()){
            if(empty($_POST['grade'.$d_row['ensub_id']])){}
            else{
                $grade = $_POST['grade'.$d_row['ensub_id']];
                
                
                $o_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                $o_sele= $db->prepare($o_sel);
                $o_sele->bindParam(':ensub_id',$d_row['ensub_id']);
                $o_sele->execute();
                if($o_sele->rowCount()>=1){
                    $o_row = $o_sele->fetch();
                    if($quarter==1){
                        
                        $insert = "UPDATE tbl_grades SET first_quarter=:first_quarter WHERE grades_id=:grades_id";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':first_quarter',$grade);
                        $inserts->bindParam(':grades_id',$o_row['grades_id']);
                        $inserts->execute();
                    }
                    elseif($quarter==2){
                        $insert = "UPDATE tbl_grades SET second_quarter=:second_quarter WHERE grades_id=:grades_id";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':second_quarter',$grade);
                        $inserts->bindParam(':grades_id',$o_row['grades_id']);
                        $inserts->execute();
                    }
                    elseif($quarter==3){
                        $insert = "UPDATE tbl_grades SET third_quarter=:third_quarter WHERE grades_id=:grades_id";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':third_quarter',$grade);
                        $inserts->bindParam(':grades_id',$o_row['grades_id']);
                        $inserts->execute();
                    }
                    else{
                        $insert = "UPDATE tbl_grades SET fourth_quarter=:fourth_quarter WHERE grades_id=:grades_id";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':fourth_quarter',$grade);
                        $inserts->bindParam(':grades_id',$o_row['grades_id']);
                        $inserts->execute();
                    }
                }
                else{
                    if($quarter==1){
                        $blank  = '';
                        $insert = "INSERT INTO tbl_grades(ensub_id,first_quarter,second_quarter,third_quarter,fourth_quarter)VALUES(:ensub_id,:first_quarter,:second_quarter,:third_quarter,:fourth_quarter)";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':ensub_id',$d_row['ensub_id']);
                        $inserts->bindParam(':first_quarter',$grade);
                        $inserts->bindParam(':second_quarter',$blank);
                        $inserts->bindParam(':third_quarter',$blank);
                        $inserts->bindParam(':fourth_quarter',$blank);
                        $inserts->execute();
                    }
                    elseif($quarter==2){
                        $blank  = '';
                        $insert = "INSERT INTO tbl_grades(ensub_id,first_quarter,second_quarter,third_quarter,fourth_quarter)VALUES(:ensub_id,:first_quarter,:second_quarter,:third_quarter,:fourth_quarter)";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':ensub_id',$d_row['ensub_id']);
                        $inserts->bindParam(':first_quarter',$blank);
                        $inserts->bindParam(':second_quarter',$grade);
                        $inserts->bindParam(':third_quarter',$blank);
                        $inserts->bindParam(':fourth_quarter',$blank);
                        $inserts->execute();
                    }
                    elseif($quarter==3){
                        $blank  = '';
                        $insert = "INSERT INTO tbl_grades(ensub_id,first_quarter,second_quarter,third_quarter,fourth_quarter)VALUES(:ensub_id,:first_quarter,:second_quarter,:third_quarter,:fourth_quarter)";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':ensub_id',$d_row['ensub_id']);
                        $inserts->bindParam(':first_quarter',$blank);
                        $inserts->bindParam(':second_quarter',$blank);
                        $inserts->bindParam(':third_quarter',$grade);
                        $inserts->bindParam(':fourth_quarter',$blank);
                        $inserts->execute();
                    }
                    else{
                        $blank  = '';
                        $insert = "INSERT INTO tbl_grades(ensub_id,first_quarter,second_quarter,third_quarter,fourth_quarter)VALUES(:ensub_id,:first_quarter,:second_quarter,:third_quarter,:fourth_quarter)";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':ensub_id',$d_row['ensub_id']);
                        $inserts->bindParam(':first_quarter',$blank);
                        $inserts->bindParam(':second_quarter',$blank);
                        $inserts->bindParam(':third_quarter',$blank);
                        $inserts->bindParam(':fourth_quarter',$grade);
                        $inserts->execute();
                    }
                    
                }

            }
        }
        $_SESSION['message'] = 15;
        header('Location:../production/teach/index.php?page=app_classlists&sched_id='.$_POST['sched_id'].'');
    }
?>