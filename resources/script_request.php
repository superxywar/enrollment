<?php
    require_once'../database/dbconfig.php';

    if(isset($_POST['btn_submit'])){

        $sy_id      = $_POST['sy_id'];
        $acad_id    = $_POST['acad_id'];
        $stud_id    = $_POST['stud_id'];

        $grade_id   = $_POST['grade_id'];
        $state      = $_POST['state'];
        $status     = 'Regular';
        $stat_enroll= 'Pending Application';
        $date       = date('Y-m-d');
        $section_id = $_POST['state'];
        
        $select = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stud_id=:stud_id";
        $selects= $db->prepare($select);
        $selects->bindParam(':sy_id',$sy_id);
        $selects->bindParam(':stud_id',$stud_id);
        $selects->execute();
        if($selects->rowCount()>=1){

            $_SESSION['message'] = 19;
            header('Location:../production/parent/index.php?page=app_listapplication');
        }
        else{

            $insert = "INSERT INTO tbl_enroll(sy_id,stud_id,acad_id,grade_id,section_id,status,stat_enroll,date)VALUES(:sy_id,:stud_id,:acad_id,:grade_id,:section_id,:status,:stat_enroll,:date)";
            $inserts= $db->prepare($insert);
            $inserts->bindParam(':sy_id',$sy_id);
            $inserts->bindParam(':stud_id',$stud_id);
            $inserts->bindParam(':acad_id',$acad_id);
            $inserts->bindParam(':grade_id',$grade_id);
            $inserts->bindParam(':section_id',$section_id);
            $inserts->bindParam(':status',$status);
            $inserts->bindParam(':stat_enroll',$stat_enroll);
            $inserts->bindParam(':date',$date);
            $inserts->execute();

            $_SESSION['message'] = 20;
            header('Location:../production/parent/index.php?page=app_listapplication');
        }
    }
?>