<?php
    require_once'../database/dbconfig.php';

    $e_sel  = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stud_id=:stud_id ORDER BY enroll_id DESC";
    $e_sele = $db->prepare($e_sel);
    $e_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $e_sele->bindParam(':stud_id',$_GET['stud_id']);
    $e_sele->execute();
    while($e_row = $e_sele->fetch()){
        
        if($e_row['section_id']==0){
            $sched_id = 0;
            $load_id  = 0;

            $a_sel = "SELECT * FROM tbl_acadcon WHERE acad_id=:acad_id AND grade_id=:grade_id";
            $a_sele= $db->prepare($a_sel);
            $a_sele->bindParam(':acad_id',$e_row['acad_id']);
            $a_sele->bindParam(':grade_id',$e_row['grade_id']);
            $a_sele->execute();
            while($a_row = $a_sele->fetch()){
                
                $insert = "INSERT INTO tbl_enrollsub(enroll_id,sy_id,acad_id,grade_id,sub_id,sched_id,load_id)VALUES(:enroll_id,:sy_id,:acad_id,:grade_id,:sub_id,:sched_id,:load_id)";
                $inserts= $db->prepare($insert);
                $inserts->bindParam(':enroll_id',$e_row['enroll_id']);
                $inserts->bindParam('sy_id',$_SESSION['sy_id']);
                $inserts->bindParam(':acad_id',$e_row['acad_id']);
                $inserts->bindParam(':grade_id',$e_row['grade_id']);
                $inserts->bindParam(':sub_id',$a_row['sub_id']);
                $inserts->bindParam(':sched_id',$sched_id);
                $inserts->bindParam(':load_id',$load_id);
                $inserts->execute(); 
            }

            
        

        }
        else{
            $select = "SELECT * FROM tbl_schedule WHERE sy_id=:sy_id AND acad_id=:acad_id AND grade_id=:grade_id AND section_id=:section_id";
            $selects= $db->prepare($select);
            $selects->bindParam(':sy_id',$_SESSION['sy_id']);
            $selects->bindParam(':acad_id',$e_row['acad_id']);
            $selects->bindParam(':grade_id',$e_row['grade_id']);
            $selects->bindParam(':section_id',$e_row['section_id']);
            $selects->execute();

            while($sel_row= $selects->fetch()){
                
                

                $t_sel = "SELECT * FROM tbl_load WHERE sched_id=:sched_id";
                $t_sele= $db->prepare($t_sel);
                $t_sele->bindParam(':sched_id',$sel_row['sched_id']);
                $t_sele->execute();
                $t_row = $t_sele->fetch();

                $insert = "INSERT INTO tbl_enrollsub(enroll_id,sy_id,acad_id,grade_id,sub_id,sched_id,load_id)VALUES(:enroll_id,:sy_id,:acad_id,:grade_id,:sub_id,:sched_id,:load_id)";
                $inserts= $db->prepare($insert);
                $inserts->bindParam(':enroll_id',$e_row['enroll_id']);
                $inserts->bindParam('sy_id',$_SESSION['sy_id']);
                $inserts->bindParam(':acad_id',$e_row['acad_id']);
                $inserts->bindParam(':grade_id',$e_row['grade_id']);
                $inserts->bindParam(':sub_id',$sel_row['sub_id']);
                $inserts->bindParam(':sched_id',$sel_row['sched_id']);
                $inserts->bindParam(':load_id',$t_row['load_id']);
                $inserts->execute();
            }
        }
        
    }
    


    

    $date  = date('Y-m-d');

    $ee_sel  = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stud_id=:stud_id ORDER BY grade_id DESC";
    $ee_sele = $db->prepare($e_sel);
    $ee_sele->bindParam(':sy_id',$_SESSION['sy_id']);
    $ee_sele->bindParam(':stud_id',$_GET['stud_id']);
    $ee_sele->execute();
    $ee_row = $ee_sele->fetch();

    

    $f_sel = "SELECT * FROM tbl_fee WHERE grade_id=:grade_id ORDER BY fee_id DESC";
    $f_sele= $db->prepare($f_sel);
    $f_sele->bindParam(':grade_id',$ee_row['grade_id']);
    $f_sele->execute();
    while($f_row=$f_sele->fetch()){

        $f_insert = "INSERT INTO tbl_studentpayment(sy_id,stud_id,fee_id,amount,date)VALUES(:sy_id,:stud_id,:fee_id,:amount,:date)";
        $f_inserts= $db->prepare($f_insert);
        $f_inserts->bindParam(':sy_id',$_SESSION['sy_id']);
        $f_inserts->bindParam(':stud_id',$ee_row['stud_id']);
        $f_inserts->bindParam(':fee_id',$f_row['fee_id']);
        $f_inserts->bindParam(':amount',$f_row['amount']);
        $f_inserts->bindParam(':date',$date);
        $f_inserts->execute();
        
    }
    

    $_SESSION['message'] = 18;
    header('Location:../production/admin/index.php?page=app_creategrades&stud_id='.$_GET['stud_id'].'');
?>