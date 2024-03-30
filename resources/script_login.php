<?php
    if(isset($_POST['btn_log'])){
    
    
        $email    = $_POST['email'];
        $password = $_POST['password']; 
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = '<div class="alert bg-red" >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <p><strong>Error</strong><br /> INVALID E-MAIL FORMAT.</p>
            </div>';
        }
        else{
            $select   = "SELECT * FROM tbl_useraccount WHERE email=:email AND password=:password";
            $sel_query  = $db ->prepare($select);
            $sel_query->bindParam(':email',$email);
            $sel_query->bindParam(':password',$password);
            $sel_query->execute();
            if($sel_query->rowCount()==1){
                $row = $sel_query->fetch();
                $_SESSION['user_id'] = $row['user_id'];
                if($row['user_type']=='Admin'||$row['user_type']=='Staff'||$row['user_type']=='Registrar'){
                    header('Location:index.php?page=select_schoolyear');
                }
            }
            else{
                echo '<div class="alert bg-red" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <p><strong>ERROR</strong><br /> INVALID CREDENTIALS.</p>
                </div>';
            }
        }
        
    }
?>