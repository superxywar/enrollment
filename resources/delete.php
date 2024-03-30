<?php
	require_once'../database/dbconfig.php';
	
	$id	=	$_GET['confirm'];
	
	switch ($id){

		case 1:
		
		$sy_id = $_GET['sy_id'];

		$t_sel  = "SELECT * FROM tbl_schoolyear WHERE status='Active' ORDER BY sy_id DESC";
		$t_sele = $db->prepare($t_sel);
		$t_sele ->execute();
		if($t_sele->rowCount()>=1){
			$t_row  = $t_sele->fetch();

			$t_update = "UPDATE tbl_schoolyear SET status='Inactive' WHERE sy_id=:sy_id";
			$t_updates= $db->prepare($t_update);
			$t_updates->bindParam(':sy_id',$t_row['sy_id']);
			$t_updates->execute();
		}
		$update = "UPDATE tbl_schoolyear SET status='Active' WHERE sy_id=:sy_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':sy_id',$sy_id);
		$updates->execute();

		$_SESSION['message'] = 2;

		header('Location:../production/admin/index.php?page=app_schoolyear');
		break;

		case 2:

		$sy_id  = $_GET['sy_id'];

		$update = "UPDATE tbl_schoolyear SET status='Inactive' WHERE sy_id=:sy_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':sy_id',$sy_id);
		$updates->execute();

		$_SESSION['message'] = 3;

		header('Location:../production/admin/index.php?page=app_schoolyear');
		break;

		case 3:

		$acad_id  = $_GET['acad_id'];

		$update = "UPDATE tbl_academic SET status='Active' WHERE acad_id=:acad_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':acad_id',$acad_id);
		$updates->execute();

		$_SESSION['message'] = 4;

		header('Location:../production/admin/index.php?page=app_academicprogram');
		break;

		case 4:

		$acad_id  = $_GET['acad_id'];

		$update = "UPDATE tbl_academic SET status='Inactive' WHERE acad_id=:acad_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':acad_id',$acad_id);
		$updates->execute();

		$_SESSION['message'] = 5;

		header('Location:../production/admin/index.php?page=app_academicprogram');
		break;

		case 5:

		$acad_id    = $_GET['acad_id'];
		$acadcon_id = $_GET['acadcon_id'];	
		$update = "DELETE FROM tbl_acadcon WHERE acadcon_id=:acadcon_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':acadcon_id',$acadcon_id);
		$updates->execute();

		$_SESSION['message'] = 6;

		header('Location:../production/admin/index.php?page=app_programsubject&acad_id='.$acadcon_id.'');
		break;

		case 6:

		$acad_id  = $_GET['acad_id'];

		$update = "UPDATE tbl_academic SET stat_prep='Done' WHERE acad_id=:acad_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':acad_id',$acad_id);
		$updates->execute();

		$_SESSION['message'] = 7;

		header('Location:../production/admin/index.php?page=app_academicprogram');
		break;

		case 7:

		$teach_id  = $_GET['teach_id'];

		$update = "UPDATE tbl_teacher SET status='Active' WHERE teach_id=:teach_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':teach_id',$teach_id);
		$updates->execute();

		$_SESSION['message'] = 8;

		header('Location:../production/admin/index.php?page=app_teacher');
		break;

		case 8:

		$teach_id  = $_GET['teach_id'];

		$update = "UPDATE tbl_teacher SET status='Inactive' WHERE teach_id=:teach_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':teach_id',$teach_id);
		$updates->execute();

		$_SESSION['message'] = 8;

		header('Location:../production/admin/index.php?page=app_teacher');
		break;

		case 9:

		$sched_id  = $_GET['sched_id'];

		$update = "DELETE FROM tbl_schedule WHERE sched_id=:sched_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':sched_id',$sched_id);
		$updates->execute();

		$_SESSION['message'] = 10;

		header('Location:../production/admin/index.php?page=app_schedule&grade_id='.$_GET['grade_id'].'&section_id='.$_GET['section_id'].'');
		break;

		case 10:

		$load_id  = $_GET['load_id'];

		$update = "DELETE FROM tbl_load WHERE load_id=:load_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':load_id',$load_id);
		$updates->execute();

		$_SESSION['message'] = 10;

		header('Location:../production/admin/index.php?page=app_listschedule');
		break;

		case 11:

		$slider_id  = $_GET['slider_id'];

		$update = "DELETE FROM tbl_slider WHERE slider_id=:slider_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':slider_id',$slider_id);
		$updates->execute();

		$_SESSION['message'] = 14;

		header('Location:../production/admin/index.php?page=app_slider');
		break;

		case 12:

		$event_id  = $_GET['event_id'];

		$update = "DELETE FROM tbl_event WHERE event_id=:event_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':event_id',$event_id);
		$updates->execute();

		$_SESSION['message'] = 14;

		header('Location:../production/admin/index.php?page=app_event');
		break;

		case 13:

		$sched_id  = $_GET['sched_id'];
		$date      = date('Y-m-d');
		$status    = 'Done';
		$update = "INSERT INTO tbl_gradstat(sched_id,status,date)VALUES(:sched_id,:status,:date)";
		$updates= $db->prepare($update);
		$updates->bindParam(':sched_id',$sched_id);
		$updates->bindParam(':status',$status);
		$updates->bindParam(':date',$date);
		$updates->execute();

		$_SESSION['message'] = 16;

		header('Location:../production/teach/index.php?page=app_classlists&sched_id='.$sched_id.'');
		break;
		
		case 14:

		$enroll_id 	 =	$_GET['enroll_id'];
		$status      = 'Disapproved Application';
		
		$e_sel  = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id ORDER BY enroll_id DESC";
		$e_sele = $db->prepare($e_sel);
		$e_sele->bindParam(':enroll_id',$_GET['enroll_id']);
		$e_sele->execute();
		$e_row = $e_sele->fetch();
		
		$del	 =	"UPDATE tbl_enroll SET stat_enroll=:stat_enroll WHERE enroll_id=:enroll_id";
		$del_user= $db->prepare($del);
		$del_user->bindParam(':stat_enroll',$status);
		$del_user->bindParam(':enroll_id',$enroll_id);
		$del_user->execute();
        
        $ndate		= date('Y-m-d');
		$nstat  	='Closed';
		$nmessage	='Your application has been disapproved.';
		$insert = "INSERT INTO tbl_notif(stud_id,enroll_id,message,status,date)VALUES(:stud_id,:enroll_id,:message,:status,:date)";
		$inserts= $db->prepare($insert);
		$inserts->bindParam(':stud_id',$e_row['stud_id']);
		$inserts->bindParam(':enroll_id',$enroll_id);
		
		$inserts->bindParam(':message',$nmessage);
		$inserts->bindParam(':status',$nstat);
		$inserts->bindParam(':date',$ndate);
		$inserts->execute();
		
		$_SESSION['message'] = 21;

		header('Location:../production/admin/index.php?page=app_listpenenrollment');
		break;

		case 15:

		$enroll_id 	 =	$_GET['enroll_id'];

		$e_sel  = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id ORDER BY enroll_id DESC";
		$e_sele = $db->prepare($e_sel);
		$e_sele->bindParam(':enroll_id',$_GET['enroll_id']);
		$e_sele->execute();
		$e_row = $e_sele->fetch();
		


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

		$update = "UPDATE tbl_enroll SET stat_enroll='Pre-Enroll' WHERE enroll_id=:enroll_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':enroll_id',$_GET['enroll_id']);
		$updates->execute();

		$date  = date('Y-m-d');


		$f_sel = "SELECT * FROM tbl_fee WHERE grade_id=:grade_id ORDER BY fee_id DESC";
		$f_sele= $db->prepare($f_sel);
		$f_sele->bindParam(':grade_id',$e_row['grade_id']);
		$f_sele->execute();
		while($f_row=$f_sele->fetch()){

			$f_insert = "INSERT INTO tbl_studentpayment(sy_id,stud_id,fee_id,amount,date)VALUES(:sy_id,:stud_id,:fee_id,:amount,:date)";
			$f_inserts= $db->prepare($f_insert);
			$f_inserts->bindParam(':sy_id',$_SESSION['sy_id']);
			$f_inserts->bindParam(':stud_id',$e_row['stud_id']);
			$f_inserts->bindParam(':fee_id',$f_row['fee_id']);
			$f_inserts->bindParam(':amount',$f_row['amount']);
			$f_inserts->bindParam(':date',$date);
			$f_inserts->execute();
			
		}
        
        $ndate		= date('Y-m-d');
		$nstat  	='Closed';
		$nmessage	='Your application has been approved. Please go to the school and and pay the obligation. Thank you.';
		$insert = "INSERT INTO tbl_notif(stud_id,enroll_id,message,status,date)VALUES(:stud_id,:enroll_id,:message,:status,:date)";
		$inserts= $db->prepare($insert);
		$inserts->bindParam(':stud_id',$e_row['stud_id']);
		$inserts->bindParam(':enroll_id',$enroll_id);
		
		$inserts->bindParam(':message',$nmessage);
		$inserts->bindParam(':status',$nstat);
		$inserts->bindParam(':date',$ndate);
		$inserts->execute();
		
		$_SESSION['message'] = 22;

		header('Location:../production/admin/index.php?page=app_listpenenrollment');
		break;
		
		case 16:

		$teachedu_id  = $_GET['teachedu_id'];

		$update = "DELETE FROM tbl_teacheduc WHERE teachedu_id=:teachedu_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':teachedu_id',$teachedu_id);
		$updates->execute();

		$_SESSION['message'] = 14;

		header('Location:../production/admin/index.php?page=app_teachereduc&teach_id='.$_GET['teach_id'].'');
		break;
		
		case 17:

		$paycon_id  = $_GET['paycon_id'];

		$update = "DELETE FROM tbl_studentpaycon WHERE paycon_id=:paycon_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':paycon_id',$paycon_id);
		$updates->execute();

		$_SESSION['message'] = 14;

		header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$_GET['sy_id'].'&stud_id='.$_GET['stud_id'].'');
		break;
		
		case 18:

		$teacheli_id  = $_GET['teacheli_id'];

		$update = "DELETE FROM tbl_teacheli WHERE teacheli_id=:teacheli_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':teacheli_id',$teacheli_id);
		$updates->execute();

		$_SESSION['message'] = 14;

		header('Location:../production/admin/index.php?page=app_teachereduc&teach_id='.$_GET['teach_id'].'');
		break;
		
		case 19:

		$official_id = $_GET['official_id'];	
		$update = "DELETE FROM tbl_official WHERE official_id=:official_id";
		$updates= $db->prepare($update);
		$updates->bindParam(':official_id',$official_id);
		$updates->execute();

		//$_SESSION['message'] = 6;

		header('Location:../production/admin/index.php?page=app_official');
		break;
	}
?>



