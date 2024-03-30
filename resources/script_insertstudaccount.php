<?php
    require_once'../database/dbconfig.php';

    $select = "SELECT * FROM tbl_student ORDER BY stud_id DESC";
    $selects= $db->prepare($select);
    $selects->execute();
    $row    = $selects->fetch();
    
    $teach_id = 0;
    $type     = 'Student';
    $insert = "INSERT INTO tbl_account (teach_id,stud_id,email,password,type)VALUES(:teach_id,:stud_id,:email,:password,:type)";
    $inserts= $db->prepare($insert);
    $inserts->bindParam(':teach_id',$teach_id);
    $inserts->bindParam(':stud_id',$row['stud_id']);
    $inserts->bindParam(':email',$row['guardian_email']);
    $inserts->bindParam(':password',$row['password']);
    $inserts->bindParam(':type',$type);
    $inserts->execute();

    $_SESSION['message'] = 23;

    header('Location:../index.php?page=app_register&msg=1');
?>