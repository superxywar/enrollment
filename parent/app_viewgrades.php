<?php
    require_once'../../resources/message.php';
    
    
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2"></div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <!-- general form elements -->
                <div class="card card-primary">
                    <div class="col-12" style="margin:auto; text-align:center; text-transform:uppercase; font-weight:bold; padding-top:20px;">
                        <p>
                            GRADES
                        </p>
                        <hr>
                    </div>
                    
                    <div class="col-12" style="margin:auto;">
                        
                        <table class="table table-bordered " style="line-height:10.0px;">
                            <thead>
                                <tr>
                                    <th style="width:200px;">Grade Level</th>
                                    <th>Subject</th>
                                    <th colspan="5" style="text-align:center;">Grades</th>
                                </tr>
                                <tr>
                                    <th ></th>
                                    <th></th>
                                    <th style="width:200px;">1st Quarter</th>
                                    <th style="width:200px;">2nd Quarter</th>
                                    <th style="width:200px;">3rd Quarter</th>
                                    <th style="width:200px;">4th Quarter</th>
                                    <th style="width:200px;">Final Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $quarter_grades = 0;
                                $total_quarter  = 0;
                                $averages       = 0;
                                $average        = 0;
                                $su_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND grade_id=1 ORDER BY grade_id ASC";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $ge_sel  = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $ge_sele = $db->prepare($ge_sel);
                                    $ge_sele ->bindParam(':grade_id',$su_row['grade_id']);
                                    $ge_sele ->execute();
                                    $ge_row  = $ge_sele->fetch();

                                    
                                    $e_sel  = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id AND EXISTS(SELECT grade_id FROM tbl_grades WHERE tbl_enrollsub.ensub_id=tbl_grades.ensub_id)";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    if($e_sele->rowCount()>=1){
                                    echo'<tr>';
                                        echo'<td colspan="7"><label style="font-weight:normal;">'.$ge_row['grade'].'</label></td>';
                                    echo'</tr>';
                                    $e_count= $e_sele->rowCount();
                                    while($e_row  = $e_sele->fetch()){

                                        $sb_sel  = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $sb_sele = $db->prepare($sb_sel);
                                        $sb_sele ->bindParam(':sub_id',$e_row['sub_id']);
                                        $sb_sele ->execute();
                                        $sb_row  = $sb_sele->fetch();

                                        echo'<tr>';
                                            echo'<td ></td>';
                                            echo'<td style="width:250px;" ><label style="font-weight:normal;">'.$sb_row['subject'].'</label></td>';

                                            $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                            $h_sele= $db->prepare($h_sel);
                                            $h_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                            $h_sele->execute();

                                            if($h_sele->rowCount()>=1){
                                                $h_row = $h_sele->fetch();


                                                if($h_row['first_quarter']==''){
                                                    $first_quarter = 0;
                                                }
                                                else{
                                                    $first_quarter = $h_row['first_quarter'];
                                                }
                                                if($h_row['second_quarter']==''){
                                                    $second_quarter = 0;
                                                }
                                                else{
                                                    $second_quarter = $h_row['second_quarter'];
                                                }
                                                if($h_row['third_quarter']==''){
                                                    $third_quarter = 0;
                                                }
                                                else{
                                                    $third_quarter = $h_row['third_quarter'];
                                                }
                                                if($h_row['fourth_quarter']==''){
                                                    $fourth_quarter = 0;
                                                }
                                                else{
                                                    $fourth_quarter = $h_row['fourth_quarter'];
                                                }

                                                if($first_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$first_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$first_quarter.'</label></td>';
                                                }
                                                if($second_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$second_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$second_quarter.'</label></td>';
                                                }
                                                if($third_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$third_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$third_quarter.'</label></td>';
                                                }
                                                if($fourth_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$fourth_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$fourth_quarter.'</label></td>';
                                                }

                                                
                                            }
                                            else{
                                                $first_quarter = 0;
                                                $second_quarter= 0;
                                                $third_quarter = 0;
                                                $fourth_quarter= 0;

                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                            }
                                            
                                            $quarter_grades = ($first_quarter + $second_quarter + $third_quarter + $fourth_quarter) / 4;
                                            echo'<td><label style="font-weight:normal; ">'.$quarter_grades.'</label></td>';
                                        echo'</tr>';

                                        $total_quarter = $total_quarter + $quarter_grades;
                                        
                                        }
                                    $average = $total_quarter / $e_count;
                                    echo'<tr>';
                                        echo'<td colspan="6"><label style="font-weight:bold; float:right;">General Average : </label></td>';
                                        echo'<td><label style="font-weight:normal; ">'.number_format($average, 0, '.', ',').'</label></td>';
                                    echo'</tr>';
                                    
                                    }
                                
                                }

                                //GRADE 2
                                $quarter_grades = 0;
                                $total_quarter  = 0;
                                $averages       = 0;
                                $average        = 0;
                                $su_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND grade_id=2 ORDER BY grade_id ASC";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $ge_sel  = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $ge_sele = $db->prepare($ge_sel);
                                    $ge_sele ->bindParam(':grade_id',$su_row['grade_id']);
                                    $ge_sele ->execute();
                                    $ge_row  = $ge_sele->fetch();

                                    
                                    $e_sel  = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id AND EXISTS(SELECT grade_id FROM tbl_grades WHERE tbl_enrollsub.ensub_id=tbl_grades.ensub_id)";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    if($e_sele->rowCount()>=1){
                                    echo'<tr>';
                                        echo'<td colspan="7"><label style="font-weight:normal;">'.$ge_row['grade'].'</label></td>';
                                    echo'</tr>';
                                    $e_count= $e_sele->rowCount();
                                    while($e_row  = $e_sele->fetch()){

                                        $sb_sel  = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $sb_sele = $db->prepare($sb_sel);
                                        $sb_sele ->bindParam(':sub_id',$e_row['sub_id']);
                                        $sb_sele ->execute();
                                        $sb_row  = $sb_sele->fetch();

                                        echo'<tr>';
                                            echo'<td ></td>';
                                            echo'<td style="width:250px;" ><label style="font-weight:normal;">'.$sb_row['subject'].'</label></td>';

                                            $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                            $h_sele= $db->prepare($h_sel);
                                            $h_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                            $h_sele->execute();

                                            if($h_sele->rowCount()>=1){
                                                $h_row = $h_sele->fetch();


                                                if($h_row['first_quarter']==''){
                                                    $first_quarter = 0;
                                                }
                                                else{
                                                    $first_quarter = $h_row['first_quarter'];
                                                }
                                                if($h_row['second_quarter']==''){
                                                    $second_quarter = 0;
                                                }
                                                else{
                                                    $second_quarter = $h_row['second_quarter'];
                                                }
                                                if($h_row['third_quarter']==''){
                                                    $third_quarter = 0;
                                                }
                                                else{
                                                    $third_quarter = $h_row['third_quarter'];
                                                }
                                                if($h_row['fourth_quarter']==''){
                                                    $fourth_quarter = 0;
                                                }
                                                else{
                                                    $fourth_quarter = $h_row['fourth_quarter'];
                                                }

                                                if($first_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$first_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$first_quarter.'</label></td>';
                                                }
                                                if($second_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$second_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$second_quarter.'</label></td>';
                                                }
                                                if($third_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$third_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$third_quarter.'</label></td>';
                                                }
                                                if($fourth_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$fourth_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$fourth_quarter.'</label></td>';
                                                }

                                                
                                            }
                                            else{
                                                $first_quarter = 0;
                                                $second_quarter= 0;
                                                $third_quarter = 0;
                                                $fourth_quarter= 0;

                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                            }
                                            
                                            $quarter_grades = ($first_quarter + $second_quarter + $third_quarter + $fourth_quarter) / 4;
                                            echo'<td><label style="font-weight:normal; ">'.$quarter_grades.'</label></td>';
                                        echo'</tr>';

                                        $total_quarter = $total_quarter + $quarter_grades;
                                        
                                        }
                                    $average = $total_quarter / $e_count;
                                    echo'<tr>';
                                        echo'<td colspan="6"><label style="font-weight:bold; float:right;">General Average : </label></td>';
                                        echo'<td><label style="font-weight:normal; ">'.number_format($average, 0, '.', ',').'</label></td>';
                                    echo'</tr>';
                                    
                                    }
                                
                                }

                                //GRADE 3
                                $quarter_grades = 0;
                                $total_quarter  = 0;
                                $averages       = 0;
                                $average        = 0;
                                $su_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND grade_id=3 ORDER BY grade_id ASC";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $ge_sel  = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $ge_sele = $db->prepare($ge_sel);
                                    $ge_sele ->bindParam(':grade_id',$su_row['grade_id']);
                                    $ge_sele ->execute();
                                    $ge_row  = $ge_sele->fetch();

                                    
                                    $e_sel  = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id AND EXISTS(SELECT grade_id FROM tbl_grades WHERE tbl_enrollsub.ensub_id=tbl_grades.ensub_id)";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    if($e_sele->rowCount()>=1){
                                    echo'<tr>';
                                        echo'<td colspan="7"><label style="font-weight:normal;">'.$ge_row['grade'].'</label></td>';
                                    echo'</tr>';
                                    $e_count= $e_sele->rowCount();
                                    while($e_row  = $e_sele->fetch()){

                                        $sb_sel  = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $sb_sele = $db->prepare($sb_sel);
                                        $sb_sele ->bindParam(':sub_id',$e_row['sub_id']);
                                        $sb_sele ->execute();
                                        $sb_row  = $sb_sele->fetch();

                                        echo'<tr>';
                                            echo'<td ></td>';
                                            echo'<td style="width:250px;" ><label style="font-weight:normal;">'.$sb_row['subject'].'</label></td>';

                                            $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                            $h_sele= $db->prepare($h_sel);
                                            $h_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                            $h_sele->execute();

                                            if($h_sele->rowCount()>=1){
                                                $h_row = $h_sele->fetch();


                                                if($h_row['first_quarter']==''){
                                                    $first_quarter = 0;
                                                }
                                                else{
                                                    $first_quarter = $h_row['first_quarter'];
                                                }
                                                if($h_row['second_quarter']==''){
                                                    $second_quarter = 0;
                                                }
                                                else{
                                                    $second_quarter = $h_row['second_quarter'];
                                                }
                                                if($h_row['third_quarter']==''){
                                                    $third_quarter = 0;
                                                }
                                                else{
                                                    $third_quarter = $h_row['third_quarter'];
                                                }
                                                if($h_row['fourth_quarter']==''){
                                                    $fourth_quarter = 0;
                                                }
                                                else{
                                                    $fourth_quarter = $h_row['fourth_quarter'];
                                                }

                                                if($first_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$first_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$first_quarter.'</label></td>';
                                                }
                                                if($second_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$second_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$second_quarter.'</label></td>';
                                                }
                                                if($third_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$third_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$third_quarter.'</label></td>';
                                                }
                                                if($fourth_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$fourth_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$fourth_quarter.'</label></td>';
                                                }

                                                
                                            }
                                            else{
                                                $first_quarter = 0;
                                                $second_quarter= 0;
                                                $third_quarter = 0;
                                                $fourth_quarter= 0;

                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                            }
                                            
                                            $quarter_grades = ($first_quarter + $second_quarter + $third_quarter + $fourth_quarter) / 4;
                                            echo'<td><label style="font-weight:normal; ">'.$quarter_grades.'</label></td>';
                                        echo'</tr>';

                                        $total_quarter = $total_quarter + $quarter_grades;
                                        
                                        }
                                    $average = $total_quarter / $e_count;
                                    echo'<tr>';
                                        echo'<td colspan="6"><label style="font-weight:bold; float:right;">General Average : </label></td>';
                                        echo'<td><label style="font-weight:normal; ">'.number_format($average, 0, '.', ',').'</label></td>';
                                    echo'</tr>';
                                    
                                    }
                                
                                }

                                //GRADE 4
                                $quarter_grades = 0;
                                $total_quarter  = 0;
                                $averages       = 0;
                                $average        = 0;
                                $su_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND grade_id=4 ORDER BY grade_id ASC";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $ge_sel  = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $ge_sele = $db->prepare($ge_sel);
                                    $ge_sele ->bindParam(':grade_id',$su_row['grade_id']);
                                    $ge_sele ->execute();
                                    $ge_row  = $ge_sele->fetch();

                                    
                                    $e_sel  = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id AND EXISTS(SELECT grade_id FROM tbl_grades WHERE tbl_enrollsub.ensub_id=tbl_grades.ensub_id)";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    if($e_sele->rowCount()>=1){
                                    echo'<tr>';
                                        echo'<td colspan="7"><label style="font-weight:normal;">'.$ge_row['grade'].'</label></td>';
                                    echo'</tr>';
                                    $e_count= $e_sele->rowCount();
                                    while($e_row  = $e_sele->fetch()){

                                        $sb_sel  = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $sb_sele = $db->prepare($sb_sel);
                                        $sb_sele ->bindParam(':sub_id',$e_row['sub_id']);
                                        $sb_sele ->execute();
                                        $sb_row  = $sb_sele->fetch();

                                        echo'<tr>';
                                            echo'<td ></td>';
                                            echo'<td style="width:250px;" ><label style="font-weight:normal;">'.$sb_row['subject'].'</label></td>';

                                            $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                            $h_sele= $db->prepare($h_sel);
                                            $h_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                            $h_sele->execute();

                                            if($h_sele->rowCount()>=1){
                                                $h_row = $h_sele->fetch();


                                                if($h_row['first_quarter']==''){
                                                    $first_quarter = 0;
                                                }
                                                else{
                                                    $first_quarter = $h_row['first_quarter'];
                                                }
                                                if($h_row['second_quarter']==''){
                                                    $second_quarter = 0;
                                                }
                                                else{
                                                    $second_quarter = $h_row['second_quarter'];
                                                }
                                                if($h_row['third_quarter']==''){
                                                    $third_quarter = 0;
                                                }
                                                else{
                                                    $third_quarter = $h_row['third_quarter'];
                                                }
                                                if($h_row['fourth_quarter']==''){
                                                    $fourth_quarter = 0;
                                                }
                                                else{
                                                    $fourth_quarter = $h_row['fourth_quarter'];
                                                }

                                                if($first_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$first_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$first_quarter.'</label></td>';
                                                }
                                                if($second_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$second_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$second_quarter.'</label></td>';
                                                }
                                                if($third_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$third_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$third_quarter.'</label></td>';
                                                }
                                                if($fourth_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$fourth_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$fourth_quarter.'</label></td>';
                                                }

                                                
                                            }
                                            else{
                                                $first_quarter = 0;
                                                $second_quarter= 0;
                                                $third_quarter = 0;
                                                $fourth_quarter= 0;

                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                            }
                                            
                                            $quarter_grades = ($first_quarter + $second_quarter + $third_quarter + $fourth_quarter) / 4;
                                            echo'<td><label style="font-weight:normal; ">'.$quarter_grades.'</label></td>';
                                        echo'</tr>';

                                        $total_quarter = $total_quarter + $quarter_grades;
                                        
                                        }
                                    $average = $total_quarter / $e_count;
                                    echo'<tr>';
                                        echo'<td colspan="6"><label style="font-weight:bold; float:right;">General Average : </label></td>';
                                        echo'<td><label style="font-weight:normal; ">'.number_format($average, 0, '.', ',').'</label></td>';
                                    echo'</tr>';
                                    
                                    }
                                
                                }

                                //GRADE 5
                                $quarter_grades = 0;
                                $total_quarter  = 0;
                                $averages       = 0;
                                $average        = 0;
                                $su_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND grade_id=5 ORDER BY grade_id ASC";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $ge_sel  = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $ge_sele = $db->prepare($ge_sel);
                                    $ge_sele ->bindParam(':grade_id',$su_row['grade_id']);
                                    $ge_sele ->execute();
                                    $ge_row  = $ge_sele->fetch();

                                    
                                    $e_sel  = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id AND EXISTS(SELECT grade_id FROM tbl_grades WHERE tbl_enrollsub.ensub_id=tbl_grades.ensub_id)";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    if($e_sele->rowCount()>=1){
                                    echo'<tr>';
                                        echo'<td colspan="7"><label style="font-weight:normal;">'.$ge_row['grade'].'</label></td>';
                                    echo'</tr>';
                                    $e_count= $e_sele->rowCount();
                                    while($e_row  = $e_sele->fetch()){

                                        $sb_sel  = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $sb_sele = $db->prepare($sb_sel);
                                        $sb_sele ->bindParam(':sub_id',$e_row['sub_id']);
                                        $sb_sele ->execute();
                                        $sb_row  = $sb_sele->fetch();

                                        echo'<tr>';
                                            echo'<td ></td>';
                                            echo'<td style="width:250px;" ><label style="font-weight:normal;">'.$sb_row['subject'].'</label></td>';

                                            $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                            $h_sele= $db->prepare($h_sel);
                                            $h_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                            $h_sele->execute();

                                            if($h_sele->rowCount()>=1){
                                                $h_row = $h_sele->fetch();


                                                if($h_row['first_quarter']==''){
                                                    $first_quarter = 0;
                                                }
                                                else{
                                                    $first_quarter = $h_row['first_quarter'];
                                                }
                                                if($h_row['second_quarter']==''){
                                                    $second_quarter = 0;
                                                }
                                                else{
                                                    $second_quarter = $h_row['second_quarter'];
                                                }
                                                if($h_row['third_quarter']==''){
                                                    $third_quarter = 0;
                                                }
                                                else{
                                                    $third_quarter = $h_row['third_quarter'];
                                                }
                                                if($h_row['fourth_quarter']==''){
                                                    $fourth_quarter = 0;
                                                }
                                                else{
                                                    $fourth_quarter = $h_row['fourth_quarter'];
                                                }

                                                if($first_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$first_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$first_quarter.'</label></td>';
                                                }
                                                if($second_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$second_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$second_quarter.'</label></td>';
                                                }
                                                if($third_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$third_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$third_quarter.'</label></td>';
                                                }
                                                if($fourth_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$fourth_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$fourth_quarter.'</label></td>';
                                                }

                                                
                                            }
                                            else{
                                                $first_quarter = 0;
                                                $second_quarter= 0;
                                                $third_quarter = 0;
                                                $fourth_quarter= 0;

                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                            }
                                            
                                            $quarter_grades = ($first_quarter + $second_quarter + $third_quarter + $fourth_quarter) / 4;
                                            echo'<td><label style="font-weight:normal; ">'.$quarter_grades.'</label></td>';
                                        echo'</tr>';

                                        $total_quarter = $total_quarter + $quarter_grades;
                                        
                                        }
                                    $average = $total_quarter / $e_count;
                                    echo'<tr>';
                                        echo'<td colspan="6"><label style="font-weight:bold; float:right;">General Average : </label></td>';
                                        echo'<td><label style="font-weight:normal; ">'.number_format($average, 0, '.', ',').'</label></td>';
                                    echo'</tr>';
                                    
                                    }
                                
                                }

                                //GRADE 6
                                $quarter_grades = 0;
                                $total_quarter  = 0;
                                $averages       = 0;
                                $average        = 0;
                                $su_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND grade_id=6 ORDER BY grade_id ASC";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $ge_sel  = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $ge_sele = $db->prepare($ge_sel);
                                    $ge_sele ->bindParam(':grade_id',$su_row['grade_id']);
                                    $ge_sele ->execute();
                                    $ge_row  = $ge_sele->fetch();

                                    
                                    $e_sel  = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id AND EXISTS(SELECT grade_id FROM tbl_grades WHERE tbl_enrollsub.ensub_id=tbl_grades.ensub_id)";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    if($e_sele->rowCount()>=1){
                                    echo'<tr>';
                                        echo'<td colspan="7"><label style="font-weight:normal;">'.$ge_row['grade'].'</label></td>';
                                    echo'</tr>';
                                    $e_count= $e_sele->rowCount();
                                    while($e_row  = $e_sele->fetch()){

                                        $sb_sel  = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                        $sb_sele = $db->prepare($sb_sel);
                                        $sb_sele ->bindParam(':sub_id',$e_row['sub_id']);
                                        $sb_sele ->execute();
                                        $sb_row  = $sb_sele->fetch();

                                        echo'<tr>';
                                            echo'<td ></td>';
                                            echo'<td style="width:250px;" ><label style="font-weight:normal;">'.$sb_row['subject'].'</label></td>';

                                            $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                            $h_sele= $db->prepare($h_sel);
                                            $h_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                            $h_sele->execute();

                                            if($h_sele->rowCount()>=1){
                                                $h_row = $h_sele->fetch();


                                                if($h_row['first_quarter']==''){
                                                    $first_quarter = 0;
                                                }
                                                else{
                                                    $first_quarter = $h_row['first_quarter'];
                                                }
                                                if($h_row['second_quarter']==''){
                                                    $second_quarter = 0;
                                                }
                                                else{
                                                    $second_quarter = $h_row['second_quarter'];
                                                }
                                                if($h_row['third_quarter']==''){
                                                    $third_quarter = 0;
                                                }
                                                else{
                                                    $third_quarter = $h_row['third_quarter'];
                                                }
                                                if($h_row['fourth_quarter']==''){
                                                    $fourth_quarter = 0;
                                                }
                                                else{
                                                    $fourth_quarter = $h_row['fourth_quarter'];
                                                }

                                                if($first_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$first_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$first_quarter.'</label></td>';
                                                }
                                                if($second_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$second_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$second_quarter.'</label></td>';
                                                }
                                                if($third_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$third_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$third_quarter.'</label></td>';
                                                }
                                                if($fourth_quarter<=79){
                                                    echo'<td><label style="font-weight:normal; color:red;">'.$fourth_quarter.'</label></td>';
                                                }
                                                else{
                                                    echo'<td><label style="font-weight:normal;">'.$fourth_quarter.'</label></td>';
                                                }

                                                
                                            }
                                            else{
                                                $first_quarter = 0;
                                                $second_quarter= 0;
                                                $third_quarter = 0;
                                                $fourth_quarter= 0;

                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                                echo'<td><label style="font-weight:normal; "></label></td>';
                                            }
                                            
                                            $quarter_grades = ($first_quarter + $second_quarter + $third_quarter + $fourth_quarter) / 4;
                                            echo'<td><label style="font-weight:normal; ">'.$quarter_grades.'</label></td>';
                                        echo'</tr>';

                                        $total_quarter = $total_quarter + $quarter_grades;
                                        
                                        }
                                    $average = $total_quarter / $e_count;
                                    echo'<tr>';
                                        echo'<td colspan="6"><label style="font-weight:bold; float:right;">General Average : </label></td>';
                                        echo'<td><label style="font-weight:normal; ">'.number_format($average, 0, '.', ',').'</label></td>';
                                    echo'</tr>';
                                    
                                    }
                                
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12" style="padding:20px;" >
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
