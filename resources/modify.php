<?php
	
	require_once'../database/dbconfig.php';

	$query_cald = "SELECT * FROM tbl_useraccount ORDER BY user_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_user'.$row_cald['user_id']])){
		$firstname				=	$_POST['firstname'];
		$lastname				=	$_POST['lastname'];
		$email					=	$_POST['email'];
		$contact_no				=	$_POST['contact'];
		$username				=	'';
		$password				=	$_POST['password'];
		$user_id				=	$_POST['userID'];

			$update_usera=	"UPDATE tbl_useraccount SET firstname=:firstname, lastname=:lastname, email=:email, contact_no=:contact_no, username=:username, password=:password WHERE user_id=:user_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':firstname',$firstname);
			$update_userss->bindParam(':lastname',$lastname);
			$update_userss->bindParam(':email',$email);
			$update_userss->bindParam(':contact_no',$contact_no);
			$update_userss->bindParam(':username',$username);
					
			$update_userss->bindParam(':password',$password);
			$update_userss->bindParam(':user_id',$user_id);
			$update_userss->execute();

			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_user');
		}
	}
	
	$query_cald = "SELECT * FROM tbl_section ORDER BY section_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_section'.$row_cald['section_id']])){
		$grade_id				=	$_POST['grade_id'];
		$section				=	strtoupper($_POST['section']);
		$section_id				=	$_POST['sectionID'];

			$update_usera=	"UPDATE tbl_section SET grade_id=:grade_id, section=:section WHERE section_id=:section_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':grade_id',$grade_id);
			$update_userss->bindParam(':section',$section);
			$update_userss->bindParam(':section_id',$section_id);
			$update_userss->execute();

			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_section');
		}
	}

	$query_cald = "SELECT * FROM tbl_fee ORDER BY fee_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_fee'.$row_cald['fee_id']])){
		$grade_id			=	$_POST['grade_id'];
		$fee				=	strtoupper($_POST['fee']);
		$amount				=	$_POST['amount'];
		$fee_id				=	$_POST['feeID'];

			$update_usera=	"UPDATE tbl_fee SET grade_id=:grade_id, fee=:fee, amount=:amount WHERE fee_id=:fee_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':grade_id',$grade_id);
			$update_userss->bindParam(':fee',$fee);
			$update_userss->bindParam(':amount',$amount);
			$update_userss->bindParam(':fee_id',$fee_id);
			$update_userss->execute();

			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_fee');
		}
	}
    $query_cald = "SELECT * FROM tbl_official ORDER BY official_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_official'.$row_cald['official_id']])){
		$firstname				=	$_POST['firstname'];
		$lastname				=	$_POST['lastname'];
		$address				=	$_POST['address'];
		$email					=	$_POST['email'];
		$contact_no				=	$_POST['contact'];
		$position					=	$_POST['position'];
		$gender  				=	$_POST['gender'];
		$official_id			=	$_POST['officialID'];

			$update_usera=	"UPDATE tbl_official SET firstname=:firstname, lastname=:lastname, address=:address, email=:email, contact_no=:contact_no, gender=:gender, position=:position WHERE official_id=:official_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':firstname',$firstname);
			$update_userss->bindParam(':lastname',$lastname);
			$update_userss->bindParam(':address',$address);
			$update_userss->bindParam(':email',$email);
			$update_userss->bindParam(':contact_no',$contact_no);
			$update_userss->bindParam(':gender',$gender);
			$update_userss->bindParam(':position',$position);	
			$update_userss->bindParam(':official_id',$official_id);
			$update_userss->execute();

			

			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_official');
		}
	}
	$query_cald = "SELECT * FROM tbl_subject ORDER BY sub_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_subject'.$row_cald['sub_id']])){
		$subject				=	strtoupper($_POST['subject']);
		$sub_id  				=	$_POST['subID'];

			$update_usera=	"UPDATE tbl_subject SET subject=:subject WHERE sub_id=:sub_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':subject',$subject);
			$update_userss->bindParam(':sub_id',$sub_id);
			$update_userss->execute();

			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_subject');
		}
	}

	$query_cald = "SELECT * FROM tbl_academic ORDER BY acad_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_acad'.$row_cald['acad_id']])){
		$name				=	strtoupper($_POST['name']);
		$acad_id			=	$_POST['acadID'];

			$update_usera=	"UPDATE tbl_academic SET program_name=:program_name WHERE acad_id=:acad_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':program_name',$name);
			$update_userss->bindParam(':acad_id',$acad_id);
			$update_userss->execute();

			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_academicprogram');
		}
	}

	$query_cald = "SELECT * FROM tbl_room ORDER BY room_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_room'.$row_cald['room_id']])){
		$room					=	strtoupper($_POST['room']);
		$room_id  				=	$_POST['roomID'];

			$update_usera=	"UPDATE tbl_room SET room=:room WHERE room_id=:room_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':room',$room);
			$update_userss->bindParam(':room_id',$room_id);
			$update_userss->execute();

			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_room');
		}
	}

	$query_cald = "SELECT * FROM tbl_teacher ORDER BY teach_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_teach'.$row_cald['teach_id']])){
		$firstname				=	$_POST['firstname'];
		$lastname				=	$_POST['lastname'];
		$address				=	$_POST['address'];
		$email					=	$_POST['email'];
		$contact_no				=	$_POST['contact'];
		$civil					=	$_POST['civil'];
		$gender  				=	$_POST['gender'];
		$teach_id				=	$_POST['teachID'];

			$update_usera=	"UPDATE tbl_teacher SET firstname=:firstname, lastname=:lastname, address=:address, email=:email, contact_no=:contact_no, gender=:gender, civil_status=:civil_status WHERE teach_id=:teach_id";
			$update_userss= $db->prepare($update_usera);
			$update_userss->bindParam(':firstname',$firstname);
			$update_userss->bindParam(':lastname',$lastname);
			$update_userss->bindParam(':address',$address);
			$update_userss->bindParam(':email',$email);
			$update_userss->bindParam(':contact_no',$contact_no);
			$update_userss->bindParam(':gender',$gender);
			$update_userss->bindParam(':civil_status',$civil);	
			$update_userss->bindParam(':teach_id',$teach_id);
			$update_userss->execute();
            
            $u_update = "UPDATE tbl_account SET email=:email WHERE teach_id=:teach_id";
			$u_updates= $db->prepare($u_update);
			$u_updates->bindParam(':email',$email);
			$u_updates->bindParam(':teach_id',$teach_id);
			$u_updates->execute();
			
			$_SESSION ['message'] = 1;
			header('Location:../production/admin/index.php?page=app_teacher');
		}
	}
	
	$query_cald = "SELECT * FROM tbl_teacher ORDER BY teach_id DESC";
	$query_calds= $db->prepare($query_cald);
	$query_calds->execute();
	while($row_cald = $query_calds->fetch()){
		if(isset($_POST['modify_pic'.$row_cald['teach_id']])){
		
		$teach_id				=	$_POST['teachID'];

		$targetDir = "../production/admin/images/"; 

		$fileName = basename($_FILES["file"]["name"]); 
		$targetFilePath = $targetDir . $fileName; 
		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 

			// Allow certain file formats 
			$allowTypes = array('jpg','png','jpeg','gif'); 
			if(in_array($fileType, $allowTypes)){ 
				// Upload file to server 
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
					$update_usera=	"UPDATE tbl_teacher SET photo=:photo WHERE teach_id=:teach_id";
					$update_userss= $db->prepare($update_usera);
					$update_userss->bindParam(':photo',$fileName);
					$update_userss->bindParam(':teach_id',$teach_id);
					$update_userss->execute();

					$_SESSION ['message'] = 1;
					header('Location:../production/teach/index.php?page=app_teacherprofile');
				}
			}
		}
	}
?>