<?php
    require_once'../database/dbconfig.php';
    if(isset($_POST['btn_submit'])){

        $d_sel = "SELECT ensub_id FROM tbl_enrollsub WHERE sched_id=0 AND load_id=0 ORDER BY ensub_id ASC";
        $d_sele= $db->prepare($d_sel);
        $d_sele->execute();
        while($d_row=$d_sele->fetch()){
            
            if(empty($_POST['gradeF'.$d_row['ensub_id']])){}
            elseif(empty($_POST['gradeS'.$d_row['ensub_id']])){}
            elseif(empty($_POST['gradeT'.$d_row['ensub_id']])){}
            else{
                $grade1 = $_POST['gradeF'.$d_row['ensub_id']];
                $grade2 = $_POST['gradeS'.$d_row['ensub_id']];
                $grade3 = $_POST['gradeT'.$d_row['ensub_id']];
                $grade4 = $_POST['gradeFR'.$d_row['ensub_id']];
                
                $o_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                $o_sele= $db->prepare($o_sel);
                $o_sele->bindParam(':ensub_id',$d_row['ensub_id']);
                $o_sele->execute();
                if($o_sele->rowCount()>=1){
                }
                else{
                    
                    $insert = "INSERT INTO tbl_grades(ensub_id,first_quarter,second_quarter,third_quarter,fourth_quarter)VALUES(:ensub_id,:first_quarter,:second_quarter,:third_quarter,:fourth_quarter)";
                    $inserts= $db->prepare($insert);
                    $inserts->bindParam(':ensub_id',$d_row['ensub_id']);
                    $inserts->bindParam(':first_quarter',$grade1);
                    $inserts->bindParam(':second_quarter',$grade2);
                    $inserts->bindParam(':third_quarter',$grade3);
                    $inserts->bindParam(':fourth_quarter',$grade4);
                    $inserts->execute();
                }

            }
        }
        $_SESSION['message'] = 15;
        header('Location:../production/admin/index.php?page=app_creategrades&stud_id='.$_POST['stud_id'].'');
    }
?>