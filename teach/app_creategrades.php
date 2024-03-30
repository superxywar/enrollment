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
                <form method="post" action="../../resources/script_insertgrades.php">
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
                                    <th style="text-align:center; width:450px;">Grades</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $su_sel = "SELECT * FROM tbl_enrollsub WHERE sched_id=:sched_id";
                                $su_sele= $db->prepare($su_sel);
                                $su_sele->bindParam(':sched_id',$_GET['sched_id']);
                                $su_sele->execute();
                                while($su_row=$su_sele->fetch()){
                                    
                                    $e_sel  = "SELECT * FROM tbl_enroll WHERE enroll_id=:enroll_id";
                                    $e_sele = $db->prepare($e_sel);
                                    $e_sele ->bindParam(':enroll_id',$su_row['enroll_id']);
                                    $e_sele ->execute();
                                    $e_row  = $e_sele->fetch();

                                    $tc_sel = "SELECT UPPER(CONCAT(firstname,' ',lastname)) AS name FROM tbl_student WHERE stud_id=:stud_id";
                                    $tc_sele= $db->prepare($tc_sel);
                                    $tc_sele->bindParam(':stud_id',$e_row['stud_id']);
                                    $tc_sele->execute();
                                    $tc_row = $tc_sele->fetch();

                                    $h_sel = "SELECT * FROM tbl_grades WHERE ensub_id=:ensub_id";
                                    $h_sele= $db->prepare($h_sel);
                                    $h_sele->bindParam(':ensub_id',$su_row['ensub_id']);
                                    $h_sele->execute();
                                    
                                    echo'<tr>';
                                        echo'<td style="width:50px;"><label style="font-weight:normal;"> </label></td>';
                                        echo'<td><label style="font-weight:normal;">'.$tc_row['name'].'</label></td>';
                                        echo'<td><input type="number" max="100" min="60" class="form-control" name="grade'.$su_row['ensub_id'].'" required autocomplete="off" placeholder="Input Grades"></td>';
                                    echo'</tr>';
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><label style="float:right;">Quarter</label></td>
                                    <td >
                                        <select name="quarter" class="form-control" required>
                                            <option value="">Select Quarter</option>
                                            <option value="1">1st Quarter</option>
                                            <option value="2">2nd Quarter</option>
                                            <option value="3">3rd Quarter</option>
                                            <option value="4">4th Quarter</option>
                                        </select>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-12" style="padding:20px;" >
                        <input type="hidden" name="sched_id" value="<?php echo $_GET['sched_id']?>">
                        <button type="submit" class="btn btn-primary" style="float:right;" name="btn_submit"><i class="fas fa-check"></i> POST GRADES</button>
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