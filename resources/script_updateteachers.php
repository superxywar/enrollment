<?php
    require_once'../database/dbconfig.php';
    if(isset($_POST['btn_save'])){

        $firstname = strtoupper($_POST['firstname']);
        $lastname  = strtoupper($_POST['lastname']);
        $address   = $_POST['address'];
        $email     = $_POST['email'];
        $contact   = $_POST['contact'];
        $gender    = $_POST['gender'];
        $civil     = $_POST['civil'];
        $password  = $_POST['password'];
        $teach_id  = $_POST['teach_id'];


        $insert = " UPDATE tbl_teacher SET firstname=:firstname, lastname=:lastname, address=:address, email=:email, contact_no=:contact_no, gender=:gender, civil_status=:civil_status, password=:password WHERE teach_id=:teach_id";
        $inserts= $db->prepare($insert);
        $inserts->bindParam(':firstname',$firstname);
        $inserts->bindParam(':lastname',$lastname);
        $inserts->bindParam(':address',$address);
        $inserts->bindParam(':email',$email);
        $inserts->bindParam(':contact_no',$contact);
        $inserts->bindParam(':gender',$gender);
        $inserts->bindParam(':civil_status',$civil);
        $inserts->bindParam(':password',$password);
        $inserts->bindParam(':teach_id',$teach_id);
        $inserts->execute();
        
        $u_update = "UPDATE tbl_account SET email=:email, password=:password WHERE teach_id=:teach_id";
        $u_updates= $db->prepare($u_update);
        $u_updates->bindParam(':email',$email);
        $u_updates->bindParam(':password',$password);
        $u_updates->bindParam(':teach_id',$teach_id);
        $u_updates->execute();

        $_SESSION['message'] = 1;
        header('Location:../production/teach/index.php?page=app_teacherprofile');
    }
?>