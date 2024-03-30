<?php
    require_once'../database/dbconfig.php';
    if(isset($_POST['btn_submit'])){
        
        $teach_id   = $_POST['teach_id'];
        
        $d_sel = "SELECT sched_id FROM tbl_schedule WHERE sy_id=:sy_id ORDER BY sched_id ASC";
        $d_sele= $db->prepare($d_sel);
        $d_sele->bindParam(':sy_id',$_SESSION['sy_id']);
        $d_sele->execute();
        while($d_row=$d_sele->fetch()){
            
            if(empty($_POST['sched_id'.$d_row['sched_id']])){}
            else{
                
                $sched_id = $_POST['sched_id'.$d_row['sched_id']];
                
                $o_sel = "SELECT * FROM tbl_load WHERE sy_id=:sy_id AND teach_id=:teach_id AND sched_id=:sched_id";
                $o_sele= $db->prepare($o_sel);
                $o_sele->bindParam(':sy_id',$_SESSION['sy_id']);
                $o_sele->bindParam(':teach_id',$teach_id);
                $o_sele->bindParam(':sched_id',$_POST['sched_id']);
                $o_sele->execute();
                if($o_sele->rowCount()>=1){}
                else{
                    
                    $insert = "INSERT INTO tbl_load(sy_id,teach_id,sched_id)VALUES(:sy_id,:teach_id,:sched_id)";
                    $inserts= $db->prepare($insert);
                    $inserts->bindParam(':sy_id',$_SESSION['sy_id']);
                    $inserts->bindParam(':teach_id',$teach_id);
                    $inserts->bindParam(':sched_id',$sched_id);
                    $inserts->execute();
                    
                    $update = "UPDATE tbl_schedule SET teach_id=:teach_id WHERE sched_id=:sched_id";
                    $updates= $db->prepare($update);
                    $updates->bindParam(':teach_id',$teach_id);
                    $updates->bindParam(':sched_id',$sched_id);
                    $updates->execute();
                }

            }
        }
        $_SESSION['message'] = 9;
        header('Location:../production/admin/index.php?page=app_listschedule');
    }
?>