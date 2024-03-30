<?php
    require_once'../database/dbconfig.php';

    if(isset($_POST['btn_select'])){
        $grade_id   = $_POST['grade_id'];
        $section_id = $_POST['state'];

        header('Location:../production/admin/index.php?page=app_schedule&grade_id='.$grade_id.'&section_id='.$section_id.'');
    }
    
    
?>