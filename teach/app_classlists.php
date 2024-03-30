<?php
    require_once'../../resources/message.php';
    $o_sel  = "SELECT * FROM tbl_schedule WHERE sched_id=:sched_id";
    $o_sele = $db->prepare($o_sel);
    $o_sele ->bindParam(':sched_id',$_GET['sched_id']);
    $o_sele ->execute();
    $o_row  = $o_sele->fetch();

    $sg_sel = "SELECT * FROM tbl_schoolyear WHERE sy_id=:sy_id";
    $sg_sele= $db->prepare($sg_sel);
    $sg_sele->bindParam(':sy_id',$o_row['sy_id']);
    $sg_sele->execute();
    $sg_row = $sg_sele->fetch();

    $g_sel = "SELECT * FROM tbl_gradelevel WHERE grade_id=:grade_id";
    $g_sele= $db->prepare($g_sel);
    $g_sele->bindParam(':grade_id',$o_row['grade_id']);
    $g_sele->execute();
    $g_row = $g_sele->fetch();

    $s_sel = "SELECT * FROM tbl_section WHERE section_id=:section_id";
    $s_sele= $db->prepare($s_sel);
    $s_sele->bindParam(':section_id',$o_row['section_id']);
    $s_sele->execute();
    $s_row = $s_sele->fetch();

    $l_sel = "SELECT * FROM tbl_load WHERE sched_id=:sched_id";
    $l_sele= $db->prepare($l_sel);
    $l_sele->bindParam(':sched_id',$_GET['sched_id']);
    $l_sele->execute();
    $l_row = $l_sele->fetch();

    $t_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_teacher WHERE teach_id=:teach_id";
    $t_sele= $db->prepare($t_sel);
    $t_sele->bindParam(':teach_id',$l_row['teach_id']);
    $t_sele->execute();
    $t_row = $t_sele->fetch();


    $r_sel = "SELECT * FROM tbl_room WHERE room_id=:room_id";
    $r_sele= $db->prepare($r_sel);
    $r_sele->bindParam(':room_id',$o_row['room_id']);
    $r_sele->execute();
    $r_row = $r_sele->fetch();

    $y_sel = "SELECT * FROM tbl_subject WHERE sub_id=:sub_id";
    $y_sele= $db->prepare($y_sel);
    $y_sele->bindParam(':sub_id',$o_row['sub_id']);
    $y_sele->execute();
    $y_row = $y_sele->fetch();

    //get the number of minutes
    $datetime1 = new DateTime($o_row['time_start']);
    $datetime2 = new DateTime($o_row['time_end']);
    $interval = $datetime1->diff($datetime2);   
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
                            <?php echo $g_row['grade'].' - '.$s_row['section']?>
                        </p>
                        <hr>
                    </div>
                    <div class="col-12" style="margin:auto;">
                        <table class="table table-bordered " style="line-height:10.0px;">
                            <tr>
                                <td>Teacher Name : </td><td><?php echo $t_row['name']?></td>
                                <td>Room  : </td><td><?php echo $r_row['room']?></td>
                            </tr>
                            <tr>
                                <td>Subject : </td><td><?php echo $y_row['subject']?></td>
                                <td>Day  : </td><td><?php echo $o_row['day']?></td>
                            </tr>
                            <tr>
                                <td>Time : </td><td><?php echo date('h:i A',strtotime($o_row['time_start'])).' - '.date('h:i A',strtotime($o_row['time_end']))?></td>
                                <td>No. of Minutes : </td><td><?php echo $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";?></td>
                                
                            </tr>
                        </table>
                    </div>
                    <div class="col-12" style="margin:auto;">
                        
                        <table class="table table-bordered " style="line-height:10.0px;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Student Name</th>
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
                                $i=0;
                                $su_sel = "SELECT * FROM tbl_enrollsub WHERE sched_id=:sched_id";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':sched_id',$_GET['sched_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $e_sel  = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id AND stat_enroll='Enrolled'";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    if($e_sele->rowCount()>=1){
                                        $e_row  = $e_sele->fetch();
    
                                        $tc_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_student WHERE stud_id=:stud_id";
                                        $tc_sele= $db->prepare($tc_sel);
                                        $tc_sele->bindParam(':stud_id',$e_row['stud_id']);
                                        $tc_sele->execute();
                                        $tc_row = $tc_sele->fetch();
    
    
                                        echo'<tr>';
                                            echo'<td style="width:50px;"><label style="font-weight:normal;"> </label></td>';
                                            echo'<td><label style="font-weight:normal;">'.$tc_row['name'].'</label></td>';
    
                                            $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                            $h_sele= $db->prepare($h_sel);
                                            $h_sele->bindParam(':ensub_id',$su_row['ensub_id']);
                                            $h_sele->execute();
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
                                            if($h_row['first_quarter']!=''&&$h_row['second_quarter']!=''&&$h_row['third_quarter']!=''&&$h_row['fourth_quarter']!=''){
                                                $j++;
                                            }
                                            else{
                                                $j=0;
                                            }
                                        echo'</tr>';
                                        $i++;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12" style="padding:20px;" >
                        <?php
                        
                            $b_sel = "SELECT * FROM tbl_gradstat WHERE sched_id=:sched_id";
                            $b_sele= $db->prepare($b_sel);
                            $b_sele->bindParam(':sched_id',$_GET['sched_id']);
                            $b_sele->execute();
                            if($b_sele->rowCount()>=1){}
                            else{
                                if($j==0){
                                    if($i==0){}
                                    else{
                                        echo'<a href="index.php?page=app_creategrades&sched_id='.$_GET['sched_id'].'"class="btn btn-info" style="float:right;"><i class="fas fa-print"></i> Create Grades/ Update Grades </a>';
                                    }
                                }
                                else{
                                    echo'<a href="index.php?page=app_creategrades&sched_id='.$_GET['sched_id'].'"class="btn btn-info" style="float:right;"><i class="fas fa-print"></i> Create Grades/ Update Grades </a>';
                                    echo'<a href="#confirm" data-toggle="modal" class="btn btn-success" style="float:right; margin-right:5px;"><i class="fas fa-check"></i> Done Posting Grades</a>';
                                    
                                }
                            }
                        ?>
                    </div>
                </div>
                
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
                        <label>Are you done posting grade from 1st to 4th Quarter?</label>
                    </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="../../resources/delete.php?sched_id=<?php echo $_GET['sched_id']?>&confirm=13" class="btn btn-success"><i class="fas fa-check"></i> Confirm</a> 
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>