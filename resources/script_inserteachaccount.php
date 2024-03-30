<?php
    require_once'../database/dbconfig.php';

    $select = "SELECT * FROM tbl_teacher ORDER BY teach_id DESC";
    $selects= $db->prepare($select);
    $selects->execute();
    $row    = $selects->fetch();
    
    $stud_id= 0;
    $type   = 'teacher';
    $insert = "INSERT INTO tbl_account (teach_id,stud_id,email,password,type)VALUES(:teach_id,:stud_id,:email,:password,:type)";
    $inserts= $db->prepare($insert);
    $inserts->bindParam(':teach_id',$row['teach_id']);
    $inserts->bindParam(':stud_id',$stud_id);
    $inserts->bindParam(':email',$row['email']);
    $inserts->bindParam(':password',$row['password']);
    $inserts->bindParam(':type',$type);
    $inserts->execute();

    $_SESSION['message'] = 23;

    header('Location:../production/admin/index.php?page=app_teacher');
?>