<?php
    require_once'../database/dbconfig.php';

    if(isset($_POST['btn_change'])){
        $_SESSION['sy_id'] = $_POST['sy_id'];
    }
    
    header('Location:../production/admin/index.php');
?>