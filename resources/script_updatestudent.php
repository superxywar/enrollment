<?php
    if(isset($_POST['btn_save'])){

		$student_no	= $_POST['student_no'];
		$firstname 	= strtoupper($_POST['firstname']);
        $lastname 	= strtoupper($_POST['lastname']);
        $middlename	= strtoupper($_POST['middlename']);
        
        if(empty($_POST['ext_name'])){
            $ext_name	= '';
        }
        else{
            $ext_name	= strtoupper($_POST['ext_name']);
        }
        if(empty($_POST['middlename'])){
            $middlename	= '';
        }
        else{
            $middlename	= strtoupper($_POST['middlename']);
        }
        $birth_date = $_POST['birth_date'];
		$gender     = strtoupper($_POST['gender']);
        $address    = strtoupper($_POST['address']);
        $religion   = strtoupper($_POST['religion']);
        $tribe      = strtoupper($_POST['tribe']);
        $mothert    = strtoupper($_POST['mother_tongue']);
        $psa        = $_POST['psa'];
        $lrn        = $_POST['lrn'];

		$father_name= strtoupper($_POST['father_name']);
		$mother_name= strtoupper($_POST['mother_name']);	
		$guardian_name		= strtoupper($_POST['guardian_name']);
		$father_contact		= $_POST['father_contact'];
		$mother_contact		= $_POST['mother_contact'];
		$guardian_contact	= $_POST['guardian_contact'];
        $father_email    	= $_POST['father_email'];
        $mother_email   	= $_POST['father_email'];
        $guardian_email 	= $_POST['guardian_email'];
		

		$update = "UPDATE tbl_student SET psa_no=:psa_no, lrn_number=:lrn_number, firstname=:firstname, lastname=:lastname, middlename=:middlename, ext_name=:ext_name, birth_date=:birth_date, gender=:gender, address=:address, religion=:religion, mother_tongue=:mother_tongue, tribe=:tribe, father_name=:father_name, father_email=:father_email, father_contact=:father_contact, mother_name=:mother_name, mother_email=:mother_email, mother_contact=:mother_contact, guardian_name=:guardian_name, guardian_email=:guardian_email, guardian_contact=:guardian_contact WHERE stud_id=:stud_id";
        $updates= $db->prepare($update);
        $updates->bindParam(':psa_no',$psa);
		$updates->bindParam(':lrn_number',$lrn);
        $updates->bindParam(':firstname',$firstname);
        $updates->bindParam(':lastname',$lastname);
        $updates->bindParam(':middlename',$middlename);
        $updates->bindParam(':ext_name',$ext_name);
        $updates->bindParam(':birth_date',$birth_date);
        $updates->bindParam(':gender',$gender);
        $updates->bindParam(':address',$address);
        $updates->bindParam(':religion',$religion);
        $updates->bindParam(':mother_tongue',$mothert);
        $updates->bindParam(':tribe',$tribe);
        $updates->bindParam(':father_name',$father_name);
        $updates->bindParam(':father_email',$father_email);
        $updates->bindParam(':father_contact',$father_contact);
        $updates->bindParam(':mother_name',$mother_name);
        $updates->bindParam(':mother_email',$mother_email);
        $updates->bindParam(':mother_contact',$mother_contact);
        $updates->bindParam(':guardian_name',$guardian_name);
        $updates->bindParam(':guardian_email',$guardian_email);
        $updates->bindParam(':guardian_contact',$guardian_contact);
        $updates->bindParam(':stud_id',$_GET['stud_id']);
        $updates->execute();
        
		$u_update = "UPDATE tbl_account SET email=:email WHERE stud_id=:stud_id";
        $u_updates= $db->prepare($u_update);
        $u_updates->bindParam(':email',$guardian_email);
        $u_updates->bindParam(':stud_id',$_GET['stud_id']);
        $u_updates->execute();

        $_SESSION['message'] = 1;
        header('Location:index.php?page=app_liststudent');
		
	}
    
?>