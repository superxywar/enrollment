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
                <form method="post" action="../../resources/script_insertgrade.php">
                <div class="card card-primary">
                    <div class="col-12" style="margin:auto; text-align:center; text-transform:uppercase; font-weight:bold; padding-top:20px;">
                        <p>
                            TRANSFEREE GRADES
                        </p>
                        <hr>
                    </div>
                    
                    <div class="col-12" style="margin:auto;">
                        
                        <table class="table table-bordered " style="line-height:10.0px;">
                            <thead>
                                <tr>
                                    <th style="width:200px;">Grade Level</th>
                                    <th style="width:200px;">Subject</th>
                                    <th colspan="4" style="text-align:center;">Grades</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th style="width:200px;">1st Quarter</th>
                                    <th style="width:200px;">2nd Quarter</th>
                                    <th style="width:200px;">3rd Quarter</th>
                                    <th style="width:200px;">4th Quarter</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $j=0;
                                $su_sel = "SELECT * FROM tbl_enroll WHERE stud_id=:stud_id AND section_id=0 ORDER BY grade_id ASC";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':stud_id',$_GET['stud_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $e_sel  = "SELECT * FROM tbl_enrollsub WHERE enroll_id=:enroll_id";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    while($e_row  = $e_sele->fetch()){

                                    $ge_sel  = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
                                    $ge_sele = $db->prepare($ge_sel);
                                    $ge_sele ->bindParam(':grade_id',$su_row['grade_id']);
                                    $ge_sele ->execute();
                                    $ge_row  = $ge_sele->fetch();

                                    $sb_sel  = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
                                    $sb_sele = $db->prepare($sb_sel);
                                    $sb_sele ->bindParam(':sub_id',$e_row['sub_id']);
                                    $sb_sele ->execute();
                                    $sb_row  = $sb_sele->fetch();

                                    echo'<tr>';
                                        echo'<td style="width:50px;"><label style="font-weight:normal;">'.$ge_row['grade'].'</label></td>';
                                        echo'<td><label style="font-weight:normal;">'.$sb_row['subject'].'</label></td>';

                                        $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                        $h_sele= $db->prepare($h_sel);
                                        $h_sele->bindParam(':ensub_id',$e_row['ensub_id']);
                                        $h_sele->execute();

                                        if($h_sele->rowCount()>=1){
                                            
                                            $h_row = $h_sele->fetch();
                                            if($h_row['first_quarter']<=79){
                                                echo'<td><label style="font-weight:normal; color:red;">'.$h_row['first_quarter'].'</label></td>';
                                            }
                                            else{
                                                echo'<td><label style="font-weight:normal;">'.$h_row['first_quarter'].'</label></td>';
                                            }
                                            if($h_row['second_quarter']<=79){
                                                echo'<td><label style="font-weight:normal; color:red;">'.$h_row['second_quarter'].'</label></td>';
                                            }
                                            else{
                                                echo'<td><label style="font-weight:normal;">'.$h_row['second_quarter'].'</label></td>';
                                            }
                                            if($h_row['third_quarter']<=79){
                                                echo'<td><label style="font-weight:normal; color:red;">'.$h_row['third_quarter'].'</label></td>';
                                            }
                                            else{
                                                echo'<td><label style="font-weight:normal;">'.$h_row['third_quarter'].'</label></td>';
                                            }
                                            if($h_row['fourth_quarter']<=79){
                                                echo'<td><label style="font-weight:normal; color:red;">'.$h_row['fourth_quarter'].'</label></td>';
                                            }
                                            else{
                                                echo'<td><label style="font-weight:normal;">'.$h_row['fourth_quarter'].'</label></td>';
                                            }
                                            $j++;
                                        }
                                        else{
                                            echo'<td><input type="number" max="100" min="60" name="gradeF'.$e_row['ensub_id'].'" autocomplete="off" placeholder="Input Grades" class="form-control" required></td>';
                                            echo'<td><input type="number" max="100" min="60" name="gradeS'.$e_row['ensub_id'].'" autocomplete="off" placeholder="Input Grades" class="form-control" required></td>';
                                            echo'<td><input type="number" max="100" min="60" name="gradeT'.$e_row['ensub_id'].'" autocomplete="off" placeholder="Input Grades" class="form-control" required></td>';
                                            echo'<td><input type="number" max="100" min="60" name="gradeFR'.$e_row['ensub_id'].'" autocomplete="off" placeholder="Input Grades" class="form-control" required></td>';
                                        }
                                    echo'</tr>';
                                    }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12" style="padding:20px;" >
                    <input type="hidden" name="stud_id" value="<?php echo $_GET['stud_id']?>">
                    <?php
                        if($j==0){
                            echo'<button type="submit" class="btn btn-primary" style="float:right;" name="btn_submit"><i class="fas fa-check"></i> ADD GRADES</button> ';
                        }
                        else{
                            echo'<a href="#confirm" data-toggle="modal" class="btn btn-success" style="float:right; margin-right:5px;"><i class="fas fa-check"></i> Done Post Grades</a>';
                        }
                    ?> 
                    </div>
                </div>
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message Prompt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="form-group">
                        <label>Are you done posting grade for transferee student?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="index.php?page=app_enrollment" class="btn btn-success"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>