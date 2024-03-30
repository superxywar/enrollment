<?php
    require_once'../database/dbconfig.php';

    if(isset($_POST['btn_submit'])){

        $sy_id   = $_POST['sy_id'];
        $stud_id = $_POST['stud_id'];
        $or_num  = $_POST['ornumber'];
        //$amount  = $_POST['amount'];
        $date    = date('Y-m-d');
        $time    = date('h:i A');
        $name    = $_POST['name'];
        //$desc    = $_POST['particular'];
        $bal     = $_POST['bal'];
        $cash    = $_POST['cash'];

        if(empty($_POST['ornumber'])){
            $_SESSION['message'] = 26;
            header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.'');
        }
        else{
            if(empty($_POST['name'])){
                $_SESSION['message'] = 26;
                header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.'');      
            }
            else{
                if($cash>=$bal){

                    $insert  = "INSERT INTO tbl_studentpay(sy_id,stud_id,or_no,payee_name,amount,cash,date,time)VALUES(:sy_id,:stud_id,:or_no,:payee_name,:amount,:cash,:date,:time)";
                    $inserts = $db->prepare($insert);
                    $inserts ->bindParam(':sy_id',$sy_id);
                    $inserts ->bindParam(':stud_id',$stud_id);
                    $inserts ->bindParam(':or_no',$or_num);
                    $inserts ->bindParam(':payee_name',$name);
                    $inserts ->bindParam(':amount',$bal);
                    $inserts ->bindParam(':cash',$cash);
                    $inserts ->bindParam(':date',$date);
                    $inserts ->bindParam(':time',$time);
                    $inserts ->execute();

                    $t_sel = "SELECT * FROM tbl_enroll WHERE sy_id=:sy_id AND stud_id=:stud_id AND section_id!=0 AND stat_enroll='Pre-Enroll'";
                    $t_sele= $db->prepare($t_sel);
                    $t_sele->bindParam(':sy_id',$sy_id);
                    $t_sele->bindParam(':stud_id',$stud_id);
                    $t_sele->execute();
                    if($t_sele->rowCount()>=1){
                        $t_row = $t_sele->fetch();

                        $update = "UPDATE tbl_enroll SET stat_enroll='Enrolled' WHERE enroll_id=:enroll_id";
                        $updates= $db->prepare($update);
                        $updates->bindParam(':enroll_id',$t_row['enroll_id']);
                        $updates->execute();
                    }
                    

                    $cel_update = "UPDATE tbl_studentpaycon SET or_no=:or_no, date=:date, time=:time WHERE sy_id=:sy_id AND stud_id=:stud_id AND or_no=''";
                    $cel_updates= $db->prepare($cel_update);
                    $cel_updates->bindParam(':or_no',$or_num);
                    $cel_updates->bindParam(':date',$date);
                    $cel_updates->bindParam(':time',$time);
                    $cel_updates->bindParam(':sy_id',$sy_id);
                    $cel_updates->bindParam(':stud_id',$stud_id);
                    $cel_updates->execute();
                    $_SESSION['message'] = 13;
                    header('Location:../production/admin/receipt.php?page=receipt_content&sy_id='.$sy_id.'&stud_id='.$stud_id.'&orno='.$or_num.'&bal='.$bal.'&cash='.$cash.'');
                }
                else{
                    $_SESSION['message'] = 24;
                    header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.'');
                }
            }
        }
    }

    if(isset($_POST['btn_update'])){
        $sy_id   = $_POST['sy_id'];
        $stud_id = $_POST['stud_id'];
        $i       = 0;
        
        $gel_querys = "SELECT * FROM tbl_fee ORDER BY fee_id DESC";
        $gel_selects= $db->prepare($gel_querys);
        $gel_selects->execute();
        while($gel_rows=$gel_selects->fetch()){
            if(empty($_POST['fee_id'.$gel_rows['fee_id']])){}
            else{
                $amount  = $_POST['fee_id'.$gel_rows['fee_id']];
                $balance = $_POST['bal'.$gel_rows['fee_id']];
                
                if($amount>$balance){
                    $i++;
                }
            }
        }

        if($i==0){
            $gel_query = "SELECT * FROM tbl_fee ORDER BY fee_id DESC";
            $gel_select= $db->prepare($gel_query);
            $gel_select->execute();
            while($gel_row=$gel_select->fetch()){
                if(empty($_POST['fee_id'.$gel_row['fee_id']])){}
                else{
                    $amount  = $_POST['fee_id'.$gel_row['fee_id']];
                    $balance = $_POST['bal'.$gel_row['fee_id']];
                    $fee_id  = $gel_row['fee_id'];

                    $rel_query = "SELECT * FROM tbl_studentpaycon WHERE sy_id=:sy_id AND stud_id=:stud_id AND fee_id=:fee_id AND or_no=''";
                    $rel_select= $db->prepare($rel_query);
                    $rel_select->bindParam(':sy_id',$_POST['sy_id']);
                    $rel_select->bindParam(':stud_id',$_POST['stud_id']);
                    $rel_select->bindParam(':fee_id',$fee_id);
                    $rel_select->execute();
                    if($rel_select->rowCount()>=1){
                        $row_select = $rel_select->fetch();
                        $update = "UPDATE tbl_studentpaycon SET amount=:amount WHERE paycon_id=:paycon_id AND fee_id=:fee_id";
                        $updates= $db->prepare($update);
                        $updates->bindParam(':amount',$amount);
                        $updates->bindParam(':paycon_id',$row_select['paycon_id']);
                        $updates->bindParam(':fee_id',$fee_id);
                        $updates->execute();
                    }
                    else{
                        $or_no  = '';
                        $date   = '';
                        $time   = '';
                        
                        $insert = "INSERT INTO tbl_studentpaycon(sy_id,stud_id,fee_id,or_no,amount,date,time)VALUES(:sy_id,:stud_id,:fee_id,:or_no,:amount,:date,:time)";
                        $inserts= $db->prepare($insert);
                        $inserts->bindParam(':sy_id',$_POST['sy_id']);
                        $inserts->bindParam(':stud_id',$_POST['stud_id']);
                        $inserts->bindParam(':fee_id',$fee_id);
                        $inserts->bindParam(':or_no',$or_no);
                        $inserts->bindParam(':amount',$amount);
                        $inserts->bindParam(':date',$date);
                        $inserts->bindParam(':time',$time);
                        $inserts->execute();
                    }
                }
            }
            $_SESSION['message'] = 25;
            header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.'');
        }
        else{
            $_SESSION['message'] = 28;
            header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.'');
        }
    }
    
    if(isset($_POST['btn_reset'])){
        $sy_id   = $_POST['sy_id'];
        $stud_id = $_POST['stud_id'];
        
        $delete = "DELETE FROM tbl_studentpaycon WHERE sy_id=:sy_id AND stud_id=:stud_id AND or_no='' AND date='' AND time=''";
        $deletes= $db->prepare($delete);
        $deletes->bindParam(':sy_id',$sy_id);
        $deletes->bindParam(':stud_id',$stud_id);
        $deletes->execute();

        header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.'');
    }
    if(isset($_POST['btn_add'])){
        $sy_id   = $_POST['sy_id'];
        $stud_id = $_POST['stud_id'];
        $fee_id  = $_POST['fee_id'];
        $amount  = $_POST['amount'];
        $i       = 0;
        
        $gel_querys = "SELECT * FROM tbl_studentpayment WHERE sy_id=:sy_id AND stud_id=:stud_id AND fee_id=:fee_id ORDER BY fee_id DESC";
        $gel_selects= $db->prepare($gel_querys);
        $gel_selects->bindParam(':sy_id',$sy_id);
        $gel_selects->bindParam(':stud_id',$stud_id);
        $gel_selects->bindParam(':fee_id',$fee_id);
        $gel_selects->execute();
        $gel_rows=$gel_selects->fetch();
        
        $rel_query = "SELECT SUM(amount) AS payment FROM tbl_studentpaycon WHERE sy_id=:sy_id AND stud_id=:stud_id AND fee_id=:fee_id AND or_no!=''";
        $rel_select= $db->prepare($rel_query);
        $rel_select->bindParam(':sy_id',$sy_id);
        $rel_select->bindParam(':stud_id',$stud_id);
        $rel_select->bindParam(':fee_id',$fee_id);
        $rel_select->execute();
        if($rel_select->rowCount()>=1){
            $rel_row   = $rel_select->fetch();
            $pay       = $rel_row['payment'];
        }
        else{
            $pay       = 0;
        }

        $bal       = $gel_rows['amount'] - $pay;

        if($amount>$bal){
            $i++;
        }
        if($i==0){
            $rel_query = "SELECT * FROM tbl_studentpaycon WHERE sy_id=:sy_id AND stud_id=:stud_id AND fee_id=:fee_id AND or_no=''";
            $rel_select= $db->prepare($rel_query);
            $rel_select->bindParam(':sy_id',$_POST['sy_id']);
            $rel_select->bindParam(':stud_id',$_POST['stud_id']);
            $rel_select->bindParam(':fee_id',$fee_id);
            $rel_select->execute();
            if($rel_select->rowCount()>=1){
                $rows   = $rel_select->fetch();
                $update = "UPDATE tbl_studentpaycon SET amount=:amount WHERE paycon_id=:paycon_id";
                $updates= $db->prepare($update);
                $updates->bindParam(':amount',$amount);
                $updates->bindParam(':paycon_id',$rows['paycon_id']);
                $updates->execute();

                header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.''); 
            }
            else{
                $or_no  = '';
                $date   = '';
                $time   = '';
                        
                $insert = "INSERT INTO tbl_studentpaycon(sy_id,stud_id,fee_id,or_no,amount,date,time)VALUES(:sy_id,:stud_id,:fee_id,:or_no,:amount,:date,:time)";
                $inserts= $db->prepare($insert);
                $inserts->bindParam(':sy_id',$sy_id);
                $inserts->bindParam(':stud_id',$stud_id);
                $inserts->bindParam(':fee_id',$fee_id);
                $inserts->bindParam(':or_no',$or_no);
                $inserts->bindParam(':amount',$amount);
                $inserts->bindParam(':date',$date);
                $inserts->bindParam(':time',$time);
                $inserts->execute();
            }
            $_SESSION['message'] = 25;
            header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.'');
        }
        else{
            $_SESSION['message'] = 27;
            header('Location:../production/admin/index.php?page=app_createpayment&sy_id='.$sy_id.'&stud_id='.$stud_id.''); 
        }
       
    }
?>