<?php
    require_once'database/dbconfig.php';

    $email    = $_GET['activation'];

    $update = "UPDATE tbl_teacher SET status='Active' WHERE activation=:activation";
    $updates= $db->prepare($update);
    $updates->bindParam(':activation',$_GET['activation']);
    $updates->execute();


    header('Location:index.php?page=app_login');
?>